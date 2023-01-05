<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    .coupon{
        border: 5px dotted #bbb;
        width: 80%;
        border-radius: 15px;
        margin: 0 auto;
        max-width: 600px;;
    }

    .container{
        padding: 2px 16px;
        background-color: #f1f1f1;
    }
    .textcode{
        background: #ccc;
        padding: 3px;
    }

    .expire{
        color: red;
    }
    p.code{
        text-align: center;
        font-size: 20px;
    } 
    p.expire{
        text-align: center;
    }
    h2.note{
        text-align: center;
        font-size: large;
        text-decoration: underline;
    }
</style>
<body>
    <div class="coupon">
        <div class="container">
            <h3>Mã khuyến mại từ shop <a  target="_blank" href="http://127.0.0.1:8000/">Cosmetic Shop</a></h3>
        </div>
        <div class="container" style="background-color: white;">
            <h2 class="note"><b><i>Chương trình khuyến mại dành cho khách hàng 1</i></b></h2>
            <p>Qúy khách đã từng mua hàng tại shop bán mỹ phẩm <a  target="_blank" href="http://127.0.0.1:8000/">Cosmetic Shop</a> . Nếu đã có tài khoản mua hàng
            quý khác vui lòng đăng nhập và sử dụng mã code bên dưới để được giảm giá. Xin cảm ơn quý khách đã tin tưởng và ủng hộ.
            Chúc quý khách một ngày tốt lành
            </p>
        </div>
        <div class="container">
            <p class="code">Mã code của quý khách <span class="textcode">KMT12</span></p>
            <p class="expire">Mã sử dụng trong 5 ngày kể thừ ngày bắt đầu </p>
        </div>
    </div>
</body>
</html>