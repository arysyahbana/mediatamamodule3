<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends MasterController
{
    public function __construct()
    {
        $this->model = Tag::class;
        $this->viewPath = 'admin.pages.Tag';
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
