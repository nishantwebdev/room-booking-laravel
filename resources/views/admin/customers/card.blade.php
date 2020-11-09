<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        .icard{
            max-height: 144px !important;
            max-width: 280px !important;
        }
        td {
            margin-top: 10px;
            padding: 3px 10px;
        }
        tr{
            margin: 2px;
            line-height: 1.0;
        }
        table{
            /* border: 2px solid black; */
            padding:10px;
        }
        .image-box{
            border: 1px solid black;
        }

        .page {
            max-width: 300px;
            margin: auto;
            background: white;
            padding: 10px;
        }
    </style>


</head>
<body>
<div class="container">
    <div class="row page">
        <div class="col-md-3"></div>
        <div class="col-md-6 icard">
            <table style="font-size: 10px">
                <tr>
                    <td>નામ:</td>
                    <td colspan="3">{{$data['first_name']}} {{$data['last_name']}}</td>
                </tr>
                <tr>
                    <td>વિંગ</td>
                    <td colspan="3">{{$data['wing_no']}} : NEW {{-- : {{  $data['building_name']}} --}} </td>


                </tr>
                <tr>
                    <td>રૂમ</td>
                    <td>{{$data['room_number']}}</td>
                    <td>ફોન.:</td>
                    <td>{{$data['phone']}}</td>

                </tr>




            </table>
            <div style="width:280px;font-size: 10px;padding-top: 10px;display: inline-block;" >
              <div style="width:50%;text-align:center;float: left;">
                {{ $data['category_name'] }}@if($data['c_image']) <img src="{{URL::to('public/images/category/'.$data['c_image'])}}" height="20px" width="20px" style="margin-top: -10px">@endif
                <br><img src="{{URL::to('public/images/qr/'.$data['qr_code'])}}" height="120px" width="120px"></div>
              <div style="width:50%;text-align:left;float: left;">
                <?php
                  $user_image = ($data['image'] === null)?URL::to('public/images/category/default.png') : URL::to('public/images/user/'.$data['image']);

                 ?>
                <img src="{{ $user_image }}" height="80px" width="80px" class="image-box">
                <p>ID - {{ $data['id'] }}</p>
              </div>
            </div>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>
<script>
    $(document).ready(function () {
        window.print();
    })
</script>
</body>

</html>
