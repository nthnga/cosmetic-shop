@extends('admin.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
{{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Trang chủ</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><b><i>Hệ thống trang chủ website bán mỹ phẩm</i></b></li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        Tổng doanh thu
                        <h2>{{7560000}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        Đơn hàng
                        <h2>{{$orders}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.orders.index')}}">
                            Chi tiết đơn hàng
                        </a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        Sảm phẩm
                        <h2>{{$products}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.products.index')}}">Tất cả sản phẩm</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        Danh mục
                        <h2>{{$categories}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.categories.index')}}">Các hạng mục</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h3 class="mt-4 title_thongkedoanhso" style="text-align: center; color:rgb(100, 230, 237);">---Biểu đồ thống kê doanh số---</h3>
            <form action="" autocomplete="off" style="margin-right: 20px; display:flex;">
                @csrf
                <div class="col-md-2">
                    <p>Từ ngày: <input type="text" id="datepicker1" class="form-control"></p>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                </div>
                <div class="col-md-2">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                    
                </div>
                
            </form>
            <p></p>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
        </div>
    </div>
@endsection
@section('js')


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $( "#datepicker1" ).datepicker();
        $( "#datepicker2" ).datepicker();
    });
</script>
@endsection
