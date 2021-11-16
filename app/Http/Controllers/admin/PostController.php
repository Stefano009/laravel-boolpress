<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
		//same as users, but for admins
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'title'=>'required|unique:posts|max:50',
            'content'=>'required|min:20',
            'category'=>'nullable|exists:categories,id',
            'tags'=>'exists:tags,id',
            //exists in the tags table column id
            'image' =>'nullable|image'
        ]);
        $new_post = new Post();
        if(array_key_exists('image', $data)){
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path;
        }
        $new_post->fill($data);
        $new_post->slug = Str::slug($data['title']);
        // slug method working, add a control because it need to be unique
        
        $new_post->save();
        
        // now i'm going to link tags id to the id of this post using the attach after the save so i have the id
        $new_post->tags()->attach($data['tags']);        
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // SELECT * from posts where slug = $slug
        $post = Post::where('slug', $slug)->first();
        if(!$post){
            abort(404);
        }return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id);
        if(!$post){
            abort(404);
        }

        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $form_data = $request->all();
        $request->validate([
            'title'=>'required|max:50',
            'content'=>'required|min:20',
            'category_id'=> 'nullable|exists:categories,id',
            'tags'=> 'exists:tags,id',
            'image' => 'nullable|image'
        ]);

        if ($form_data['title'] != $post->title){

            $slug = Str::slug($form_data['title']);
            $starting_slug = $slug;
            $is_slug_there = Post::where('slug', $slug)->first();
            // query i'm using to check if in database my slug is already there
            $counter = 1;
            // initializing my counter to 1 so i can use it to create different slugs with the same root
            while($is_slug_there) {
                $slug = $starting_slug . '-' . $counter;
                $is_slug_there = Post::where('slug', $slug)->first();
                //i'll check everytime if my slug is already there so my while will cycle till the slug is unique
                $counter++;
            }

            $form_data->slug = $slug;

        }
        if(array_key_exists('image', $form_data)){
            Storage::delete($post->cover);//prima di immettere una nuova immagine dobbiamo cancellare la precedente
            $cover_path = Storage::put('post_covers', $form_data->image);
            $form_data['cover'] = $cover_path;
        }
        $post->update($form_data);
        // nell'update si usa la funzione sync che si occupa di sincronizzare i tag cancellando e contemporaneamente scrivendo il nuovo data 
        if(array_key_exists('tags', $form_data)){
            $post->tags()->sync($form_data['tags']);
        } else {
            $post->tags()->sync([]);
            //if it is empty i need to clear it all
        }

        // $new_post->slug = Str::slug($data['title']);
        // slug method working, add a control because it need to be unique
        
        return redirect()->route('admin.posts.index')->with('status', 'Post correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // so if i delete a post it will destroy the tags in the table tags posts using the id of the post it is refered to
        $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
