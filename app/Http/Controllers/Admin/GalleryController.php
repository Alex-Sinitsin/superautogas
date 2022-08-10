<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Filesystem\Filesystem;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $brands = CarBrand::with('models')->get();
        return view('admin.gallery.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'parent' => ['required'],
            'images' => ['required', 'array'],
        ]);

        $brand = CarBrand::findOrFail((int) $validated['parent']);
        $model = $brand->models()->create([
            'name' => $validated['name']
        ]);
        if ($request->hasFile('images')) {
            $files = $request->file('images');

            foreach ($files as $file) {
                $compressed_file = Image::make($file->getRealPath());
                $compressed_file->resize(1600, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
                $hash = md5(Carbon::now() . $file->getClientOriginalName() . rand(0, 9999999));
                $path = 'models/' . $brand->name . '/' . $validated['name'] . '/' . $hash . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->put($path, $compressed_file, 'public');
                $model->images()->create([
                    'image' => $path,
                ]);
            }

            return response()->json(['status' => 200, 'message' => 'Модель автомобиля успешно добавлен!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function brandStore(BrandRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logotype')) {
            $file = $request->file('logotype');
            $compressed_file = Image::make($file->getRealPath());
            $compressed_file->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $hash = md5(Carbon::now() . $file->getClientOriginalName() . rand(0, 9999999));
            $path = 'brands/' . $hash . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->put($path, $compressed_file, 'public');

            $data['logotype'] = $path;

            CarBrand::create($data);

            return response()->json(['status' => 200, 'message' => 'Бренд автомобиля успешно добавлен!']);
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
        $model = CarModel::with('images')->where('id', '=', $id)->get();

        dd($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'parent' => ['required'],
            'images' => ['nullable', 'array'],
        ]);

        $brand = CarBrand::findOrFail((int) $validated['parent']);
        $model = CarModel::findOrFail($id);

        $model->car_brand_id = (int) $validated['parent'];
        $model->name = $validated['name'];
        $model->save();

        if ($request->hasFile('images')) {
            $files = $request->file('images');

            if (!empty($files)) {
                foreach ($files as $file) {
                    $compressed_file = Image::make($file->getRealPath());
                    $compressed_file->resize(1600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->stream();
                    $hash = md5(Carbon::now() . $file->getClientOriginalName() . rand(0, 9999999));
                    $path = 'models/' . $brand->name . '/' . $validated['name'] . '/' . $hash . '.' . $file->getClientOriginalExtension();

                    Storage::disk('public')->put($path, $compressed_file, 'public');
                    $model->images()->create([
                        'image' => $path,
                    ]);
                }
            }
        }
        return response()->json(['status' => 200, 'message' => 'Модель автомобиля успешно обновлена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Доделать проверку существования файлов в папке с изображениями бренда и, если она пустая - удалить
        $image = Gallery::findOrFail($id);
        $model = CarModel::findOrFail($image->car_model_id);
        $brand = CarBrand::findOrFail($model->car_brand_id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);

            $FileSystem = new FileSystem();

            $directory = public_path('storage\\models\\' . $brand->name . '\\' . $model->name);

            if ($FileSystem->exists($directory)) {
                $files = $FileSystem->files($directory);
                if (empty($files)) {
                    $FileSystem->deleteDirectory($directory);
                }
            } else abort(404, 'Directory Not Found!');

            $image->delete();
        } else {
            abort(404, 'File Not Found!');
        }
        return response()->json()->setStatusCode(200);
    }
}
