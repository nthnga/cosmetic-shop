@extends('user.layouts.master')

@section('title')
    Tất cả sản phẩm
@endsection

@section('css')
    <style>
        @-webkit-keyframes my {
            0% {
                color: #1e0a77;
            }

            50% {
                color: rgb(148, 88, 10);
            }

            100% {
                color: #190b94;
            }
        }

        @-moz-keyframes my {
            0% {
                color: #341088;
            }

            50% {
                color: rgb(182, 92, 18);
            }

            100% {
                color: #321581;
            }
        }

        @-o-keyframes my {
            0% {
                color: #2b0d7e;
            }

            50% {
                color: rgb(204, 87, 19);
            }

            100% {
                color: #31108a;
            }
        }

        @keyframes my {
            0% {
                color: #160e83;
            }

            50% {
                color: rgb(197, 90, 18);
            }

            100% {
                color: #120b75;
            }
        }

        .text_coupon {
            /* background:#3d3d3d; */

            -webkit-animation: my 700ms infinite;
            -moz-animation: my 700ms infinite;
            -o-animation: my 700ms infinite;
            animation: my 700ms infinite;
        }

        .container {
            display: inline-block;
            padding-left: 0;
        }

        .typed-out {
            overflow: hidden;
            border-right: .15em solid rgb(140, 94, 10);
            white-space: nowrap;
            animation:
                typing 7s steps(50, end) forwards;
            font-size: 1.6rem;
            width: 0;

        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }


        @-webkit-keyframes snowflakes-fall {
            0% {
                top: -10%
            }

            100% {
                top: 100%
            }
        }

        @-webkit-keyframes snowflakes-shake {

            0%,
            100% {
                -webkit-transform: translateX(0);
                transform: translateX(0)
            }

            50% {
                -webkit-transform: translateX(80px);
                transform: translateX(80px)
            }
        }

        @keyframes snowflakes-fall {
            0% {
                top: -10%
            }

            100% {
                top: 100%
            }
        }

        @keyframes snowflakes-shake {

            0%,
            100% {
                transform: translateX(0)
            }

            50% {
                transform: translateX(80px)
            }
        }


        .snowflake {
            color: #fff;
            font-size: 2em;
            font-family: Arial, sans-serif;
            text-shadow: 0 0 5px #000;
            position: fixed;
            top: -10%;
            z-index: 9999;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            cursor: default;
            -webkit-animation-name: snowflakes-fall, snowflakes-shake;
            -webkit-animation-duration: 10s, 3s;
            -webkit-animation-timing-function: linear, ease-in-out;
            -webkit-animation-iteration-count: infinite, infinite;
            -webkit-animation-play-state: running, running;
            animation-name: snowflakes-fall, snowflakes-shake;
            animation-duration: 10s, 3s;
            animation-timing-function: linear, ease-in-out;
            animation-iteration-count: infinite, infinite;
            animation-play-state: running, running;
        }

        .snowflake:nth-of-type(0) {
            left: 1%;
            -webkit-animation-delay: 0s, 0s;
            animation-delay: 0s, 0s
        }

        .snowflake:nth-of-type(1) {
            left: 10%;
            -webkit-animation-delay: 1s, 1s;
            animation-delay: 1s, 1s
        }

        .snowflake:nth-of-type(2) {
            left: 20%;
            -webkit-animation-delay: 6s, .5s;
            animation-delay: 6s, .5s
        }

        .snowflake:nth-of-type(3) {
            left: 30%;
            -webkit-animation-delay: 4s, 2s;
            animation-delay: 4s, 2s
        }

        .snowflake:nth-of-type(4) {
            left: 40%;
            -webkit-animation-delay: 2s, 2s;
            animation-delay: 2s, 2s
        }

        .snowflake:nth-of-type(5) {
            left: 50%;
            -webkit-animation-delay: 8s, 3s;
            animation-delay: 8s, 3s
        }

        .snowflake:nth-of-type(6) {
            left: 60%;
            -webkit-animation-delay: 6s, 2s;
            animation-delay: 6s, 2s
        }

        .snowflake:nth-of-type(7) {
            left: 70%;
            -webkit-animation-delay: 2.5s, 1s;
            animation-delay: 2.5s, 1s
        }

        .snowflake:nth-of-type(8) {
            left: 80%;
            -webkit-animation-delay: 1s, 0s;
            animation-delay: 1s, 0s
        }

        .snowflake:nth-of-type(9) {
            left: 90%;
            -webkit-animation-delay: 3s, 1.5s;
            animation-delay: 3s, 1.5s
        }

        .snowflake:nth-of-type(10) {
            left: 25%;
            -webkit-animation-delay: 2s, 0s;
            animation-delay: 2s, 0s
        }

        .snowflake:nth-of-type(11) {
            left: 65%;
            -webkit-animation-delay: 4s, 2.5s;
            animation-delay: 4s, 2.5s
        }
    </style>
@endsection

@section('content')
    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
    </div>
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="https://afamilycdn.com/150157425591193600/2021/1/26/slideshow3-16116361428992047502074.jpg"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">

                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="https://topprint.vn/wp-content/uploads/2021/07/banner-my-pham-dep-12-1024x390.png"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">

                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/70f3c470584061.5cdae5ace62e8.png"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="https://afamilycdn.com/2019/1/8/photo-1-15469226090321336465540.jpg"
                        alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">SĂN SALE NGAY</h6>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid"
                        src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/faa27670584061.5bd3dcfabe723.png"
                        alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">QÙA NHẬN LIỀN TAY</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('home.listProduct') }}">Sản phẩm</a>
                    <span class="breadcrumb-item active">Danh sách mã giảm giá</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-9 mb-30">
                <i class="fa fa-check" style="font-size: 40px;color: #e9d335"></i>
                <span class="text_coupon" style="font-size: 30px;font-weight: 700;">DANH SÁCH MÃ GIẢM GIÁ</span>
                <p></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Số lượng mã</th>
                            <th>Số lượng mã còn lại</th>
                            <th>Mã giảm giá</th>
                            <th>Số phần trăm - tiền giảm</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $item)
                            <tr style="color: #1f085f">

                                <td>{{ $item->coupon_name }}</td>
                                <td>{{ $item->coupon_times }}</td>
                                <td>{{ $item->remaining }}</td>
                                <td>{{ $item->coupon_code }}</td>
                                <td>{{ $item->coupon_number }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->end_time }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-lg-3 h-auto mb-30">
                <h2>Cosmetic Shop - <i style="font-size: 20px">mỹ phẩm làm đẹp</i></h2>

                <div class="container">
                    <div class="typed-out">Nhận mã khuyến mại tiết kiệm liền tay</div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="keywords" placeholder="...">
                        <div class="input-group-append">
                            <input type="submit" name="search_items" class="btn btn-info" value="Tìm Kiếm">

                        </div>
                    </div>
                </div>
                <div style="margin-top: 20px; font-size: 20px;">

                    <span><b style="color: darkred">Mã còn hạn</b><i>(áp dụng cho mọi đơn hàng):</i> </span>
                    @foreach ($couponShow as $coupon)
                        <ul style="margin-top: 20px;font-family: 'Trebuchet MS', sans-serif;">
                            <li>Mã giảm giá: {{ $coupon->coupon_code }}</li>
                        </ul>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{ $coupons->links() }}
    <!-- Shop Detail End -->
@endsection
@section('js')
@endsection
