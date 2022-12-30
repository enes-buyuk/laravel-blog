<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $posts = Post::when(request('category_id'), function ($query) {
            $query->where('category_id', request('category_id'));
        })
            ->latest()
            ->paginate(2);

        return view('front.index',
            compact('categories', 'posts')
        );
    }

    public function show($post_id)
    {
        $post = Post::where('id', $post_id)->firstOrfail();
        return view('front.blog', compact('post'));
    }

}
