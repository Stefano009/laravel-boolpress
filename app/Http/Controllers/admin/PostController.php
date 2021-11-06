<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;


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
        return view('admin.posts.create');
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
            'content'=>'required|min:20'
        ]);
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Str::slug($data['title']);
        // slug method working, add a control because it need to be unique
        $new_post->save();
        
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
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if($post){
            return view('admin.posts.edit', compact('post'));
        }abort(404);
        return view('admin.posts.edit', compact('post'));
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
            'content'=>'required|min:20'
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

        $post->update($form_data);
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
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
