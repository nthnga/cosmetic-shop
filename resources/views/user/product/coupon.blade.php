@extends('user.layouts.master')

@section('title')
    Tất cả sản phẩm
@endsection

@section('css')
@endsection

@section('content')
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
                <span>DANH SÁCH MÃ GIẢM GIÁ</span>
                <p></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Số lượng mã</th>
                            <th>Mã giảm giá</th>
                            <th>Số phần trăm - tiền giảm</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $item)
                        <tr>
                           
                                <td>{{ $item->coupon_name }}</td>
                                <td>{{ $item->coupon_times }}</td>
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
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo amet libero tenetur mollitia nisi
                    omnis debitis non, a modi autem.</p>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection
@section('js')
@endsection
