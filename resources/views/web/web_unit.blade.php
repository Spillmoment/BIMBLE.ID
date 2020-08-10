@extends('web.layouts.main')

@section('title','Bimble.id | Daftar Unit')
@section('content')

<section class="pt-5 pb-6 bg-gray-100">
    <div class="container">
        <h2 class="h4 mb-3">Form Pendaftran Unit</h2>
        <div class="row">
            <div class="col-md-7 mb-5 mb-md-0">
                <form id="contact-form" method="post" action="http://demo.bootstrapious.com/directory/1-4-1/contact.php"
                    class="form">
                    <div class="controls">
                        <div class="form-group">
                            <label for="surname" class="form-label">Nama Unit</label>
                            <input type="text" name="surname" id="surname" placeholder="Masukkan Nama Unit"
                                required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukkan Email" required="required"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Alamat</label>
                            <textarea rows="4" name="message" id="message" placeholder="Masukkan Alamat"
                                required="required" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Kirim</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="pl-lg-4">
                    <p class="text-muted">
                        Silahkan cantumkan detail unit anda
                    </p>
                    <p class="text-muted">
                        Untuk selengkapnya hubungi kami
                    </p>
                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i
                                        class="fab fa-pinterest"></i></a></li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-vimeo"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
