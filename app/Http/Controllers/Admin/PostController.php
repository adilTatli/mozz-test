<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(10);
        $date = $posts->map(function ($post) {
            return $post->created_at->diffForHumans();
        });
        return view('admin.posts.index', compact('posts', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $categories = Category::pluck('title', 'id')->all();
            return view('admin.posts.edit', compact('categories',  'post'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Пост не найдена');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $data = $request->validated();
            $data['is_published'] = $request->has('is_published');

            if ($file = Post::uploadImage($request, $post->image)) {
                $data['image'] = $file;
            }

            $post->update($data);

            return redirect()->route('admin.posts.index')->with('success', 'Успешно изменено');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Пост не найден');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();

            return redirect()->route('admin.posts.index')->with('success', 'Успешно удалено');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Пост не найден');
        }
    }
}
