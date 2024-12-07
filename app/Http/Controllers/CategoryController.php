<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends MasterController
{
    public function __construct()
    {
        $this->model = Category::class;
        $this->viewPath = 'admin.pages.Category';
    }

    public function create()
    {
        abort(404);
    }

    public function edit($id)
    {
        abort(404);
    }
}
