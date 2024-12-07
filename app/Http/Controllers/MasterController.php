<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalFunction;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    protected  $model;
    protected  $viewPath;

    protected $withRelations = [];

    public function index()
    {
        $page = ucwords(str_replace(['-', '_'], ' ', last(explode('.', $this->viewPath))));

        $query = $this->model::query();

        if (!empty($this->withRelations)) {
            $query->with($this->withRelations);
        }

        $data = $query->latest()->get();

        // dd($data);
        return view("{$this->viewPath}.index", compact('data', 'page'));
    }

    public function create()
    {
        $page = ucwords(str_replace(['-', '_'], ' ', last(explode('.', $this->viewPath))));
        return view("{$this->viewPath}.create", compact('page'));
    }

    public function store(Request $request)
    {
        $imagePath = strtolower(last(explode('.', $this->viewPath)));

        $validated = $request->validate($this->model::$rules);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = GlobalFunction::saveImage($request->file('image'), uniqid(), $imagePath);
            $validated['image'] = $imageName; // Simpan nama file ke database
        }

        $this->model::create($validated);
        return redirect()->route(last(explode('.', $this->viewPath)) . '.index')->with('success', 'Data created successfully');
    }

    public function edit($id)
    {
        $page = ucwords(str_replace(['-', '_'], ' ', last(explode('.', $this->viewPath))));
        $item = $this->model::findOrFail($id);
        return view("{$this->viewPath}.edit", compact('item', 'page'));
    }

    public function update(Request $request, $id)
    {
        $imagePath = strtolower(last(explode('.', $this->viewPath)));

        $rules = $this->model::$rules;
        $validated = $request->validate($rules);

        $item = $this->model::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($item->image) {
                GlobalFunction::deleteImage($item->image, $imagePath);
            }

            $imageName = GlobalFunction::saveImage($request->file('image'), uniqid(), $imagePath);
            $validated['image'] = $imageName;
        }

        $item->update($validated);
        return redirect()->route(last(explode('.', $this->viewPath)) . '.index')->with('success', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $imagePath = strtolower(last(explode('.', $this->viewPath)));

        $item = $this->model::findOrFail($id);

        if ($item->image) {
            GlobalFunction::deleteImage($item->image, $imagePath);
        }

        $item->delete();
        return redirect()->route(last(explode('.', $this->viewPath)) . '.index')->with('success', 'Data deleted successfully');
    }
}
