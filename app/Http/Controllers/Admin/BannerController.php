<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class BannerController extends Controller
{
    public function index()
    {
        return view(
            'admin.banner.index',
            [
                'banner1' => Banner::find(1),
                'banner2' => Banner::find(2),
                'banner3' => Banner::find(3)
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kata1' => 'required',
            'kata2' => 'required',
            'gambar_banner' => 'nullable|sometimes|image|mimes:jpg,png,bmp,jpeg,webp'
        ]);

        $banner = Banner::findOrFail($id);
       
        $data = $request->all();

        if (!empty($data['gambar_banner'])) {
            File::delete(public_path('assets/images/banner/' . $banner->gambar_banner));
            $nama_foto = rand(1, 999) . "-" . $data['gambar_banner']->getClientOriginalName();
            $data['gambar_banner'] = Image::make($data['gambar_banner']->getRealPath());
            $data['gambar_banner']->resize(1200, 800);
            $data['gambar_banner']->save(public_path('assets/images/banner/' . $nama_foto));
            $data['gambar_banner'] = $nama_foto;
        }

        $banner->update($data);
        return redirect()->route('banner.index')
            ->with(['status' => 'Data Banner ' . $banner->id . ' Berhasil Di Update']);
    }
}
