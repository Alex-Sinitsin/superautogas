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
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $brands = CarBrand::with('models')->paginate(10);
        $brandsForSelect = CarBrand::all();

        return view('admin.gallery.index', compact('brands', 'brandsForSelect'));
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
            'name' => ['required', 'string', Rule::unique('car_models', 'name')],
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
                $path = 'models/' . strtoupper($brand->slug) . '/' . strtoupper($model->slug) . '/' . $hash . '.' . strtolower($file->getClientOriginalExtension());

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
            $path = 'brands/' . $hash . '.' . strtolower($file->getClientOriginalExtension());

            Storage::disk('public')->put($path, $compressed_file, 'public');

            $data['logotype'] = $path;

            CarBrand::create($data);

            return response()->json(['status' => 200, 'message' => 'Бренд автомобиля успешно добавлен!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function brandUpdate(BrandRequest $request, $id)
    {
        $data = $request->validated();

        $brand = CarBrand::findOrFail($id);

        if (Storage::disk('public')->exists($brand->logotype)) {
            Storage::disk('public')->delete($brand->logotype);
        }

        if ($request->hasFile('logotype')) {
            $file = $request->file('logotype');
            $compressed_file = Image::make($file->getRealPath());
            $compressed_file->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $hash = md5(Carbon::now() . $file->getClientOriginalName() . rand(0, 9999999));
            $path = 'brands/' . $hash . '.' . strtolower($file->getClientOriginalExtension());

            Storage::disk('public')->put($path, $compressed_file, 'public');

            $brand->name = $data['name'];
            $brand->logotype = $path;
            if ($request->has('is_active')) $brand->is_active = $data['is_active'];
            $brand->save();
        }
        return response()->json(['status' => 200, 'message' => 'Бренд автомобиля успешно добавлен!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyBrand($id)
    {
        $brand = CarBrand::findOrFail($id);
        $models = CarModel::where('car_brand_id', '=', $id)->get();

        foreach ($models as $model) {
            $images = Gallery::where('car_model_id', '=', $model->id)->get();

            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);

                    $directoryModel = public_path('storage\\models\\' . strtoupper($brand->slug) . '\\' . strtoupper($model->slug));
                    $directoryBrand = public_path('storage\\models\\' . strtoupper($brand->slug));

                    $this->destroyDirectory($directoryModel);
                    $this->destroyDirectory($directoryBrand);
                } else {
                    abort(404, 'File Not Found!');
                }
                $image->delete();
            }

            $model->delete();
        }
        $brand->delete();

        return response()->json(['status' => 200, 'message' => 'Бренд автомобиля успешно удален!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = CarModel::with(['images'])->where('slug', '=', $slug)->first();
        $brand = CarBrand::findOrFail($model->car_brand_id);
        return view('admin.gallery.show', compact('model', 'brand'));
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
            'name' => ['required', 'string', Rule::unique('car_models', 'name')->ignore($id)],
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
                    $path = 'models/' . strtoupper($brand->slug) . '/' . strtoupper($model->slug) . '/' . $hash . '.' . strtolower($file->getClientOriginalExtension());

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
    public function destroyModel($id)
    {
        $model = CarModel::findOrFail($id);
        $brand = CarBrand::findOrFail($model->car_brand_id);
        $images = Gallery::where('car_model_id', '=', $model->id)->get();

        foreach ($images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);

                $directoryModel = public_path('storage\\models\\' . strtoupper($brand->slug) . '\\' . strtoupper($model->slug));
                $directoryBrand = public_path('storage\\models\\' . strtoupper($brand->slug));

                $this->destroyDirectory($directoryModel);
                $this->destroyDirectory($directoryBrand);
            } else {
                abort(404, 'File Not Found!');
            }
            $image->delete();
        }

        $model->delete();

        return response()->json(['status' => 200, 'message' => 'Модель автомобиля успешно удалена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Gallery::findOrFail($id);
        $model = CarModel::findOrFail($image->car_model_id);
        $brand = CarBrand::findOrFail($model->car_brand_id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);

            $directoryModel = public_path('storage\\models\\' . strtoupper($brand->slug) . '\\' . strtoupper($model->slug));
            $directoryBrand = public_path('storage\\models\\' . strtoupper($brand->slug));

            $this->destroyDirectory($directoryModel);
            $this->destroyDirectory($directoryBrand);
        } else {
            abort(404, 'File Not Found!');
        }

        $image->delete();
        return response()->json()->setStatusCode(200);
    }

    protected function destroyDirectory($directory)
    {
        $FileSystem = new FileSystem();

        if ($FileSystem->exists($directory)) {
            $files = $FileSystem->files($directory);
            $directories = $FileSystem->directories($directory);

            if (empty($files) && empty($directories)) {
                $FileSystem->deleteDirectory($directory);
            }
        } else abort(404, 'Directory' . $directory . 'Not Found!');
    }
}
