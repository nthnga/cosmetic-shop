@extends('admin.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .btnAdd{
            position: absolute !important;
            top: 105px !important;
            right: 25px !important;
        }
        #customers > tbody > tr > td:nth-child(3),
        #customers > tbody > tr > td:nth-child(4),
        #customers > tbody > tr > td:nth-child(6),
        #customers > tbody > tr > td:nth-child(7) {
            text-align: center !important;
        }
    </style>

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
                        Tổng đơn hàng
                        <h2>{{50000000}}</h2>
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
                        Thương hiệu sản phẩm
                        <h2>{{$trademarks}}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.trademarks.index')}}">
                            Danh sách thương hiệu
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

        <h4>Đơn hàng mới nhất</h4>
        <div class="card mb-4 row">
            <div class="card-body">
                <table class="table table-striped" id="order">
                    <thead>
                      <tr>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        {{-- <th>Tên sản phẩm</th> --}}
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item) 
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->customer->name}}</td>
                                {{-- <td>{{$item->}}</td> --}}
                                <td>{{$item->total}}</td>
                                <td>{{$item->status_text}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small stretched-link" href="{{route('admin.orders.index')}}">
                        <h6><b>Đi đến đơn hàng</b></h6>
                    </a>
                    <div class="small"><i class="fa-solid fa fa-eye" style="color: brown"></i></div>
                </div>
            </div>
        </div>

        <div class="row">
            <h1>Doanh thu tháng</h1>
        </div>
    
        <div class="row">
            <h3 class="mt-4 title_thongkedoanhso" style="text-align: center; color:rgb(100, 230, 237);">---Biểu đồ thống kê doanh số---</h3>
            <form action="" autocomplete="off" style="margin-right: 20px; display:flex;" method="POST">
                @csrf
                <div class="col-md-2" style="margin-right: 20px;">
                    <p>Từ ngày: <input type="text" id="datepicker1" class="form-control"></p>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                </div>
                <div class="col-md-2" style="margin-right:20px;">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                    
                </div>
                <div class="col-md-2">
                    <p>Lọc theo
                        <select name="" class="dashboard-filter form-control" >
                            <option>Chọn</option>
                            <option value="week">Thống kê 7 ngày</option>
                            <option value="lastmonth">Thống kê tháng trước</option>
                            <option value="thismonth">Thống kê tháng hiện tại</option>
                            <option value="year">Thống kê theo năm</option>
                        </select>
                    </p>
                </div>
                
            </form>
            <p></p>
            <div class="col-md-12">
                <div id="chart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
@endsection
@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    $(document).ready(function (){

        chart30daysorder();

        var chart = new Morris.Area({
            // ID of the element in which to draw the chart.
            element: 'chart',

            lineColors:['#819C79','#fc8710','#FF6541','#A4ADD3','#766B56'],

            //3 cái dưới dùng cho Line, Area 
            
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['blue'],
            fillOpacity: 0.3,
            hideHover:'auto',
            parseTime: false,
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['order','revenue','profit','quantity'],
            behaveLikeLine: true,
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
            });

        $( "#datepicker1" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"],
            duration: "slow"
        });

        $( "#datepicker2" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"],
            duration: "slow"
        });

        function chart30daysorder(){
            var _token = $('input[ name = "_token" ]').val();
            $.ajax({
                url:"{{route('admin.dashboard.daysOrder')}}",
                method:"POST",
                dataType:"JSON",
                data:{_token:_token},

                success:function(data)
                    {
                        chart.setData(data);
                    }
            });
        }

        $('#btn-dashboard-filter').click(function(){
            // alert('suscessful');
            var _token = $('input[ name = "_token" ]').val();
            var from_date = $('#datepicker1').val();
            var to_date = $('#datepicker2').val();
            // alert(from_date);
            // alert(to_date);

            $.ajax({
                url:"{{route('admin.dashboard.filterByDate')}}",
                method:"POST",
                dataType:"JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token},

                success:function(data)
                    {
                        chart.setData(data);
                    }
            });
        });

        $('.dashboard-filter').change(function(){
            
            var dashboard_value = $(this).val();
            var _token = $('input[ name = "_token" ]').val();
            
            // alert(dashboard_value);

            $.ajax({
                // _token: "{{ csrf_token() }}",
                url:"{{route('admin.dashboard.dashboardfilter')}}",
                method:"POST",
                dataType:"JSON",
                data:{dashboard_value:dashboard_value,_token:_token},

                success:function(data)
                    {
                        chart.setData(data);
                    }
            });
        });
    });
    
</script>
@endsection
