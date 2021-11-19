@foreach (explode('|', $item->gambar) as $image)
<img width="130px" height="80px" src="/storage/galeri/{{$image}}">
@endforeach
