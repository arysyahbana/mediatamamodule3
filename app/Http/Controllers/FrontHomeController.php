<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $searchQuery = $request->input('search'); // Ambil query pencarian dari form

        if ($searchQuery) {
            // Jika ada pencarian, cari artikel berdasarkan judul dan konten
            $allArticles = Article::with('rCategories', 'rTags', 'rAuthor')
                ->where('title', 'like', '%' . $searchQuery . '%') // Pencarian berdasarkan judul
                ->orWhere('content', 'like', '%' . $searchQuery . '%') // Pencarian berdasarkan konten
                ->latest()
                ->paginate(8);
        } else {
            // Jika tidak ada pencarian, tampilkan semua artikel
            $allArticles = Article::with('rCategories', 'rTags', 'rAuthor')
                ->latest()
                ->paginate(8);
        }

        return view('welcome', compact('categories', 'allArticles'));
    }



    public function category($category)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $allArticles = Article::with('rCategories', 'rTags', 'rAuthor')->latest()->paginate(8);

        $selectedCategory = Category::where('name', $category)->first();

        if (!$selectedCategory) {
            abort(404, 'Category not found');
        }

        $filteredArticles = Article::with('rCategories', 'rTags', 'rAuthor')
            ->whereHas('rCategories', function ($query) use ($selectedCategory) {
                $query->where('categories.id', $selectedCategory->id);
            })
            ->get();

        return view('welcome', compact('tags', 'categories', 'allArticles', 'filteredArticles', 'selectedCategory'));
    }

    public function detail($id)
    {
        $categories = Category::all();
        $article = Article::with('rCategories', 'rTags', 'rAuthor')->findOrFail($id);
        return view('detail', compact('article', 'categories'));
    }
}
