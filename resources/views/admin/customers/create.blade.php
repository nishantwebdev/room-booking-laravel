@extends('layouts.app')


@section('style')

    <link href="{{ url('public/front/vendor/intlTelInput/intlTelInput.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('public/front/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
@stop
@section('content')
    <h3 class="page-title">@lang('quickadmin.customers.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.customers.store'],'class' => 'form-system','enctype'=>'multipart/form-data','id'=>'create_form']) !!}
    <input type="hidden" name="created_by" value="{{ \Auth::user()->id }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('image', trans('Image') , ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control', 'placeholder' => '','accept'=>'image/*']) !!}

                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="snap_div">
                        <div id="camera">


                        </div>
                        <button style="width: 100%;" onClick="take_snapshot();return false;" class="btn btn-default">
                            Click Photo
                        </button>
                    </div>


                    <div id="results" class="snap_image"></div>
                    <input type="hidden" id="namafoto" name="namafoto" value="">

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('first_name', trans('quickadmin.customers.fields.first-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('last_name', trans('quickadmin.customers.fields.last-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-6 form-group">
                    {!! Form::label('phone', trans('quickadmin.customers.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '', 'maxlength'=>"10"]) !!}
                    <div style="position: absolute;">
                        <small id="phone_error" style="color:red;display:none;"></small>
                    </div>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6 col-xs-6 form-group">
                    {!! Form::label('phone2', trans('phone2').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone2', old('phone2'), ['class' => 'form-control', 'placeholder' => '', 'maxlength'=>"10"]) !!}
                    <div style="position: absolute;">
                        <small id="phone_error2" style="color:red;display:none;"></small>
                    </div>
                    @if($errors->has('phone2'))
                        <p class="help-block">
                            {{ $errors->first('phone2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.customers.fields.email'), ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('age','Age', ['class' => 'control-label']) !!}
                    {!! Form::text('age', old('age'), ['class' => 'form-control', 'placeholder' => 'Age']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('age'))
                        <p class="help-block">
                            {{ $errors->first('age') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('blood_group','Blood Group', ['class' => 'control-label']) !!}
                    {!! Form::select('blood_group',[''=>'Select Blood Group','A+VE'=>'A+VE','A-VE'=>'A-VE','B+VE'=>'B+VE','B-VE'=>'B-VE','O+VE'=>'O+VE','O-VE'=>'O-VE','AB+VE'=>'AB+VE','AB-VE'=>'AB-VE'], old('blood_group'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('blood_group'))
                        <p class="help-block">
                            {{ $errors->first('blood_group') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('education', 'Education', ['class' => 'control-label']) !!}
                    {!! Form::text('education', old('education'), ['class' => 'form-control', 'placeholder' => 'Education']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('education'))
                        <p class="help-block">
                            {{ $errors->first('education') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('occupation', 'Occupation', ['class' => 'control-label']) !!}
                    {!! Form::text('occupation', old('occupation'), ['class' => 'form-control', 'placeholder' => 'Occupation']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('occupation'))
                        <p class="help-block">
                            {{ $errors->first('occupation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('country_id', trans('quickadmin.customers.fields.country').'', ['class' => 'control-label']) !!}
                    {!! Form::select('country_id', $countries, (old('country_id'))?old('country_id'):"101", ['class' => 'form-control','id'=>'country_id', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('country_id'))
                        <p class="help-block">
                            {{ $errors->first('country_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('state_id', trans('State').'', ['class' => 'control-label']) !!}
                    {!! Form::select('state_id', $states, (old('state_id'))?old('state_id'):"12", ['class' => 'form-control','id'=>'state_id','required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('state_id'))
                        <p class="help-block">
                            {{ $errors->first('state_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city_id', trans('City').'', ['class' => 'control-label']) !!}
                    {!! Form::select('city_id', $cities, old('city_id'), ['class' => 'form-control','id'=>'city_id', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city_id'))
                        <p class="help-block">
                            {{ $errors->first('city_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('village', trans('Village').'', ['class' => 'control-label']) !!}
                    {!! Form::text('village', old('village'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('village'))
                        <p class="help-block">
                            {{ $errors->first('village') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {{--                  {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}--}}
                    {!! Form::label('block', 'Block/House No.', ['class' => 'control-label']) !!}
                    {{Form::text('block','',array('class'=>'form-control','placeholder'=>'Block/House No.','required'=>'true'))}}

                    {{--                  {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => '','rows'=> '1']) !!}--}}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('street', 'Street Address', ['class' => 'control-label']) !!}
                    {{Form::text('street','',array('class'=>'form-control','placeholder'=>'Street Address','required'=>'true'))}}

                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('landmark', 'Landmark', ['class' => 'control-label']) !!}
                    {{Form::text('landmark','',array('class'=>'form-control','placeholder'=>'Landmark','required'=>'true'))}}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category_id', trans('quickadmin.rooms.fields.category').'', ['class' => 'control-label']) !!}

                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger submit_btn']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    <script src="{{ url('public/front/vendor/intlTelInput/intlTelInput.min.js') }}"></script>

    <!-- https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js -->
    <script src="{{ url('public/adminlte/js/sweetalert.min.js') }}"></script>


    <script language="JavaScript">
        Webcam.set({
            width: 150,
            height: 150,
            dest_width: 640,
            dest_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#camera');


        var phone = document.querySelector("#phone");
        var iti1 = window.intlTelInput(phone, {
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: "body",
            // excludeCountries: ["us"],
            //formatOnDisplay: true,
            geoIpLookup: function (callback) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            // hiddenInput: "full_number",
            initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            nationalMode: true,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "<?php echo asset('public/front/vendor/intlTelInput/utils.js'); ?>"
        });

        var phone2 = document.querySelector("#phone2")
        var iti2 = window.intlTelInput(phone2, {
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: "body",
            // excludeCountries: ["us"],
            //formatOnDisplay: true,
            geoIpLookup: function (callback) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            // hiddenInput: "full_number",
            initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "<?php echo asset('public/front/vendor/intlTelInput/utils.js'); ?>"
        });


    </script>

    <script language="JavaScript">
        function take_snapshot() {
            // take snapshot and get image data
            Webcam.snap(function (data_uri) {
                // display results in page
                document.getElementById('results').innerHTML =
                    '<p>Here is your image:</p>' +
                    '<img width="150" src="' + data_uri + '"/>';
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                document.getElementById('namafoto').value = raw_image_data;


            });


        }
    </script>

    <script>


        function getState(val) {
            $.ajax({
                type: "GET",
                url: "<?php echo route('get.states'); ?>",
                data: 'country_id=' + val,
                success: function (data) {
                    $("#state_id").html(data);
                }
            });
        }

        function getCity(val) {
            $.ajax({
                type: "GET",
                url: "<?php echo route('get.cities'); ?>",
                data: 'state_id=' + val,
                success: function (data) {
                    $("#city_id").html(data);
                }
            });
        }

        $(document).ready(function () {
            $('#country_id').select2({
                placeholder: 'Select an option'
            });
            $('#state_id').select2({
                placeholder: 'Select a State'
            });
            $('#city_id').select2({
                placeholder: 'Select a City'
            });

        });

        $('#country_id').on('change', function (e) {
            $('#state_id').select2('destroy');
            getState($('#country_id').val());
            $('#state_id').select2({
                placeholder: 'Select a State'
            });

        });

        $('#state_id').on('change', function (e) {
            console.log($('#state_id').val());

            $('#city_id').select2('destroy');
            getCity($('#state_id').val());
            $('#city_id').select2({
                placeholder: 'Select a City'
            });


        });
    </script>


    <script type="text/javascript">

        (function ($) {
            'use strict';

            var form = $('#create_form'),
                form_data;

            // Success function
            function done_func(response) {

                if (response.response == "1") {

                    cosyAlert('Data Saved', {vPos: 'top', hPos: 'right'});

                    form.find('input.form-control,textarea,#namafoto').val('');
                    $('.snap_image').html("");

                    swal("Success!", 'Your Token is: ' + response.token, "success");
                } else {
                    alert("Plaease Enter Vaild Data.");
                }


            }

            // fail function
            function fail_func(data) {
                alert(data.responseText);
            }

            form.submit(function (e) {

                e.preventDefault();


                var error_code = iti1.getValidationError();
                var error_code2 = iti2.getValidationError();

                if (!iti1.isValidNumber()) {


                    if (error_code == 3 || error_code == 0) {
                        $('#phone_error').html("Enter Valid Number..this number is Too long");

                    }
                    if (error_code == 2) {
                        $('#phone_error').html("Enter Valid Number..this number is Too short");
                    }
                    if (error_code == 1) {
                        $('#phone_error').html("Enter Valid Number..invalid country code");
                    }
                    if (error_code == 4) {
                        $('#phone_error').html("Enter Valid Number..this is not a number");
                    }

                    $("#phone").focus();
                    $("#phone_error").show();
                    e.preventDefault();

                    return false;
                }


                if ($("#phone2").val() != "" && !iti2.isValidNumber()) {


                    if (error_code2 == 3 || error_code2 == 0) {
                        $('#phone_error2').html("Enter Valid Number..this number is Too long");

                    }
                    if (error_code2 == 2) {
                        $('#phone_error2').html("Enter Valid Number..this number is Too short");
                    }
                    if (error_code2 == 1) {
                        $('#phone_error2').html("Enter Valid Number..invalid country code");
                    }
                    if (error_code2 == 4) {
                        $('#phone_error2').html("Enter Valid Number..this is not a number");
                    }

                    $("#phone2").focus();
                    $("#phone_error2").show();
                    e.preventDefault();
                    return false;
                }

                $("#phone").val(iti1.getNumber());
                $("#phone2").val(iti2.getNumber());

                var formData = new FormData(this);

                $('.submit_btn').attr("disabled", true);

                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data, textStatus, jqXHR) {
                        $('.submit_btn').attr("disabled", false);
                        done_func(data);
                        $("#phone_error").hide();
                        $("#phone_error2").hide();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('.submit_btn').attr("disabled", false);
                        fail_func(errorThrown);
                    }
                });

            });
        })(jQuery);
    </script>
@stop
