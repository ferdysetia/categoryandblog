<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::with('user')->select('categories.*');
            return DataTables::of($categories)
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : 'Unknown';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-warning editCategory" data-id="'.$row->id.'" data-title="'.$row->title.'">Edit</button>
                        <button class="btn btn-sm btn-danger deleteCategory" data-id="'.$row->id.'">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories,title',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try {
            DB::beginTransaction();
            
            $category = Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'user_id' => auth()->id(),
            ]);
    
            DB::commit();
    
            return response()->json(['success' => 'Category added successfully!', 'category' => $category]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to add category', 'message' => $e->getMessage()], 500);
        }
    }    

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:categories,title,'.$request->id,
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try {
            DB::beginTransaction();
            
            $category = Category::find($request->id);
            $category->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
            ]);
    
            DB::commit();
    
            return response()->json(['success' => 'Category updated successfully!', 'category' => $category]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update category', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $category = Category::find($request->id);
            if (!$category) {
                return response()->json(['error' => 'Category not found!'], 404);
            }
            
            $category->delete();
            DB::commit();
            
            return response()->json(['success' => 'Category deleted successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete category', 'message' => $e->getMessage()], 500);
        }
    }
}
