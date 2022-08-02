<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pages = Page::all();
        if(Route::is('pages*')) return view('admin.pages.index', compact('pages'));
        else return view('admin.about.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if(Route::is('*pages*')) return view('admin.pages.create');
        elseif(Route::is('about*')) return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        $data = $request->validated();
        Page::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'post-trixFields' => request('post-trixFields'),
            'attachment-post-trixFields' => request('attachment-post-trixFields')
        ]);

        if(Route::is('pages*')) return redirect(route('pages.index'))->withSuccess('Страница успешно создана!');
        elseif(Route::is('about*')) return redirect(route('about.index'))->withSuccess('Страница успешно создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        if(Route::is('pages*')) return view('admin.pages.edit', compact('page'));
        else return view('admin.about.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageStoreRequest $request, $id)
    {
        $data = $request->validated();
        $page = Page::findOrFail($id);

        $page->title = $data['title'];
        $page->content = $data['content'];
        $page->save();

        if(Route::is('pages*')) return redirect(route('pages.index'))->withSuccess('Страница обновлена!');
        elseif(Route::is('about*')) return redirect(route('about.index'))->withSuccess('Страница успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        Page::deleted($page);
        if(Route::is('pages*')) return redirect(route('pages.index'))->withSuccess('Страница успешно удалена!');
        elseif(Route::is('about*')) return redirect(route('about.index'))->withSuccess('Страница успешно удалена!');
    }
}
