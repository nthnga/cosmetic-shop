@extends('user.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .content {
            position: absolute;
            right: 0;
        }

        .content:hover {
            cursor: pointer;
        }

        .percent {
            margin: 7px;
            font-weight: bold;
            font-size: 15px;
        }

        .down {
            color: white;
            font-weight: bold;
            font-size: 13px;
        }

        .BKTD5e {
            background-color: rgba(255, 212, 36, 0.9);
        }

        .BKTD5e::after {
            content: "";
            width: 14px;
            height: 3px;
            left: 0px;
            bottom: -11px;
            position: absolute;
            border-color: transparent rgba(255, 212, 36, 0.9);
            border-style: solid;
            border-width: 0px 23px 11px;
        }

        .yHNF9n {
            width: 45px;
            height: 55px;
        }

        ._3LjrMb {
            display: inline-block;
            box-sizing: border-box;
            position: relative;
            padding: 4px 2px 3px;
            font-weight: 700;
        }

        .R6rql6 {
            display: flex;
            flex-direction: column;
            text-align: center;
            position: relative;
            font-weight: 400;
            line-height: 0.8125rem;
            color: rgb(238, 77, 45);
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .outline {
            cursor: pointer;
            position: relative;
            padding: 10px 20px;
            background: white;
            font-size: 18px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            transition: all 1s;
        }

        .outline:after,
        .outline:before {
            content: " ";
            width: 10px;
            height: 10px;
            position: absolute;
            border: 0px solid #fff;
            transition: all 1s;
        }

        .outline:after {
            top: -1px;
            left: -1px;
            border-top: 3px solid rgb(85, 189, 15);
            border-left: 3px solid rgb(197, 88, 25);
        }

        .outline:before {
            bottom: -1px;
            right: -1px;
            border-bottom: 2px solid rgb(148, 9, 95);
            border-right: 2px solid rgb(17, 130, 175);
        }

        .outline:hover {
            border-top-right-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .outline:hover:before,
        .outline:hover:after {
            width: 100%;
            height: 100%;
        }

        @-webkit-keyframes my {
            0% {
                color: #0f93a5;
            }

            50% {
                color: rgb(18, 179, 66);
            }

            100% {
                color: #0b7f94;
            }
        }

        @-moz-keyframes my {
            0% {
                color: #107688;
            }

            50% {
                color: rgb(18, 182, 40);
            }

            100% {
                color: #155f81;
            }
        }

        @-o-keyframes my {
            0% {
                color: #0d677e;
            }

            50% {
                color: rgb(19, 204, 34);
            }

            100% {
                color: #10718a;
            }
        }

        @keyframes my {
            0% {
                color: #0e7183;
            }

            50% {
                color: rgb(18, 197, 48);
            }

            100% {
                color: #0b5c75;
            }
        }

        .fee_ship {
            /* background:#3d3d3d; */

            -webkit-animation: my 700ms infinite;
            -moz-animation: my 700ms infinite;
            -o-animation: my 700ms infinite;
            animation: my 700ms infinite;
        }

        .center-outer {
            display: table;
            width: 100%;
            height: 100%;
        }

        .center-inner {
            display: table-cell;
            vertical-align: middle;
        }

        /* Essential CSS - Makes the effect work */


        .bubbles {
            display: inline-block;
            font-family: arial;
            position: relative;
        }

        .bubbles h1 {
            position: relative;
            margin: 1em 0 0;
            font-family: 'Luckiest Guy', cursive;
            color: #fff;
            z-index: 2;
        }

        .individual-bubble {
            position: absolute;
            border-radius: 100%;
            bottom: 10px;
            background-color: rgb(175, 24, 24);
            z-index: 1;
        }
    </style>
@endsection

@section('content')
    <!-- Carousel Start -->
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
                                src="https://img3.thuthuatphanmem.vn/uploads/2019/09/16/anh-quang-cao-banner-cho-my-pham_083547066.jpg"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Mỹ phẩm
                                        chính hãng</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Mỹ phẩm chính hãng nam nữ
                                        nhập khẩu</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="https://topprint.vn/wp-content/uploads/2021/07/banner-my-pham-dep-8.jpg"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Vẻ đẹp vượt
                                        thời gian</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Mỹ phẩm Hàn Quốc, Anh, Pháp,
                                        Đức, Mỹ, nội địa Trung nhập khẩu, xách tay</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="https://bizweb.dktcdn.net/100/376/405/files/nhuong-quyen-gia-cong-my-pham-blog-coanmy-5-266bfc33-a35b-46d7-b0a2-9f8c3816676b.jpg?v=1596804140468"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Chăm sóc làn
                                        da của bạn</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Thương hiệu nổi tiếng như:
                                        Clinique, Givenchy, Lancome, Whoo,..</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid"
                        src="https://img.lovepik.com/background/20211022/medium/lovepik-cosmetics-red-background-beautiful-poster-banner-image_605629266.jpg"
                        alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">HÃY ĐẾN VỚI CHÚNG TÔI</h6>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid"
                        src="https://img4.thuthuatphanmem.vn/uploads/2020/12/25/anh-bia-my-pham-cosmetics-cuc-dep_094446811.jpg"
                        alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">LUÔN TẠO NIỀM TIN</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3" style="cursor: pointer;">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4 outline" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0 text">Sản phẩm chất lượng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4 outline" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0 ">Miễn phí vận chuyển</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4 outline" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0 ">Hoàn hàng sau 3 ngày</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4 outline" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0 ">Hỗ trợ mọi khung giờ</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        {{-- <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm bán
                chạy</span></h2> --}}

        <div class="center-outer">
            <div class="center-inner">

                <div class="bubbles">
                    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                        <span class="bg-secondary pr-3">Sản phẩm bán chạy</span>
                    </h2>
                </div>

            </div>
        </div>
        <div class="row px-xl-5">
            @foreach ($product_sellings as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <div class="content">
                                <div class="_3LjrMb yHNF9n BKTD5e shopee-badge">
                                    <div class="R6rql6">
                                        <span
                                            class="percent">{{ round((($product->sale_price + 50000 - $product->sale_price) / ($product->sale_price + 50000)) * 100) }}%</span>
                                        <span class="down">Giảm</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('home.show', $product->id) }}">
                                <img class="w-100" style="height: 400px !important"
                                    src="{{ $product->images[0]->image_url }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user.product.add', $product->id) }}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('home.show', $product->id) }}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-sync-alt"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="{{ route('home.show', $product->id) }}">
                                @php
                                    if (strlen($product->name) > 50) {
                                        $str = substr($product->name, 0, 50);
                                        $product->name = $str . '...';
                                    }
                                @endphp
                                {{ $product->name }}
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5 style="color: #d93232;font-size: 25px;"><b
                                        style="font-size: 18px;text-decoration: underline;">đ</b>{{ number_format($product->sale_price, 0, ',', '.') }}
                                </h5>
                                <h6 class="text-muted ml-2"><del
                                        style="margin-right: 15px;color: #d7bbbb;">{{ number_format($product->sale_price + 50000, 0, ',', '.') }}đ</del>
                                </h6>
                                <p style="margin: 0 15px;"><b>Đã bán: </b>{{ $product->sold }} </p>
                            </div>
                            <div>
                                <span class="fee_ship" style="font-family: Courier New"><i class='fa fa-truck'
                                        style="font-size: 15px;color: #0b7a8b;"></i> Miễn phí vận chuyển</span>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-center mb-1">
                                {{-- <ul class="d-flex flex-row list-inline" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        @php
                                            if ($count <= $product->avg_rating) {
                                                $color = 'color:#ffcc00;';
                                            } else {
                                                $color = 'color:#ccc;';
                                            }
                                            
                                        @endphp

                                        @php
                                            $color = '#ccc';
                                        @endphp
                                        <li title="star_rating" id="{{ $product->id }}-{{ $count }}"
                                            data-index="{{ $count }}" data-product_id="{{ $product->id }}"
                                            data-rating="{{ $product->avg_rating }}" class="rating"
                                            style="cursor:pointer; color: {{ $color }}; font-size:20px;">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                                <small>({{ $product->rating_count }})</small> --}}
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small>(5)</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm
                mới</span></h2>
        <div class="row px-xl-5">
            @foreach ($product_news as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <div class="content">
                                <div class="_3LjrMb yHNF9n BKTD5e shopee-badge">
                                    <div class="R6rql6">
                                        <span
                                            class="percent">{{ round((($product->sale_price + 50000 - $product->sale_price) / ($product->sale_price + 50000)) * 100) }}%</span>
                                        <span class="down">Giảm</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('home.show', $product->id) }}">
                                <img class=" w-100" style="height: 400px !important"
                                    src="{{ $product->images[0]->image_url }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user.product.add', $product->id) }}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('home.show', $product->id) }}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-sync-alt"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="{{ route('home.show', $product->id) }}">
                                @php
                                    if (strlen($product->name) > 50) {
                                        $str = substr($product->name, 0, 50);
                                        $product->name = $str . '...';
                                    }
                                @endphp
                                {{ $product->name }}
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5 style="color: #d93232;font-size: 25px;"><b
                                        style="font-size: 18px;
                                    text-decoration: underline;">đ</b>{{ number_format($product->sale_price, 0, ',', '.') }}
                                </h5>
                                <h6 class="text-muted ml-2"><del
                                        style="margin-right: 15px;color: #d7bbbb;">{{ number_format($product->sale_price + 50000, 0, ',', '.') }}đ</del>
                                </h6>
                                <p style="margin: 0 15px;"><b>Đã bán: </b>{{ $product->sold }} </p>
                            </div>
                            <div>
                                <span class="fee_ship" style="font-family: Courier New"><i class='fa fa-truck'
                                        style="font-size: 15px;color: #0b7a8b;"></i> Miễn phí vận chuyển</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                {{-- <ul class="d-flex flex-row list-inline" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        @php
                                            if ($count <= $product->avg_rating) {
                                                $color = 'color:#ffcc00;';
                                            } else {
                                                $color = 'color:#ccc;';
                                            }
                                            
                                        @endphp

                                        @php
                                            $color = '#ccc';
                                        @endphp
                                        <li title="star_rating" id="{{ $product->id }}-{{ $count }}"
                                            data-index="{{ $count }}" data-product_id="{{ $product->id }}"
                                            data-rating="{{ $product->avg_rating }}" class="rating"
                                            style="cursor:pointer; color: {{ $color }}; font-size:20px;">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                                <small>({{ $product->rating_count }})</small> --}}
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small class="far fa-star text-primary mr-1"></small>
                                <small>(10)</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach ($trademarks as $trademark)
                        <div class="bg-light p-4">
                            <img {{ $trademark->images }} alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Products End -->
