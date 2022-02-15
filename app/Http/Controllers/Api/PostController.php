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

        // percorsi assoluti
        $posts->each(function($post){

            if ($post->image) {
                $post->image = url('storage/' . $post->image);
            }else{
                $post->image = url('placeholder-image/placeholder.jpeg');
            }
        });

        $tags = Tag::all();
        $categories = Category::all();

        return response()->json(compact('posts', 'tags', 'categories'));
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        // percorsi assoluti
        if ($post->image) {
            $post->image = url('storage/' . $post->image);
        }else{
            $post->image = url('placeholder-image/placeholder.jpeg');
        }

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
        $success = true;
        $error_msg = '';

        // percorsi assoluti
        $category->posts->each(function($post){
            $post->cover = $this->makeImageRoute($post->image);
        });

        if (!$category) {
            $success = false;
            $error_msg = 'Categoria non esistente';
        }elseif ($category && count($category['posts']) === 0) {
            $success = false;
            $error_msg = 'Nessun post esistente con questa categoria';
        }

        return response()->json(compact('category', 'success', 'error_msg'));
    }


    // funzione per chiamata api postbytags
    public function PostByTag($slug_tag){

        $tag = Tag::where('slug', $slug_tag)->with('posts.category')->first();

        $success = true;
        $error_msg = '';

        // percorsi assoluti
        $tag->posts->each(function($post){
            $post->cover = $this->makeImageRoute($post->image);
        });

        if (!$tag) {
            $success = false;
            $error_msg = 'Tag non esistente';
        }elseif ($tag && count($tag['posts']) === 0) {
            $success = false;
            $error_msg = 'Nessun post esistente con questo tag';
        }

        return response()->json(compact('tag', 'success', 'error_msg'));
    }

    public function makeImageRoute($image){
        if($image){
            $image = url('storage/' . $image);
        }else{
            $image = url('placeholder-image/placeholder.jpeg');
        }

        return $image;
    }
}
