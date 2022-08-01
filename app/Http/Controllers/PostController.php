<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
    public function store(PostStoreRequest $request)
    {
        Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'post-trixFields' => request('post-trixFields'),
            'attachment-post-trixFields' => request('attachment-post-trixFields')
        ]);

        return redirect(route('posts.index'))->withSuccess('Новость успешно создана!');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Store attachments to disk
     *
     * @return string
     */
    public function upload(Request $request)
    {
        if($request->has('file')) {
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename= pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filenameExt = $request->file('file')->getClientOriginalExtension();
            $filenametostore = md5($filename) .'.'. $filenameExt;

            $request->file('file')->storeAs(storage_path('/trix'), $filenametostore);
            echo storage_path('trix/'.$filenametostore, );
            exit;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostStoreRequest $request, $id)
    {
        $data = $request->validated();
        $post = Post::findOrFail($id);

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->is_published = $data['is_published'];
        $post->save();

        return redirect(route('posts.index'))->withSuccess('Новость успешно обновлена!');
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
        Post::deleted($post);
        return redirect(route('posts.index'))->withSuccess('Новость успешно удалена!');
    }
}
