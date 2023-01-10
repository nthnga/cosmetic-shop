@extends('user.layouts.master')

@section('title')
    Liên hệ
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="sweetalert2.min.css"> --}}
    <style>
        @-webkit-keyframes my {
            0% {
                color: #F8CD0A;
            }

            50% {
                color: rgb(95, 10, 10);
            }

            100% {
                color: #F8CD0A;
            }
        }

        @-moz-keyframes my {
            0% {
                color: #F8CD0A;
            }

            50% {
                color: rgb(110, 29, 29);
            }

            100% {
                color: #F8CD0A;
            }
        }

        @-o-keyframes my {
            0% {
                color: #F8CD0A;
            }

            50% {
                color: rgb(124, 33, 33);
            }

            100% {
                color: #F8CD0A;
            }
        }

        @keyframes my {
            0% {
                color: #F8CD0A;
            }

            50% {
                color: rgb(133, 30, 30);
            }

            100% {
                color: #F8CD0A;
            }
        }

        .text {
            /* background:#3d3d3d; */
            font-size: 24px;
            font-weight: bold;
            -webkit-animation: my 700ms infinite;
            -moz-animation: my 700ms infinite;
            -o-animation: my 700ms infinite;
            animation: my 700ms infinite;
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('home.listProduct') }}">Sản phẩm</a>
                    <span class="breadcrumb-item active">Liên hệ</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Liên
                hệ</span></h2>

        <div class="row px-xl-5">
            <div style="padding: 10px;">
                <p style="font-size: 18px;"><b style="font-size: 25px;">Cosmetic Shop</b> cửa hàng bán lẻ mỹ phẩm online tại
                    Việt Nam với các dòng sản phẩm của nhiều thương hiệu đến từ các quốc gia sắc đẹp!
                    Mọi thắc mắc mong quý khách để lại thông tin liên hệ hoặc liên hệ trực tiếp với chúng tôi qua thông tin
                    bên dưới.
                    Chúng tôi sẽ sớm có phản hồi về mọi thắc mắc của quý khách! Chúc quý khách một ngày tốt lành <i
                        class="fa fa-heart" style="color:red"></i> </p>
                <p class="text" style="font-size: 23px; font-family:CURSIVE">
                    <i class="fa fa-hand-point-right" style="color: #37e13c; font-size: 22px;"></i>
                    Liên hệ trực tiếp qua thông tin
                    <i class="fa fa-hand-point-down" style="color: #0d0d89;font-size: 22px;"></i>
                </p>
                <p style="font-size: 20px; margin-left: 20px;"><i class="fa fa-blog" style="color: #d936c5"></i> Website:
                    <b>Cosmetic Shop</b></p>
                <p style="font-size: 20px; margin-left: 20px;"><i class="fa fa-mobile" style="color: #0e97ad"></i> Số điện
                    thoại: <b style="color: red"> <i class="fa fa-phone-volume"></i> 098.352.1583 - 012.345.6789</b></p>
                <p style="font-size: 20px; margin-left: 20px;"><i class="fa fa-map" style="color: #bb0450"></i> Địa chỉ: <b
                        style="">Số 63 - phường Ngọc Thụy - quận Long Biên - Hà Nội </b></p>
                <p class="text" style="font-size: 23px; font-family:CURSIVE">
                    <i class="fa fa-hand-point-right" style="color: #5895e1; font-size: 22px;"></i>
                    Gửi thông tin phản hồi
                    <i class="fa fa-hands" style="color: #a5a722;font-size: 22px;"></i>
                </p>
            </div>
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('home.contact.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="control-group">
                            <label for="">Họ và tên</label>
                            <input type="text" class="form-control" name="name" required="required" />
                            <p class="help-block text-danger"></p>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        </div>
                        <div class="control-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required="required" />
                            <p class="help-block text-danger"></p>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        </div>
                        <div class="control-group">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" required="required" />
                            <p class="help-block text-danger"></p>
                            @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                        </div>
                        <div class="control-group">
                            <label for="">Chủ đề</label>
                            <input type="text" class="form-control" name="title" required="required" />
                            <p class="help-block text-danger"></p>
                            @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                        </div>
                        <div class="control-group">
                            <label for="">Nội dung</label>
                            <textarea class="form-control" rows="8" name="message" placeholder="Nội dung" required="required"></textarea>
                            <p class="help-block text-danger"></p>
                            @if ($errors->has('message'))
                            <span class="text-danger">{{ $errors->first('message') }}</span>
                        @endif
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4 button" type="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10085.499625249282!2d105.8589324922951!3d21.047390269081667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abd21238fbf3%3A0x1d7a2b3ddfeeb951!2zNjMgTmfhu41jIFRodeG7tSwgTmfhu41jIFRo4buleSwgTG9uZyBCacOqbiwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1665651181762!5m2!1svi!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i><b>Long Biên - Hà Nội</b></p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i><i>cosmeticshop123@gmail.com</i></p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i><b>+012 345 67890</b></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::has('success'))
        <script>
            // Swal.fire('Any fool can use a computer')
            Swal.fire({
                title: 'Cosmetic shop đã nhận được yêu cầu của bạn!',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        </script>
    @endif
@endsection
