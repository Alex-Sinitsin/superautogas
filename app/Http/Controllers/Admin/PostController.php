<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Post $post)
    {
        return view('admin.posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostStoreRequest $request)
    {
        //TODO: На клиенте сделать перенаправление на главную страницу постов при успехе создания поста
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $compressed_file = Image::make($file->getRealPath());
            $compressed_file->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $hash = md5(Carbon::now() . $file->getClientOriginalName() . rand(0, 9999999));
            $path = 'uploads/' . $hash . '.' . strtolower($file->getClientOriginalExtension());

            Storage::disk('public')->put($path, $compressed_file, 'public');

            $data['image'] = $path;

            Post::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $data['image'],
                'post-trixFields' => request('post-trixFields'),
                'attachment-post-trixFields' => request('attachment-post-trixFields')
            ]);

            return response()->json(['status' => 200, 'message' => 'Новость успешно добавлена!']);
        }
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
