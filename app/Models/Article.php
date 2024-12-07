<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'content',
        'author_id',
    ];

    public static function rules($method = 'post')
    {
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'tag' => 'array',
            'tag.*' => 'exists:tags,id',
        ];

        $routeName = request()->route()->getName();

        if ($routeName === 'Article.store') {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        } elseif ($routeName === 'Article.update') {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }




    public function rAuthor()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function rCategories()
    {
        return $this->belongsToMany(Category::class, 'article_categories');
    }

    public function rTags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
