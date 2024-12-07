<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends MasterController
{
    public function __construct()
    {
        $this->model = Author::class;
        $this->viewPath = 'admin.pages.Author';
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
