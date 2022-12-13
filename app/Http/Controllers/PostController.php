<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(1);
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => ['required', 'unique:posts', 'min:5'],
            'body' => ['required', 'string', 'min:5'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif']
            // 'image' => "required|image|mimes:png,jpg,jpeg,gif"

        ]);

        $data = $request->only('title', 'body');
        $slug = Str::slug($request->input('title'));

        Post::create(
            array_merge($data, [
                'slug' => $slug,
                'user_id' => auth()->user()->id,
                'image' => $request->file('image')->store('blog_images', 'public')
            ])
        );

        session()->flash('success', 'Post created successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'unique:posts,title,' .$id, 'min:5'],
            'body' => ['required', 'string', 'min:5'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif']
            // 'image' => "required|image|mimes:png,jpg,jpeg,gif"

        ]);

        $post = Post::findOrFail($id);

        $data = $request->only('title', 'body');

        if ($request->hasFile('image')) {
            $data = array_merge($data, [
                'image' => $request->file('image')->store('blog_images', 'public')
            ]);
            if(file_exists($file = storage_path('app/public' . $post->image))){
                unlink($file);
            }
        }




        $post->update($data);

        session()->flash('success', 'Post updated successfully');

        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');

    }
}
