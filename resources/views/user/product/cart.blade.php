@extends('user.layouts.master')

@section('title')
    Giỏ hàng
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('home.listProduct') }}">Sản phẩm</a>
                    <span class="breadcrumb-item active">Giỏ hàng</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá (VNĐ)</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Hủy</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" style="text-align: left">
                        @foreach ($items as $item)
                            <tr>
                                <td class="align-middle"><img
                                        src="{{ url(\Illuminate\Support\Facades\Storage::url($item->options->image)) }}"
                                        alt="img" style="width: 50px;">{{ $item->name }}</td>
                                <td class="align-middle">{{ number_format($item->price, 0, '.', '.') }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <form action="{{ route('user.product.decrement', ['id' => $item->rowId]) }}"
                                                method="GET">
                                                <button id="decrement" class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $item->qty }}" min="1">
                                        <div class="input-group-btn">
                                            <form action="{{ route('user.product.increment', ['id' => $item->rowId]) }}"
                                                method="GET">
                                                <button id="increment" class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ number_format($item->price * $item->qty, 0, '.', '.') }}</td>
                                <td class="align-middle"><a class="btn btn-sm btn-danger"
                                        href="{{ route('user.product.remove', ['id' => $item->rowId]) }}"><i
                                            class="fa fa-times"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" method="GET" action="{{ route('user.product.checkcoupon') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" name="coupon" 
                        @if (Session::get('coupon')) value="{{Session::get('coupon')[0]['coupon_code']}}" @endif
                            placeholder="Nhập mã giảm giá">
                        <input type="submit" class="btn btn-primary check_coupon" name="check_coupon"
                            value="Áp dụng mã giảm giá">
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Tóm tắt giỏ
                        hàng</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        @php
                            $total_cart = (int) Cart::subtotal(null, null, '');
                            $percent_sale = 0;
                            $total_coupon = 0;
                            $total_money = $total_cart - $total_coupon;
                           
                        @endphp

                        @if (Session::get('coupon'))
                            @foreach (Session::get('coupon') as $key => $cou)
                                @php
                                    if ($cou['coupon_condition'] == 1) {
                                        $percent_sale = (int) $cou['coupon_number'];
                                        $total_coupon = ($total_cart * ((int) $cou['coupon_number'])) / 100;
                                    } else {
                                        $total_coupon = $cou['coupon_number'];
                                    }
                                    $total_money = $total_cart - $total_coupon;
                                @endphp
                            @endforeach
                            
                        @endif
                        
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Tổng tiền</h6>
                            <h6>{{ number_format($total_cart) }}</h6>
                            
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tiết kiệm</h6>
                            <h6 class="font-weight-medium">{{ number_format($total_coupon) }}
                                @if ($percent_sale)
                                    {{-- ({{$percent_sale}}%) --}}
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Số tiền phải thanh toán</h5>
                            <h5>{{ number_format($total_money) }}</h5>
                        </div>
                        <a class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                            href="{{ route('home.checkout') }}">Mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection

@section('js')
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (Session::has('message'))
        <script>
            toastr.success("{!! session()->get('message') !!}");
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.error("{!! session()->get('error') !!}");
        </script>
    @endif

@endsection

{{-- @section('js')
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
    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endsection --}}
