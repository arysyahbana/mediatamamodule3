<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:authors,email|string|max:255',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
