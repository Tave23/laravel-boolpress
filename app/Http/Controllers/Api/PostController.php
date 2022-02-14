<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::paginate(5);

        $tags = Tag::all();
        $categories = Category::all();

        return response()->json(compact('posts', 'tags', 'categories'));
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        if (!$post) {
            $post = [
                'title_post' => 'Post non trovato',
                'content' => `<router-link :to="{name: 'blog'}">Torna alla lista dei post</router-link>`];
        }

        return response()->json($post);

    }

    // funzione per chiamata api postbycategory
    public function PostByCategory($slug_categ){

        $category = Category::where('slug', $slug_categ)->with('posts.tags')->first();

        return response()->json($category);
    }


    // funzione per chiamata api postbytags
    public function PostByTag($slug_tag){

        $tag = Tag::where('slug', $slug_tag)->with('posts.category')->first();

        return response()->json($tag);
    }
}
