@extends('user.layouts.master')

@section('title')
    Liên hệ
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="{{route('home.listProduct')}}">Sản phẩm</a>
                    <span class="breadcrumb-item active">Liên hệ</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Liên hệ</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{route('home.contact.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="control-group">
                            <label for="">Họ và tên</label>
                            <input type="text" class="form-control" name="name" required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label for="">Chủ đề</label>
                            <input type="text" class="form-control" name="title" required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label for="">Nội dung</label>
                            <textarea class="form-control" rows="8" name="message" placeholder="Nội dung" required="required"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" name="submit" type="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10085.499625249282!2d105.8589324922951!3d21.047390269081667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abd21238fbf3%3A0x1d7a2b3ddfeeb951!2zNjMgTmfhu41jIFRodeG7tSwgTmfhu41jIFRo4buleSwgTG9uZyBCacOqbiwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1665651181762!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Long Biên - Hà Nội</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>cosmeticshop123@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
<!-- Contact End -->
@endsection
@section('css')
   
@endsection
