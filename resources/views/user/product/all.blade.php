@extends('user.layouts.master')

@section('title')
    Tất cả sản phẩm
@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
    </style>
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <span class="breadcrumb-item active">Sản phẩm</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-4">
                @foreach ($trademark_name as $name)
                @endforeach
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Lọc theo
                        thương hiệu</span></h5>
                <div class="bg-light p-4 mb-30">
                    @php
                        $trademark_id = [];
                        $trademark_arr = [];
                        
                        $checked = [];
                        if (isset($_GET['trademark'])) {
                            $id = $_GET['trademark'];
                        } else {
                            $id = $name->trademark_id . ',';
                        }
                        $trademark_arr = explode(',', $id);
                    @endphp
                    @foreach ($trademarks as $trademark)
                        <div class="custom-control mb-3" style="padding-left: 0px;">
                            <input type="checkbox" {{ in_array($trademark->id, $trademark_arr) ? 'checked' : '' }}
                                class="filter_trademark" name="filter_trademark" data-filters="trademark"
                                value="{{ $trademark->id }}" />
                            <label>{{ $trademark->name }}</label>
                        </div>
                    @endforeach
                </div>

                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Lọc theo
                        giá</span></h5>
                <div class="shop-grid-button d-flex align-items-center">
                    <form method="get" action="{{ route('home.listProduct') }}">
                        @csrf
                        <div class="price-filter mt-10">
                            <div class="price-slider-amount" style="margin-bottom: 20px">
                                <input value="{{ $amount_start }}" type="text" id="amount_start" name="amount_start"
                                    readonly placeholder="Chọn khoảng giá" style="border: none; color: black">
                                <input value="{{ $amount_end }}" type="text" id="amount_end" name="amount_end" readonly
                                    placeholder="Chọn khoảng giá" style="border: none; color: black">

                                <input type="hidden" id="start_price">
                                <input type="hidden" id="end_price">

                            </div>
                            <div id="slider-range"></div>
                        </div>
                        <input type="submit" name="filter_price" value="Lọc" class="btn-primary"
                            style="margin-top: 30px; width: 80px; border: none">

                    </form>
                </div>
                <div id="slider-range"></div>
                <!-- Price End -->
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" name="sort" id="sort"
                                        class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sắp xếp</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form>
                                            @csrf
                                            {{-- <a class="dropdown-item"
                                                href="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=none">
                                                <---Sắp xếp theo--->
                                            </a> --}}
                                            <a class="dropdown-item"
                                                href="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=tang_dan">
                                                <---Gía thấp đến cao--->
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=giam_dan">
                                                <---Gía cao đến thấp--->
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=kytu_az">
                                                <---SX theo tên từ A-Z--->
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=kytu_za">
                                                <---SX theo tên từ Z-A--->
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 product">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <div class="content">
                                        <div class="_3LjrMb yHNF9n BKTD5e shopee-badge">
                                            <div class="R6rql6">
                                                <span class="percent">{{ round(((($product->sale_price + 50000) - $product->sale_price)/($product->sale_price + 50000))*100) }}%</span>
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
                                                href="{{ route('home.show', $product->id) }}"><i
                                                    class="far fa-eye"></i></a>
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
                                        <h5 style="color: #d93232;font-size: 25px;"><b style="font-size: 18px;
                                            text-decoration: underline;">đ</b>{{number_format($product->sale_price,0, ',', '.')}}</h5>
                                        <h6 class="text-muted ml-2"><del style="margin-right: 15px;color: #d7bbbb;">{{number_format($product->sale_price+50000,0, ',', '.')}}đ</del></h6>
                                        <p style="margin: 0 15px;"><b>Đã bán: </b>{{$product->sold}} </p>
                                    </div>
                                    <div>
                                        <span class="fee_ship"
                                        style="font-family: Courier New"><i class='fa fa-truck' style="font-size: 15px;color: #0b7a8b;"></i> Miễn phí vận chuyển</span>
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
            <!-- Shop Product End -->
        </div>
        {{ $products->links() }}
    </div>
@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                alert(url);
                // if(url){
                //     window.location = url;
                // }
                // return fales;
            });

            $('.filter_trademark').click(function() {
                var trademark = [],
                    tempArray = [];
                $.each($("[data-filters='trademark']:checked"), function() {
                    tempArray.push($(this).val());
                });
                tempArray.reverse();
                if (tempArray.length !== 0) {
                    trademark += '?trademark=' + tempArray.toString();
                }
                window.location.href = trademark;
            });

            $('.filter_category').click(function() {
                var category = [],
                    tempArray = [];
                $.each($("[data-filters='category']:checked"), function() {
                    tempArray.push($(this).val());
                });
                tempArray.reverse();
                if (tempArray.length !== 0) {
                    category += '?category=' + tempArray.toString();
                }
                window.location.href = category;
            });

            let min = $("#amount_start").val();
            // console.log(min);
            let max = $("#amount_end").val();

            $("#slider-range").slider({
                // orientation: "vertical",
                // range: true,

                min: 0,
                max: 1000000,
                step: 10000,
                values: (min > 0 && max > 0) ? [min, max] : [{{ 0 + 50000 }}, {{ 200000 - 100000 }}],
                // values: [600000, 700000],
                slide: function(event, ui) {
                    $("#amount_start").val(ui.values[0]);
                    $("#amount_end").val(ui.values[1]);


                    $("#start_price").val(ui.values[0]);
                    $("#end_price").val(ui.values[1]);

                }
            });
            // $( "#amount_start" ).val($("#silder-range").slider("values", 0)+'vnđ');
            // $( "#amount_end" ).val($("#silder-range").slider("values", 1)+'vnđ');
            // $( "#amount_end" ).val( "đ" + $( "#slider-range" ).slider( "values", 0 ) +
            //     " - đ" + $( "#slider-range" ).slider( "values", 1 ) );
        });
    </script>
@endsection
@endsection
