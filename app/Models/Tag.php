<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
    ];

    public function rArticles()
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }
}
