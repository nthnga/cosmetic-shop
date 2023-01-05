@extends('admin.layouts.master')

@section('title')
    Danh sách đơn hàng
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            margin-bottom: 20px;
        }

        #table td,
        #custabletomers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        .button {
            margin: 20px;
            align-items: center;
        }

        h4 {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Chi tiết đơn hàng</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Đơn hàng</a></li>
            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
        </ol>

        <h4>THÔNG TIN ĐƠN HÀNG</h4>
        <table id="table">
            <thead>
                <tr>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Phí ship</th>
                    <th scope="col">Mã giảm giá</th>
                    <th scope="col">Tổng thanh toán</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status_text }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->fee_ship }}</td>
                    <td>{{ $order->coupon }}</td>
                    <td>{{ (int)$order->total + (int)$order->fee_ship - (int)$order->coupon }}</td>

                </tr>
                {{-- @endforeach> --}}

            </tbody>
        </table>
        <br><br>

        <p><h4>THÔNG TIN KHÁCH HÀNG</h4></p>
        <table id="table">
            <thead>
                <tr>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->email }}</td>

                </tr>
                {{-- @endforeach> --}}

            </tbody>
        </table>
        <br><br>

      
       
        <p><h4>DANH SÁCH SẢN PHẨM</h4></p>
        <table id="table">
            <thead>
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    {{-- <th scope="col">Mã giảm giá</th>
                    <th scope="col">Phí vận chuyển</th> --}}
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($order_detail as $orderdetail) --}}
                @foreach ($order->order_details as $product)
                    <tr>

                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_quantity }}</td>

                        <td>{{ $product->product_sale_price }}</td>
                        {{-- <td>{{ $order->coupon }}</td>
                        <td>{{ $order->fee_ship }}</td> --}}
                        <td>{{ number_format($product->product_quantity*$product->product_sale_price, 0, ',', '.') }}</td>
                        <td>{{ $order->status_text }}</td>
                        <td>{{ $order->created_at }}</td>

                    </tr>
                @endforeach>

            </tbody>
        </table>
    </div>
@endsection
