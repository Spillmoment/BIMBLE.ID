@foreach (explode('|', $item->gambar) as $image)
<img src="/storage/image/{{ $image }}" style="max-height: 40px;">
@endforeach
