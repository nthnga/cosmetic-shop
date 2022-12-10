@extends('user.layouts.master')

@section('title')
    Tất cả sản phẩm
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="{{route('home.listProduct')}}">Sản phẩm</a>
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
                        @foreach($product->images as $image)
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{$image->image_url}}" alt="ảnh">
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
                    <h3>{{$product->name}}</h3>
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
                    <h3 class="font-weight-semi-bold mb-4">{{number_format($product->sale_price,0, ',', '.') . ' '.'VNĐ'}}</h3>
                    
                    <p class="mb-4"><b>Số lượng trong giỏ hàng: </b>{{$product->quantity}}</p>
                    <p class="mb-4"><b>Danh mục: </b> {{$product->category->name}}</p>
                    <p class="mb-4"><b>Thương hiệu: </b>@if($product->trademark) {{$product->trademark->name}} @else Không có @endif</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        {{-- <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            
                        </div> --}}
                        
                        <div>
                            <a href="{{route('user.product.add', $product->id)}}" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ hàng</a>
                            <a style="margin-left: 20px" href="{{route('home.checkout',$product->id)}}" class="btn btn-primary px-3"><i class="fas fa-donate"></i> Mua ngay</a>
                        </div>
                        </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Chia sẻ:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Tin tức sản phẩm</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đánh giá (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Thông tin sản phẩm</h4>
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <style type="text/css">
                                    .style_comment{
                                        /* border-radius: 10px;
                                        border: 1px solid #ddd; */
                                        height: 115px;
                                    }
                                </style>
                                <div class=" row col-md-6 style_comment">
                                    <div class="col-md-2">
                                        <img width="100%" height="115px;" src="{{asset('/storage/images/products/cera.jpg')}}" class="img img-reponsive img-thumbnail">
                                    </div>
                                    <div class="col-md-10">
                                        <p style="color: rgb(255, 47, 47);">Nguyễn Nga</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore corporis facere tempora.
                                        </p>
                                    </div>
                                    <p></p>
                                    <div class="col-md-2">
                                        <img width="100%" height="115px;" src="{{asset('/storage/images/products/cera.jpg')}}" class="img img-reponsive img-thumbnail">
                                    </div>
                                    <div class="col-md-10">
                                        <p style="color: rgb(255, 47, 47);">Nguyễn Nga</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore corporis facere tempora.
                                        </p>
                                    </div>
                                </div>
                    
                               
                                <div class="col-md-6">
                                    <h4 class="mb-4">Đánh giá của bạn</h4>
                                    <small>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</small>
                                    <div class="d-flex my-3">
                                        <div class="text-primary" style="cursor: pointer; color:#ccc; font-size:30px;">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>


                                    <form>
                                        <div class="form-group">
                                            <label for="message">Nội dung *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Họ tên *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Gửi đánh giá" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
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
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm khác</span></h2>
            <div class="row px-xl-5">
                @foreach($product_news as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{route('home.show',$product->id)}}">
                                <img class=" w-100" style="height: 400px !important"   src="{{$product->images[0]->image_url}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user.product.add',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('home.show',$product->id)}}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"  href="{{route('home.show',$product->id)}}"> 
                                @php     
                                if (strlen($product->name)>50) {
                                    $str = substr($product->name, 0,50);
                                    $product->name =  $str. '...';
                                };
                                @endphp
                                {{$product->name}}
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{number_format($product->sale_price,0, ',', '.')}}</h5><h6 class="text-muted ml-2"><del>{{number_format($product->sale_price+50000,0, ',', '.')}}</del></h6>
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
                </div>
            @endforeach
            </div>
        </div>
        <!-- Products End -->
@endsection
@section('js')
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(Session::has('success'))
        <script>
            toastr.success("{!! session()->get('success') !!}");
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.error("{!! session()->get('error') !!}");
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection
