<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->get();  // Mengambil semua blog dengan kategori
        $categories = Category::all();          // Mengambil semua kategori
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

        $blog->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'summary' => $request->summary,
            'body' => $request->body,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.index');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index');
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
