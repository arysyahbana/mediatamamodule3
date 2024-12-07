<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalFunction;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends MasterController
{
    public function __construct()
    {
        $this->model = Article::class;
        $this->viewPath = 'admin.pages.Article';
        $this->withRelations = ['rAuthor', 'rCategories', 'rTags'];
    }

    public function index()
    {
        $page = 'Article';
        $authors = Author::all();
        $tags = Tag::all();
        $categories = Category::all();
        $data = $this->model::with($this->withRelations)->latest()->get();
        return view($this->viewPath . '.index', compact('authors', 'tags', 'categories', 'page', 'data'));
    }

    public function store(Request $request)
    {
        $imagePath = 'Article';
        $rules = Article::rules('post'); // Mengirimkan metode create
        $validatedData = $request->validate($rules);
        if ($request->hasFile('image')) {
            $imageName = GlobalFunction::saveImage($request->file('image'), uniqid(), $imagePath);
            $validatedData['image'] = $imageName;
        }
        $item = $this->model::create($validatedData);
        if ($request->filled('category_id')) {
            $item->rCategories()->sync($request->category_id);
        }
        if ($request->filled('tag')) {
            $item->rTags()->sync($request->tag);
        }
        return redirect()->route(last(explode('.', $this->viewPath)) . '.index')->with('success', 'Data created successfully');
    }

    public function update(Request $request, $id)
    {
        $imagePath = 'Article';
        $rules = Article::rules('put');
        $validatedData = $request->validate($rules);

        $item = $this->model::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($item->image) {
                GlobalFunction::deleteImage($item->image, $imagePath);
            }
            $imageName = GlobalFunction::saveImage($request->file('image'), uniqid(), $imagePath);
            $validatedData['image'] = $imageName;
        }

        $item->update($validatedData);

        if ($request->filled('category_id')) {
            $item->rCategories()->sync($request->category_id);
        }

        if ($request->filled('tag')) {
            $item->rTags()->sync($request->tag);
        }

        return redirect()->route(last(explode('.', $this->viewPath)) . '.index')->with('success', 'Data updated successfully');
    }
}
