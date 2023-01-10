
@section('css')
<style>
    
</style>
@endsection
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Danh mục</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100 overflow-hidden " style="background-color: rgb(182, 189, 145) ">
                    @foreach($categories as $category)
                        <a href=" " class="nav-item nav-link btn" 
                        onclick="route('home.listProduct', ['category_id'  => $category->id])" style="color: rgb(16, 16, 149); font-size:20px;">{{$category->name}}</a>
                    
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Cosmetic</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('home')}}" class="nav-item nav-link">Trang chủ</a>
                        <a href="{{route('home.listProduct')}}" class="nav-item nav-link">Sản phẩm</a>
                        <a href="{{route('home.coupon')}}" class="nav-item nav-link">Mã giảm giá</a>
                        <a href="/contact" class="nav-item nav-link">Liên hệ</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="" class="btn px-0 ml-3">
                            <a class="fas fa-shopping-cart text-primary" href="{{route('user.product.cart')}}"></a>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
