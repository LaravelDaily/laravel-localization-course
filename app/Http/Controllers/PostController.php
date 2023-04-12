<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $authors = User::pluck('name', 'id');

        return view('posts.create', compact('authors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'publish_date' => ['nullable', 'date'],
            'author_id' => ['required', 'numeric'],
        ];
        foreach (config('app.supportedLocales') as $locale) { // <-- Adding validation for each available locale
            $rules += [
                'title.' . $locale => ['required', 'string'],
                'post.' . $locale => ['required', 'string'],
            ];
        }

        $this->validate($request, $rules);

        $post = Post::create([
            'user_id' => $request->input('author_id'),
            'publish_date' => $request->input('publish_date'),
        ]);
        foreach (config('app.supportedLocales') as $locale) { // <-- Saving translations for each available locale
            $post->translations()->create([
                'locale' => $locale,
                'title' => $request->input('title.' . $locale),
                'post' => $request->input('post.' . $locale),
            ]);
        }

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        $authors = User::pluck('name', 'id');
        $post->load(['translations']);

        return view('posts.edit', compact('post', 'authors'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $rules = [
            'publish_date' => ['nullable', 'date'],
            'author_id' => ['required', 'numeric'],
        ];
        foreach (config('app.supportedLocales') as $locale) { // <-- Adding validation for each available locale
            $rules += [
                'title.' . $locale => ['required', 'string'],
                'post.' . $locale => ['required', 'string'],
            ];
        }

        $this->validate($request, $rules);

        $post->update([
            'user_id' => $request->input('author_id'),
            'publish_date' => $request->input('publish_date'),
        ]);

        foreach (config('app.supportedLocales') as $locale) { // <-- Updating translations for each available locale
            $post->translations()->updateOrCreate([
                'locale' => $locale
            ], [
                'title' => $request->input('title.' . $locale),
                'post' => $request->input('post.' . $locale),
            ]);
        }

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