@endsection
@section('js')
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (Session::has('success'))
        <script>
            toastr.success("{!! session()->get('success') !!}");
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.error("{!! session()->get('error') !!}");
        </script>
    @endif

    <script>
        jQuery(document).ready(function($) {

            // Define a blank array for the effect positions. This will be populated based on width of the title.
            var bArray = [];
            // Define a size array, this will be used to vary bubble sizes
            var sArray = [4, 6, 8, 10];

            // Push the header width values to bArray
            for (var i = 0; i < $('.bubbles').width(); i++) {
                bArray.push(i);
            }

            // Function to select random array element
            // Used within the setInterval a few times
            function randomValue(arr) {
                return arr[Math.floor(Math.random() * arr.length)];
            }

            // setInterval function used to create new bubble every 350 milliseconds
            setInterval(function() {

                // Get a random size, defined as variable so it can be used for both width and height
                var size = randomValue(sArray);
                // New bubble appeneded to div with it's size and left position being set inline
                // Left value is set through getting a random value from bArray
                $('.bubbles').append('<div class="individual-bubble" style="left: ' + randomValue(bArray) +
                    'px; width: ' + size + 'px; height:' + size + 'px;"></div>');

                // Animate each bubble to the top (bottom 100%) and reduce opacity as it moves
                // Callback function used to remove finsihed animations from the page
                $('.individual-bubble').animate({
                    'bottom': '100%',
                    'opacity': '-=0.7'
                }, 3000, function() {
                    $(this).remove()
                });


            }, 350);

        });
    </script>
@endsection
