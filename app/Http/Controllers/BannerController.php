<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Storage;

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
            'gambar_banner' => 'nullable|sometimes|image|mimes:jpg,png,bmp,jpeg'
        ]);

        $banner = Banner::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar_banner')) {
            if ($banner->gambar_banner && file_exists(storage_path('app/public/' . $banner->gambar_banner))) {
                Storage::delete('public/' . $banner->gambar_banner);
                $data['gambar_banner'] =  $request->file('gambar_banner')->store('banner', 'public');
            } else {
                $data['gambar_banner'] =  $request->file('gambar_banner')->store('banner', 'public');
            }
        }

        $banner->update($data);
        return redirect()->route('banner.index')
            ->with(['status' => 'Data Banner ' . $banner->id . ' Berhasil Di Update']);
    }
}
