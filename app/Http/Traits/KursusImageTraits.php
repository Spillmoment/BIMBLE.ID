<?php

namespace App\Http\Traits;

use Intervention\Image\ImageManagerStatic as Image;

trait KursusImageTraits
{
  protected function uploadImage($request, $field)
  {
    $image = null;
    $bg = null;

    if ($field == 'gambar_kursus') {
      $data[$field] = $request->file($field);
      $nama_gambar = rand(1, 999) . "-" . $data[$field]->getClientOriginalName();
      $data[$field] = Image::make($data[$field]->getRealPath());
      $data[$field]->resize(500, 300)
        ->save(public_path('assets/images/kursus/' . $nama_gambar));
      $data[$field] = $nama_gambar;
      $image = $data[$field];
    } else {
      $data[$field] = $request->file('gambar_kursus');
      $nama_back = rand(1, 999) . "-" . $data[$field]->getClientOriginalName();
      $data[$field] = Image::make($data[$field]->getRealPath());
      $data[$field]
        ->save(public_path('assets/images/background-kursus/' . $nama_back));
      $data[$field] = $nama_back;
      $bg = $data[$field];
    }

    return $image;
    return $bg;
  }
}
