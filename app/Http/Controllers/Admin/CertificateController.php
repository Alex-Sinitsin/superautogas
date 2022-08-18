<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateRequest;
use App\Models\Certificate;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function store(CertificateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $files = $data['file'];

            foreach ($files as $file) {
                $compressed_file = Image::make($file->getRealPath());
                $compressed_file->resize(null, 1600, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
                $hash = md5(Carbon::now() . $file->getClientOriginalName() . rand(0, 9999999));
                $path = 'certificates/' . $hash . '.' . strtolower($file->getClientOriginalExtension());

                Storage::disk('public')->put($path, $compressed_file, 'public');
                Certificate::create([
                    'image' => $path
                ]);
            }
        }
        return response()->json(['status' => 200, 'message' => 'Сертификат(ы) успешно добавлен!']);
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        if (Storage::disk('public')->exists($certificate->image)) {
            Storage::disk('public')->delete($certificate->image);
            $path = public_path('storage\\certificates');

            $this->destroyDirectory($path);
        } else {
            abort(404, 'File Not Found!');
        }
        $certificate->delete();

        return response()->json(['status' => 200, 'message' => 'Сертификат успешно удален!']);
    }

    protected function destroyDirectory($directory)
    {
        $FileSystem = new Filesystem();

        if ($FileSystem->exists($directory)) {
            $files = $FileSystem->files($directory);
            $directories = $FileSystem->directories($directory);

            if (empty($files) && empty($directories)) {
                $FileSystem->deleteDirectory($directory);
            }
        } else abort(404, 'Directory' . $directory . 'Not Found!');
    }
}
