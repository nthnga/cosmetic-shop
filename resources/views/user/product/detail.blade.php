@extends('user.layouts.master')

@section('title')
    Tất cả sản phẩm
@endsection

@section('css')
    <style>
        .list_start i:hover {
            cursor: pointer;
        }

        .list_text {
            display: inline-block;
            margin-left: 10px;
            position: relative;
            background: #52b858;
            color: #fff;
            padding: 2px 8px;
            box-sizing: border-box;
            font-size: 12px;
            border-radius: 3px;
            height: 22px;
            display: none;
        }

        .list_text::after {
            right: 100%;
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: rgba(82, 184, 88, 0);
            border-right-color: #52b858;
            border-width: 6px;
            margin-top: -6px;
        }

        .list_start .rating_active {
            color: #ff9705;
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
                    <span class="breadcrumb-item active">Chi tiết sản phẩm</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @foreach ($product->images as $image)
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="{{ $image->image_url }}" alt="ảnh">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Đánh giá)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">
                        {{ number_format($product->sale_price, 0, ',', '.') . ' ' . 'VNĐ' }}
                    </h3>
                    <p class="mb-4"><b>Số lượng trong kho còn: </b>{{ $product->quantity }} sản phẩm</p>
                    <p class="mb-4"><b>Danh mục: </b> {{ $product->category->name }}</p>
                    <p class="mb-4"><b>Thương hiệu: </b>
                        @if ($product->trademark)
                            {{ $product->trademark->name }}
                        @else
                            Không có
                        @endif
                    </p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <form action="{{ route('user.product.add', $product->id) }}">
                            @csrf
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" name="qty" class="form-control bg-secondary border-0 text-center"
                                    value="1">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="button-add" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>
                                    Thêm vào giỏ hàng</a>
                                    {{-- <a style="margin-left: 20px" href="{{route('home.checkout',$product->id)}}" class="btn btn-primary px-3"><i class="fas fa-donate"></i> Mua ngay</a> --}}
                            </div>
                        </form>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Chia sẻ:</strong>
                        <div class="d-inline-flex">
                            {{-- Share facebook --}}
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0"
                                nonce="yfnSEM3o"></script>
                            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                                data-layout="button_count" data-size="large"><a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                    class="fb-xfbml-parse-ignore">Chia sẻ</a>
                            </div>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="component_rating" style="margin-botton: 20px;">
                        <p><h5>Số lượng đã đánh giá</h5></p>
                        <div class="component_rating_content" style="display: flex; align-items: center;border: 1px solid #dedede ;border-radius: 10px">
                            <div class="rating_item" style="width: 20%; position: relative;">
                                <span class="fa fa-star" style="font-size: 80px; color: #ff9765; display: block; margin: 0 auto; text-align: center;"></span><b style="position: absolute; top: 52%; left: 50%; 
                                transform:translateX(-50%) translateY(-50%); color:white; font-size: 25px; ">2.5</b>
                            </div>
                            <div class="list_rating" style="width: 60%; padding: 20px">
                                @for ($count = 1; $count <= 5; $count++)
                                    <div class="item_rating" style="display: flex; align-items: center;">
                                            <div style="width: 10%; font-size:14px">
                                                {{$count}}<span class="fa fa-star"></span>
                                            </div>
                                            <div style="width: 60%; margin: 0 20px;">
                                                <span style="width: 100%; height: 10px; display: block;border-radius: 10px;border: 1px solid #dedede">
                                                    <b style="width: 30%; background-color: #f55739; display: block; height:100%; border-radius: 5px;"></b>
                                                </span>
                                            </div>
                                            <div style="width: 30%">
                                                <a href="">29 đã đánh giá</a>
                                            </div>
                                    </div>
                                
                                @endfor
                            </div>
                            <div style="width: 20%">
                                <a href="" style="width:20%; background: #288ad6; padding: 10px; color: white; border-radius: 5px;">Đánh giá của bạn</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
                        {{-- <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Tin tức sản phẩm</a> --}}
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-3">Đánh giá (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade " id="tab-pane-1">
                            <h4 class="mb-3">Thông tin sản phẩm</h4>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="tab-pane fade show active" id="tab-pane-3">
                            <div class="row">
                                <style type="text/css">
                                    .style_comment {

                                        height: 115px;
                                    }
                                </style>
                                <div class=" row col-md-6 style_comment">
                                    @foreach ($comment as $key => $comm)
                                        <div class="col-md-2">
                                            <img width="60%" height="80px;"
                                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                                                class="img img-reponsive img-thumbnail">
                                        </div>

                                        <div class="col-md-10">
                                            <p><b>{{ $comm->name }} </b><span class="item_success"><i
                                                        class="fa fa-check-circle" style="color: rgb(44, 226, 44)"></i> Đã
                                                    đánh giá {{ $comm->created_at }}</span>
                                            </p>
                                            <p>{{ $comm->content }}
                                            </p>
                                        </div>

                                        <p></p>
                                    @endforeach
                                </div>


                                <div class="col-md-6">
                                    <h4 class="mb-4">Đánh giá của bạn</h4>
                                    <div class="component_rating_content"
                                        style="display: flex; align-items: center;border: 1px solid #dedede ;border-radius: 10px">
                                        <div class="rating_item" style="width: 20%; position: relative;">
                                            <span class="fa fa-star"
                                                style="font-size: 80px; color: #ff9765; display: block; margin: 0 auto; text-align: center;"></span><b
                                                style="position: absolute; top: 52%; left: 50%; 
                                            transform:translateX(-50%) translateY(-50%); color:white; font-size: 25px; ">2.5</b>
                                        </div>
                                        <div class="list_rating" style="width: 60%; padding: 20px">
                                            @foreach ($ratingDefaut as $key => $item)
                                                <div class="item_rating" style="display: flex; align-items: center;">
                                                    <div style="width: 10%; font-size:14px; color:rgb(8, 80, 8)">
                                                        {{ $key }}<span class="fa fa-star"
                                                            style="color: #05691b"></span>
                                                    </div>
                                                    <div style="width: 60%; margin: 0 20px;">
                                                        <span
                                                            style="width: 100%; height: 10px; display: block;border-radius: 10px;border: 1px solid #dedede">
                                                            <b
                                                                style="width: {{ rand(1, 100) }}%; background-color: #f55739; display: block; height:100%; border-radius: 5px;"></b>
                                                        </span>
                                                    </div>
                                                    <div style="width: 30%;">
                                                        <a href=""
                                                            style="color: black"><b>{{ $item['count_number']}}</b> đánh
                                                            giá</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div style="width: 20%">
                                            <a href="#" class="success js_rating_action"
                                                style="width:20%; background: #288ad6; padding: 10px; color: white; border-radius: 5px;">Đánh
                                                giá</a>
                                        </div>
                                    </div>
                                    <div class="d-flex my-3 form_rating" style="display:flex; margin-top: 15px; height: 70px;">
                                        <style>
                                            ul.list-inline.rating li {
                                                display: inline;
                                            }
                                        </style>
                                        <span style="line-height: 70px;margin-right: 20px;font-size: 20px"><b>Chọn đánh giá của bạn: </b></span>
                                        <ul class="list-inline rating" title="Average Rating">
                                            
                                            @for ($count = 1; $count <= 5; $count++)
                                                @php
                                                    if ($count <= $rating) {
                                                        $color = 'color:#ffcc00;';
                                                    } else {
                                                        $color = 'color:#ccc;';
                                                    }
                                                    
                                                @endphp

                                                <li title="star_rating" id="{{ $product->id }}-{{ $count }}"
                                                    data-index="{{ $count }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-rating="{{ $rating }}" class="rating"
                                                    style="cursor:pointer; {{ $color }} font-size:40px;">&#9733;
                                                </li>
                                            @endfor

                                        </ul>
                                        {{-- <span class="list_text" style="width:50ppx; height:100px; border:10px; background-color: #f55739"></span> --}}
                                        <div>
                                            <span class="list_text" style="width:50ppx; height:100px; border:10px; background-color: #f55739"></span>
                                        </div>
                                    </div>


                                    @if (isset(Auth::guard('web')->user()->id))
                                        <form>
                                            @csrf
                                            <input type="hidden" class="product_id_comment"
                                                value="{{ $product->id }}">

                                            <input type="hidden" class="user_id_comment"
                                                value="{{ Auth::guard('web')->user()->id }}">



                                            <div class="form-group">
                                                <label for="message">Nội dung *</label>
                                                <textarea id="content_comment" name="content" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" >Họ tên *</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="name_comment" value="{{Auth::user()->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" name="email" class="form-control"
                                                    id="email_comment" value="{{Auth::user()->email}}">
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="button" value="Gửi đánh giá"
                                                    class="btn btn-primary px-3 comment-product">
                                            </div>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-warning">Đăng nhập để
                                            đánh giá</a>
                                    @endif
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="component_rating" style="margin-botton: 20px;">
                                        <p>
                                        <h5>Đánh giá sản phẩm</h5>
                                        </p>
                                        <div class="component_rating_content"
                                            style="display: flex; align-items: center;border: 1px solid #dedede ;border-radius: 10px">
                                            <div class="rating_item" style="width: 20%; position: relative;">
                                                <span class="fa fa-star"
                                                    style="font-size: 80px; color: #ff9765; display: block; margin: 0 auto; text-align: center;"></span><b
                                                    style="position: absolute; top: 52%; left: 50%; 
                                                transform:translateX(-50%) translateY(-50%); color:white; font-size: 25px; ">2.5</b>
                                            </div>
                                            <div class="list_rating" style="width: 60%; padding: 20px">
                                                @for ($count = 1; $count <= 5; $count++)
                                                    <div class="item_rating" style="display: flex; align-items: center;">
                                                        <div style="width: 10%; font-size:14px; color:rgb(8, 80, 8)">
                                                            {{ $count }}<span class="fa fa-star"
                                                                style="color: #15e442"></span>
                                                        </div>
                                                        <div style="width: 60%; margin: 0 20px;">
                                                            <span
                                                                style="width: 100%; height: 10px; display: block;border-radius: 10px;border: 1px solid #dedede">
                                                                <b
                                                                    style="width: {{ rand(1, 100) }}%; background-color: #f55739; display: block; height:100%; border-radius: 5px;"></b>
                                                            </span>
                                                        </div>
                                                        <div style="width: 30%;">
                                                            <a href=""
                                                                style="color: black"><b>{{ rand(1, 100) }}</b> đánh
                                                                giá</a>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                            <div style="width: 20%">
                                                <a href="#" class="success js_rating_action"
                                                    style="width:20%; background: #288ad6; padding: 10px; color: white; border-radius: 5px;">Đánh
                                                    giá</a>
                                            </div>
                                        </div>
                                        <?php
                                        $listRatingText = [
                                            1 => 'Không thích',
                                            2 => 'Tạm được',
                                            3 => 'Bình thường',
                                            4 => 'Rất tốt',
                                            5 => 'Tuyệt vời',
                                        ];
                                        ?>
                                        <div class="form_rating">
                                            <div class="" style="display:flex; margin-top: 15px">
                                                <p style="margin-botton: 0">Chọn đánh giá của bạn</p>
                                                <span class="list_start active" style="margin: 0 15px;">
                                                    @for ($count = 1; $count <= 5; $count++)
                                                        <i class="fa fa-star active" data-key="{{ $count }}"></i>
                                                    @endfor
                                                </span>
                                                <span class="list_text"></span>
                                            </div>

                                            @if (isset(Auth::guard('web')->user()->id))
                                                <form>
                                                    @csrf
                                                    <input type="hidden" class="product_id_comment"
                                                        value="{{ $product->id }}">

                                                    <input type="hidden" class="user_id_comment"
                                                        value="{{ Auth::guard('web')->user()->id }}">



                                                    <div class="form-group">
                                                        <label for="message">Nội dung *</label>
                                                        <textarea id="content_comment" name="content" cols="30" rows="5" class="form-control"
                                                            placeholder="Nhập nội dung đánh giá"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Họ tên *</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name_comment" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email *</label>
                                                        <input type="email" name="email" class="form-control"
                                                            id="email_comment" value="{{ Auth::user()->email }}">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <input type="button" value="Gửi đánh giá"
                                                            class="btn btn-primary px-3 comment-product">
                                                    </div>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-warning">Đăng nhập để
                                                    đánh giá</a>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm
                khác</span></h2>
        <div class="row px-xl-5">
                <div class="owl-carousel related-carousel">
                    @foreach ($product_news as $product)
                            <div class="product-item bg-light mb-4"> 
                                <div class="product-img position-relative overflow-hidden">
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
                                        <h5>{{ number_format($product->sale_price, 0, ',', '.') }}</h5>
                                        <h6 class="text-muted ml-2">
                                            <del>{{ number_format($product->sale_price + 50000, 0, ',', '.') }}</del>
                                        </h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                        </div>
                    @endforeach
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
    <script src="sweetalert2.all.min.js"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{!! session()->get('success') !!}");
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.error("{!! session()->get('error') !!}");
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
    <script>
        $(function() {
            let listStart = $(".list_start .fa");

            listRatingText = {
                1: 'Không thích',
                2: 'Tạm được',
                3: 'Bình thường',
                4: 'Rất tốt',
                5: 'Tuyệt vời',
            }

            listStart.mouseover(function() {
                let $this = $(this);
                let number = $this.attr('data-key');
                listStart.removeClass('rating_active');

                //Hiển thị sao
                $.each(listStart, function(key, value) {
                    if (key + 1 <= number) {
                        $(this).addClass('rating_active')
                    }
                })

                //Hien thi muc do đanh gia text
                $(".list_text").text('').text(listRatingText[number]).show();

                // console.log($this.attr('data-key'))
            });

            //sự kiện ẩn hiện đánh giá
            $(".js_rating_action").click(function(event) {
                let $this = $(this);
                event.preventDefault();
                if ($(this).hasClass('active')) {
                    $(this).text("Đánh giá").addClass('active').removeClass('hide');
                } else {
                    $(this).text("Đóng lại").addClass('hide').removeClass('active');
                }
            });
        });
    </script>
    <script type="text/javascript">
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }
        

        //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            // alert(index);
            // alert(product_id);
            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });
        //nhả
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            remove_background(product_id);
            //alert(rating);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //click đánh giá sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            //alert(product_id);
            $.ajax({
                url: "{{ route('insert-rating') }}",
                method: "POST",
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'done') {
                        alert("Bạn đã đánh giá " + index + " trên 5");
                    } else {
                        alert("Lỗi đánh giá");
                    }
                }
            });

        });
    </script>
    <script>
        $('.comment-product').click(function() {
            var user_id = $('.user_id_comment').val();
            var product_id = $('.product_id_comment').val();
            var name_comment = $('#name_comment').val();
            var content_comment = $('#content_comment').val();
            var email_comment = $('#email_comment').val();
            var _token = $('input[name="_token"]').val();


            // alert(name_comment);
            // alert(content_comment);
            // alert(email_comment);
            $.ajax({
                url: "{{ route('comment-product') }}",
                method: "POST",
                data: {
                    name_comment: name_comment,
                    content_comment: content_comment,
                    email_comment: email_comment,
                    user_id: user_id,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'done') {
                        alert(
                            'Cảm ơn bạn đã đánh giá,chúng tôi sẽ xem xét hiển thị đánh giá của bạn nhé'
                        );
                        $('#name_comment').val('');
                        $('#content_comment').val('');
                        $('#email_comment').val('');
                    } else {
                        alert("Lỗi đánh giá");
                    }
                }
            })
        })
    </script>
@endsection
