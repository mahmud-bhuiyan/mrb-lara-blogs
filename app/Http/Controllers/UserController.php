<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class UserController extends Controller
{
    public function index()
    {
        $postObj = new Post();
        $posts = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->get();

        $categories = Category::all();

        return view('user.index', compact('posts', 'categories'));
    }

    public function single_post_view($id)
    {
        $postObj = new Post();
        $post = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.id', $id)
            ->first();

        return view('user.single_post_view', compact('post'));
    }

    public function filter_by_category($id)
    {
        $postObj = new Post();
        $posts = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.category_id', $id)
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->get();

        return view('user.filter_by_category', compact('posts'));
    }
}
