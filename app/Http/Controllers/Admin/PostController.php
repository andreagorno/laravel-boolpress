<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $postValidationArray = [
        'title' => 'required|max:255',
        'content' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

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

        $request->validate($this->postValidationArray);

        $newPost = new Post();

        $slug = Str::slug($data['title'], '-');

        $existingPost = Post::where('slug', $slug)->first();
        //dd($existingPost);

        $slugBase = $slug;
        $counter = 1;

        while($existingPost) {
            $slug = $slugBase . "-" .$counter;

            $existingPost = Post::where('slug', $slug)->first();
            $counter++;
        }

        $data['slug'] = $slug;

        $newPost->fill($data);

        $newPost->save();

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
        //$post = Post::findOrFail($id);

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

        return view('admin.posts.edit', compact('post'));
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
        $data = $request->all();

        $request->validate($this->postValidationArray);

        if($post->title != $data["title"]) {
            $slug = Str::slug($data['title'], '-');

            $existingPost = Post::where('slug', $slug)->first();
            //dd($existingPost);

            $slugBase = $slug;
            $counter = 1;

            while($existingPost) {
                $slug = $slugBase . "-" .$counter;

                $existingPost = Post::where('slug', $slug)->first();
                $counter++;
            }

            $data["slug"] = $slug;
        }

        $post->update($data);

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

        return redirect()
            ->route('admin.posts.index')
            ->with('delete', $post->title);
    }
}
