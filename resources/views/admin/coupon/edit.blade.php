@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa mã giảm giá
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Chỉnh sửa mã giảm giá</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.coupon.index')}}">Mã giảm giá</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa mã giảm giá</li>
        </ol>
    </div>
    <form id="" class="form" action="{{route('admin.coupon.update',$coupon->id)}}" method="post" style="width: 96%!important; margin: 2%" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="mb-10 fv-row">
                            <label class="form-label">Tên mã giảm giá:</label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_name" class="form-control mb-2" placeholder="Nhập tên..." value="@if(!empty(old("coupon_name"))){{old("coupon_name")}}@else {{$coupon->coupon_name}}@endif" />
                            @error('coupon_name')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Mã giảm giá: </label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_code" class="form-control mb-2" placeholder="Nhập tên..." value="@if(!empty(old("coupon_code"))){{old("coupon_code")}}@else {{$coupon->coupon_code}}@endif" />                            
                            @error('coupon_code')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Số lượng mã giảm giá: </label><span style="color: red;"> *</span>
                            <select name="coupon_condition" class="form-control mb-2">
                                <option value="">-----Chọn-----</option>
                                <option value="">---Giảm theo phần trăm---</option>
                                <option value="">---Giảm theo tiền mặt---</option>
                            </select>
                            @error('coupon_condtion')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Nhập số % hoặc số tiền giảm: </label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_number" class="form-control mb-2" placeholder="Nhập tên..." value="@if(!empty(old("coupon_number"))){{old("coupon_number")}}@else {{$coupon->coupon_number}}@endif" />                            
                            @error('coupon_number')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="margin-top: 20px">
                <a href="{{route('admin.coupon.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-3">Huỷ</a>
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Lưu</span>
                </button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
