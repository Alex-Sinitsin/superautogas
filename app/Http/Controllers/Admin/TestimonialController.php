<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testimonial = new Testimonial();
        return view('admin.testimonials.create', compact('testimonial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
        $data = $request->validated();
        Testimonial::create([
            'nickname' => $data['nickname'],
            'car_model' => $data['car_model'],
            'rating' => $data['rating'],
            'text' => $data['text'],
            'is_published' => $data['is_published'],
        ]);

        return redirect(route('testimonials.index'))->withSuccess('Отзыв клиента успешно создан!');
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, $id)
    {
        $data = $request->validated();
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->nickname = $data['nickname'];
        $testimonial->car_model = $data['car_model'];
        $testimonial->rating = $data['rating'];
        $testimonial->text = $data['text'];
        $testimonial->is_published = $data['is_published'];
        $testimonial->save();

        return redirect(route('testimonials.index'))->withSuccess('Отзыв клиента успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect(route('testimonials.index'))->withSuccess('Отзыв клиента успешно удален!');
    }
}
