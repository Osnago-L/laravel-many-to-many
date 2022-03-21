<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
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
        $data_categories = Category::all();
        $data_posts = Post::all();
        return view('admin.posts.index', compact('data_posts','data_categories',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_tags = Tag::all();
        $data_categories = Category::all();
        return view('admin.posts.create',compact('data_categories','data_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "posts_title" => 'required|min:1|max:50',
            "content" => 'required',
            "category_id"=>'nullable|exists:categories,id'
        ]);


        $data = $request->all();

        $tempSlug = Str::slug($data['posts_title'],'-');
        $cont = 1;
        while (Post::where('slug', $tempSlug)->first()){
            $tempSlug = Str::slug($data['posts_title'],'-')."-".$cont;
            $cont++;
        }

        $data['slug'] = $tempSlug;
       

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->save();
        $newPost->tags()->sync(isset($data['tags_id'])?$data['tags_id']:[]);

        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data_tags = Tag::all();
        $data_categories = Category::all();
        return view('admin.posts.edit', compact('post','data_categories','data_tags' ));
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
        $request->validate([
            "posts_title" => 'required|min:1|max:50',
            "content" => 'required',
            "category_id"=>'nullable|exists:categories,id'
        ]);


        $data = $request->all();

        $tempSlug = Str::slug($data['posts_title'],'-');
        $cont = 1;
        while (Post::where('slug', $tempSlug)->where('id','!=', $post->id)->first()){
            $tempSlug = Str::slug($data['posts_title'],'-')."-".$cont;
            $cont++;
        }
        $data['slug'] = $tempSlug;

        $post->fill($data);
        $post->save();


        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
