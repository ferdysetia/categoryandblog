<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->get();  
        $categories = Category::all(); 
        return view('blog.index', compact('blogs', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:128',
            'summary' => 'required|string|max:288',
            'body' => 'required|string',
            'status' => 'required|in:publish,draft',
        ]);

        Blog::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'summary' => $request->summary,
            'body' => $request->body,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.index');
    
        try {
            DB::beginTransaction();
            
            Blog::create([
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'title' => $request->title,
                'summary' => $request->summary,
                'body' => $request->body,
                'status' => $request->status,
            ]);
    
            DB::commit();
            
            return redirect()->route('blog.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create blog post', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:128',
            'summary' => 'required|string|max:288',
            'body' => 'required|string',
            'status' => 'required|in:publish,draft',
        ]);
    
        try {
            DB::beginTransaction();
    
            $blog->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'summary' => $request->summary,
                'body' => $request->body,
                'status' => $request->status,
            ]);
    
            DB::commit();
    
            return redirect()->route('blog.index')->with('success', 'Blog berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan saat memperbarui blog: ' . $e->getMessage());
        }
    }

    public function edit(Blog $blog)
    {
        try {
            return DB::transaction(function () use ($blog) {
                $categories = Category::all();
                return view('blog.edit', compact('blog', 'categories'));
            });
        } catch (\Exception $e) {
            Log::error('Error saat mengambil data blog: ' . $e->getMessage());
            return redirect()->route('blog.index')->with('error', 'Terjadi kesalahan saat memuat halaman edit.');
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            DB::beginTransaction();
            
            $blog->delete();
            
            DB::commit();
            
            return redirect()->route('blog.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to delete blog post', 'message' => $e->getMessage()]);
        }
    }    

    public function showWelcomePage()
    {
        // Ambil semua blog
        $blogs = Blog::with('category')->get();

        // Kirim data blog ke view welcome
        return view('welcome', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }


}
