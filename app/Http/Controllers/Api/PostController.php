<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::paginate(5);

        return response()->json(compact('posts'));
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
}
