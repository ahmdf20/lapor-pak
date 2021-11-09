<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // https://laravel.com/docs/8.x/container

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Eager loading laravel
        // n+1 laravel

        $title = "Lapor Pak!";
        $posts = Post::all();

        return view('posts.index', compact(['title', 'posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Lapor Pak! | Create";
        return view('posts.create', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');

        $path = $file->store('public/images');

        if (!$file) return redirect()->back();

        // $image = Image::create([
        //     'name'      => $file->getClientOriginalName(),
        //     'path'      => $path,
        // ]);

        // $image->post()->create($request->except(['image']));


        $image = Image::create([
            "path"      =>  $path,
            "name"      =>  $file->getClientOriginalName()
        ]);

        $data = $request->except(['image']);

        $data['image_id'] = $image->id;

        Post::create($data);

        return redirect()->back()->with(['message' => 'post created !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  number  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['image'])->findOrFail($id);

        return view('path', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
