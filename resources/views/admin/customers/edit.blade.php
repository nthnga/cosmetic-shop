@extends('admin.layouts.master')

@section('title')
    Cập nhật khách hàng
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cập nhật khách hàng</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.customers.index')}}">Khách hàng</a></li>
            <li class="breadcrumb-item active">Cập nhật thông tin khách hàng</li>
        </ol>
    </div>
    <form id="" class="form" action="{{route('admin.customers.update',$customer->id)}}" method="POST" style="width: 96%!important; margin: 2%">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="mb-10 fv-row">
                            <label class="form-label">Tên:</label><span style="color: red;"> *</span>
                            <input type="text" name="name" class="form-control mb-2" placeholder="Nhập tên..." value="@if(!empty(old("name"))){{old("name")}}@else {{$customer->name}}@endif" />
                            @error('name')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Email:</label><span style="color: red;"> *</span>
                            <input type="email" name="email" class="form-control mb-2" placeholder="Nhập email..." value="@if(!empty(old("email"))){{old("email")}}@else {{$customer->email}}@endif" />
                            @error('email')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Số điện thoại:</label><span style="color: red;"> *</span>
                            <input type="text" name="phone" class="form-control mb-2" placeholder="Nhập số điện thoại..." value="@if(!empty(old("phone"))){{old("phone")}}@else {{$customer->phone}}@endif" />
                            @error('phone')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Giới tính:</label><span style="color: red;"> *</span>
                            <select name="gender" class="form-select form-control" required>
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Địa chỉ: </label><span style="color: red;"> *</span>
                            <textarea class="form-control mb-2" style="width:100%;" name="address" id="" rows="4" placeholder="Nhập địa chỉ..." >@if(!empty(old("address"))){{old("address")}}@else {{$customer->address}}@endif</textarea>
                            @error('address')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="margin-top: 20px">
                <a href="{{route('admin.customers.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-3">Huỷ</a>
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Cập nhật</span>
                </button>
            </div>
        </div>
    </form>
@endsection
