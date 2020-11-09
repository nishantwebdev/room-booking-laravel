<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">
    <meta name="author" content="શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">
    <meta name="keywords" content="શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">

    <!-- Title Page-->
    <title>Check IN QR Scan  | શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Icons font CSS-->
    <link href="{{ url('public/front/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
          media="all">
    <link href="{{ url('public/front/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
          media="all">
    <link href="{{ url('public/front/vendor/intlTelInput/intlTelInput.min.css') }}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
          rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('public/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('public/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('public/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('public/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('public/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('public/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('public/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('public/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ url('public/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('public/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('public/favicon/manifest.json') }}">
    <!-- Vendor CSS-->
    <link href="{{ url('public/front/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('public/front/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <style>
        .no-p{
            display: none;
        }
    </style>
    <!-- Main CSS-->
    {{--    <link href="{{ url('public/front/css/main.css') }}" rel="stylesheet" media="all">--}}
</head>
<div class="container">


<div class="row">
    <div class="col-md-12">
        <img src="{{ url('public/images/635155201.jpg')}}" alt="banner" style="width:100%">
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-4">
{{--        <section class="cameras">--}}
{{--            <h2>Cameras</h2>--}}
{{--            <ul id="cameralist">--}}

{{--            </ul>--}}
{{--        </section>--}}

        <button class="switch-on btn btn-success" >F-On</button>
        <button class="switch-off btn btn-warning" >F-Off</button>
    </div>
    <div class="col-md-8">
      <input type="number" id="user_id" class="form-control barcodeinput checkqr">
      <button onclick="submitId()" class="btn btn-default" >CHECH</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="max-height: 500px">
        <video id="preview" style="height: 300px;width: 450px;"></video>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
    </div>
</div>
<div class="container no-p">
    <div class="row">
        <div class="card text-center" style="margin: 5px" >
            <img class="card-img-top" src="" id="profile_pic" alt="Card image cap" height="150px" width="150px">
{{--            <div class="card-body">--}}
                <h5 class="card-title" style="font-size: 30px" id="name">Card title</h5>
{{--            </div>--}}
            <h6 class="text-left">Contact Info</h6>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item"><b>Phone:</b> <span id="phone"></span></li>
                <li class="list-group-item"><b>Email:</b> <span id="email"></span></li>
            </ul>
            <h6 class="text-left">Residence Info</h6>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item"><b>Address:</b> <span id="address"></span></li>
                <li class="list-group-item"><b>City:</b> <span id="city"></span></li>
                <li class="list-group-item"><b>State:</b> <span id="state"></span></li>
                <li class="list-group-item"><b>Country:</b> <span id="country"></span></li>
            </ul>
            <h6 class="text-left">Room Info</h6>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item"><b>Room No:</b> <span id="room_no"></span></li>
                <li class="list-group-item"><b>Wing No:</b> <span id="wing_no"></span></li>
                <li class="list-group-item"><b>Building Name:</b> <span id="building"></span></li>
                <li class="list-group-item"><b>Room Address:</b> <span id="room_address"></span></li>
                <li class="list-group-item"><b>Room Category:</b> <span id="room_category"></span></li>
                <li class="list-group-item"><b>Room Booked From:</b> <span id="from"></span></li>
                <li class="list-group-item"><b>Room Booked To:</b> <span id="to"></span></li>
                <li class="list-group-item"><b>Additional Info:</b> <span id="info"></span></li>
            </ul>
            <input type="hidden" name="user" class="user_id">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn btn-danger" onClick="window.location.reload()">
                Reset
            </a>
        </div>
    </div>
    <br/>
</div>


<!-- Jquery JS-->
<script src="{{ url('public/front/vendor/jquery/jquery.min.js') }}"></script>

<!-- https://rawgit.com/schmich/instascan-builds/master/instascan.min.js -->
<script src="{{ url('public/adminlte/js/instascan.min.js') }}"></script>

<!-- https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js -->
<script src="{{ url('public/adminlte/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">

    // $('.checkqr').keydown(function(event) {
    //     console.log("here change")
    //     return false;
    //     event.stopPropagation();
    // })

    function DelayExecution(f, delay) {
        var timer = null; 
        return function () {
            var context = this, args = arguments;
        
            clearTimeout(timer);
            timer = window.setTimeout(function () {
                f.apply(context, args);
            },
            delay || 300);
        };
    }
    $.fn.ConvertToBarcodeTextbox = function () {

        $(this).focus(function () { $(this).select();$(".checkqr").html(""); });

        $(this).keydown(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which); 
            
            if ($(this).val() == '') {
                keyupFiredCount = 0; 
            }  
            if (keycode == 13) {//enter key 
                $('input').blur();
                return false;
                event.stopPropagation(); 
            } 
        });

        // $(this).keyup(DelayExecution(function (event) {
        //     var keycode = (event.keyCode ? event.keyCode : event.which);  
        //         keyupFiredCount = keyupFiredCount + 1;  
        // }));

        $('.checkqr').blur(function (event) { 
            if ($(this).val() == '')
                return false;
            submitId()
        }); 
    };
    try {
        $(".barcodeinput").ConvertToBarcodeTextbox();
        if ($(".barcodeinput").val() == '')
            $(".barcodeinput").focus();
    } catch (e) { }


    function checkQr() {
        
    }

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),mirror: false });
    scanner.addListener('scan', function (content) {

        getUserContent(content)

    });
    Instascan.Camera.getCameras().then(function (cameras) {

        if (cameras.length > 0) {
            i = 0;
            html = ""
            console.log(1);
            $.each( cameras, function( key, value ) {

                html += '<li><a onclick="selectCamera('+i+')">'+ value.name+'</a></li>';
                i++;
            });

            $('#cameralist').html(html);

            scanner.start(cameras[i-1]);

        } else {
            html = '<li class="empty" >No cameras found</li>';
            $('#cameralist').html(html);
            swal("Oops!", 'No cameras found.', "error");
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });

    function selectCamera(i){

        var index = i;
        Instascan.Camera.getCameras().then(function (cameras) {
            alert(index);
            if (cameras.length > 0) {
                scanner.start(cameras[i]);
            } else {
                swal("Oops!", 'No cameras found.', "error");
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

    }



    //Test browser support
    const SUPPORTS_MEDIA_DEVICES = 'mediaDevices' in navigator;

    if (SUPPORTS_MEDIA_DEVICES) {
        //Get the environment camera (usually the second one)
        navigator.mediaDevices.enumerateDevices().then(devices => {

            const cameras = devices.filter((device) => device.kind === 'videoinput');

            if (cameras.length === 0) {
                throw 'No camera found on this device.';
            }
            const camera = cameras[cameras.length - 1];

            // Create stream and get video track
            navigator.mediaDevices.getUserMedia({
                video: {
                    deviceId: camera.deviceId,
                    facingMode: ['user', 'environment'],
                    height: {ideal: 1080},
                    width: {ideal: 1920}
                }
            }).then(stream => {
                const track = stream.getVideoTracks()[0];

                //Create image capture object and get camera capabilities
                const imageCapture = new ImageCapture(track)
                const photoCapabilities = imageCapture.getPhotoCapabilities().then(() => {

                    //todo: check if camera has a torch

                    //let there be light!
                    const btnOn = document.querySelector('.switch-on');
                    const btnOff = document.querySelector('.switch-off');
                    btnOn.addEventListener('click', function(){
                        track.applyConstraints({
                            advanced: [{torch: true}]
                        });
                    });
                    btnOff.addEventListener('click', function(){
                        track.applyConstraints({
                            advanced: [{torch: false}]
                        });
                    });
                });
            });
        });

        //The light will be on as long the track exists
    }

    function submitId(){
      if($('#user_id').val() != "" && $.isNumeric($('#user_id').val())){

        getUserContent($('#user_id').val())

      }else {
        swal("Oops!", "Please Enter Valid ID", "error");
      }
    }

    function getUserContent(content) {
        $.ajax({
            type: 'POST',
            url: '{{URL::to('admin/get-sacnning-data')}}',
            data: {
                _token: '<?php echo csrf_token() ?>',
                id: content
            },
            success: function (data) {
                console.log(data)
                if(data.status == 1){
                    var data = data.data;
                    var user = data.user;
                    var booking = data.booking;
                    console.log(user);
                    console.log(booking);
                    $('#profile_pic').prop('src', user.image);
                    var name = user.first_name + ' ' + user.last_name
                    $('#name').text(name);
                    $('#address').text(user.address);
                    $('#address').text(user.address);
                    $('#phone').text(user.phone);
                    $('#email').text(user.email);
                    $('#address').text(user.address);
                    $('#city').text(user.city.name);
                    $('#state').text(user.state.name);
                    $('#country').text(user.country.name);
                    /**
                     * Room Details
                     */
                    $('#room_no').text(booking.roomDetails.room_number);
                    $('#wing_no').text(booking.roomDetails.wing_name);
                    $('#building').text(booking.roomDetails.building_name);
                    $('#room_address').text(booking.roomDetails.address);
                    $('#room_category').text(booking.roomDetails.category_name);
                    $('#from').text(booking.time_from);
                    $('#to').text(booking.time_to);
                    $('#info').text(booking.additional_information);
                    $('.isactivated').removeAttr('disabled');
                    $('.isactivated').addClass('submitCard');
                    $('.user_id').val(user.id);
                    $('.no-p').css('display','block');

                    swal("Success!", 'ઓળખ પુષ્ટિ છે', "success").then(function() {
                        $(".checkqr").val('')
                        $(".checkqr").focus();
                    })

                } else if(data.status == 2) {
                    $('.no-p').css('display','none');
                    swal("Oops!", data.data, "error");

                }
                    else
                 {
                     $('.no-p').css('display','none');
                    swal("Oops!", "અમાન્ય આઇ-કાર્ડ.", "error")
                        .then((value) => {
                            // window.location.reload()
                        });
                }

            }
        });
    }
</script>

</body>

</html>
