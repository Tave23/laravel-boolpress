<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // per prendere i dati dello user
        $loggedUser = Auth::user();

        $categoryList = Category::all(); 

        $posts = Post::orderBy('id','desc')->paginate(5);

        return view('admin.posts.index', compact('posts', 'loggedUser', 'categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = Category::all();

        $tags = Tag::all();

        return view('admin.posts.create', compact('categoryList', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title_post' => 'required|min:2|max:255',
                'content' => 'required|min:5',
                'image' => 'nullable|image'
            ],
            [
                'title_post.required' => "Inserire un titolo",
                'title_post.min' => "Inserire almeno :min caratteri",
                'title_post.max' => "Inserire meno di :max caratteri",
                'content.required' => "Inserire il contenuto del post",
                'content.min' => "Inserire almeno :min caratteri",
                'image.image' => "Devi inserire un\'immagine",
            ]
        );

        $created_post = $request->all();
        // dd($created_post);

        // controllo input image
        if (array_key_exists('image', $created_post )) {
            
            // prendere il nome originale dell'immagine
            $created_post['originale_name_image'] = $request->file('image')->getClientOriginalName();
            // salvare image e il percorso dell'image
            $image_route = Storage::put('uploads', $created_post['image']);
            $created_post['image'] = $image_route;
        };

        // $img_path = Storage::put()

        $new_post = new Post();

        // vado a riempire $new_post
        $new_post->fill($created_post);

        // aggiungo lo slug usando la funzione 
        $new_post->slug = Post::createSlug($new_post->title_post);

        // salvo
        $new_post->save();


        if (array_key_exists('tags', $created_post)) {
            $new_post->tags()->attach($created_post['tags']);
        }

        // redirect a show
        return redirect()->route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post) {
            return view('admin.posts.show', compact('post'));
        }

        abort(404, 'Post non presente nel database');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $categoryList = Category::all();

        $tags = Tag::all();

        if ($post) {
            return view('admin.posts.edit', compact('post', 'categoryList', 'tags'));
        }

        abort(404, 'Post non presente nel database');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title_post' => 'required|min:2|max:255',
                'content' => 'required|min:5',
                'image' => 'nullable|image'
            ],
            [
                'title_post.required' => "Inserire un titolo",
                'title_post.min' => "Inserire almeno :min caratteri",
                'title_post.max' => "Inserire meno di :max caratteri",
                'content.required' => "Inserire il contenuto del post",
                'content.min' => "Inserire almeno :min caratteri",
                'image.image' => "Devi inserire un'immagine",
            ]
        );

        $edit_data = $request->all();

        if (array_key_exists('image', $edit_data )) {

            // eliminare la precedente immagine
            if ($post->image) {
                Storage::delete($post->image);
            }
            
            // prendere il nome originale dell'immagine
            $edit_data['originale_name_image'] = $request->file('image')->getClientOriginalName();
            // salvare image e il percorso dell'image
            $image_route = Storage::put('uploads', $edit_data['image']);
            $edit_data['image'] = $image_route;
        };

        if ($edit_data['title_post'] != $post->title_post) {
            $edit_data['slug'] = Post::createSlug($edit_data['title_post']);
        }

        $post->update($edit_data);

        if (array_key_exists('tags', $edit_data)) {
            // sync e non attach per ristabilire relazioni e aggiornarle
            $post->tags()->sync($edit_data['tags']);
        } else{
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.index', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // eliminare la precedente immagine
        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted_post', "Il post: $post->title_post ?? stato eliminato.");
    }
}
