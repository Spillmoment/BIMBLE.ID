<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $banner1 = Banner::find(1);
        $banner2 = Banner::find(2);
        $banner3 = Banner::find(3);

        // dd($banner1);
        return view('admin.banner.index', [
            'banner1' => $banner1,
            'banner2' => $banner2,
            'banner3' => $banner3
        ]);
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
        //
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
        return redirect()->route('banner.index')->with(['status' => 'Data Banner Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
