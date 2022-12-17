@extends('admin.layouts.master')

@section('title')
    Danh sách bình luận
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách bình luận</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Bình luận</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped" id="comment">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên người comment</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Sản phẩm</th>
                        <th>Duyệt bình luận</th>
                        <th>Quản lý</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($comment as $key => $comm)
                        
                      <tr>
                        <td>{{$key}}</td>
                        <td>{{$comm->name}}</td>
                        <td>{{$comm->content}}</td>
                        <td>{{$comm->email}}</td>
                        <td><a href="{{route('home.show',[$comm->product->id])}}" target="_blank">{{$comm->product->name}}</a></td>
                        <td>
                            <select class="form-control select-active-comment">
                                @if($comm->status==0)
                                <option selected data-comment_id="{{$comm->id}}" value="0">Không</option>
                                <option data-comment_id="{{$comm->id}}" value="1">Có</option>
                                @else
                                <option data-comment_id="{{$comm->id}}" value="0">Không</option>
                                <option selected data-comment_id="{{$comm->id}}" value="1">Có</option>
                                @endif
                            </select>
                            
                        </td>
                        <td><a href="{{route('admin.comment.delete_comment',[$comm->id])}}" onclick="return confirm('Bạn muốn xóa bình luận này?')" class="btn btn-danger btn-sm">Xóa</a></td>
                      </tr> 

                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    <script>
        $(document).ready( function () {
            $('#comment').DataTable();
        } );    
    </script>    
    <script>
        $('.select-active-comment').change(function(){
            var value = $(this).find(':selected').val();
            var comment_id = $(this).find(':selected').data('comment_id')
            $.ajax({
                url : '{{route('admin.comment.select-active')}}',
                method: 'GET',
                data:{value:value,comment_id:comment_id},
                success:function(){
                    alert('Thay đổi trạng thái thành công.');
                    location.reload();
                }
            });

        })
    </script>
@endsection
