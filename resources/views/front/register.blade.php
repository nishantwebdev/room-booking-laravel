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
    <title>Registration Form | શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ</title>


    <!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://vadtaldham.gadisthanjetpur.com/register">
<meta property="og:title" content="Registration Form | શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">
<meta property="og:description" content="શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">
<meta property="og:image" content="{{ url('public/images/vadtal_og_image.jpg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://vadtaldham.gadisthanjetpur.com/register">
<meta property="twitter:title" content="Registration Form | શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">
<meta property="twitter:description" content="શ્રી વચનામૃત દ્વિશતાબ્દી મહોત્સવ - વડતાલ ધામ">
<meta property="twitter:image" content="{{ url('public/images/vadtal_og_image.jpg') }}">


    <!-- Icons font CSS-->
    <link href="{{ url('public/front/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('public/front/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('public/front/vendor/intlTelInput/intlTelInput.min.css') }}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ url('public/front/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('public/front/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ url('public/front/css/main.css') }}" rel="stylesheet" media="all">

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
<meta name="msapplication-TileColor" content="#9C37FC">
<meta name="msapplication-TileImage" content="{{ url('public/favicon/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#9C37FC">

</head>

<body oncontextmenu="return false;">
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <!-- <div class="card-heading">
                    <h2 class="title">Registration Form</h2>
                </div> -->
                <div class="card-body">
                  <img src="{{ url('public/images/Utara-Form-Header.jpg')}}" alt="banner" style="width:100%">
                  <p><strong>આ ફોર્મ ભાઈઓ-બહેનો, યુવક-યુવતી, બાલ-બાલિકા દરેક માટે છે. ફોર્મ વ્યક્તિગત ભરવું.<br>
                    સંપર્ક નં. : શ્રીહિરાભગત (કલાકુંજ) - ૯૪૨૮૭૮૯૮૬૦, શ્રીશૈલેષભાઈ સુહાગીયા (સુરત) - ૯૧૩૭૬૨૨૯૯૯
                  </strong></p>
                    <form id="register_form" method="POST" action="{{ route('register.save') }}" enctype="multipart/form-data">

                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (નામ) first name*</label>
                                            <input class="input--style-5" type="text" name="first_name" required>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (અટક) last name*</label>
                                            <input class="input--style-5" type="text" name="last_name" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-row">

                            <div class="value">


                              <div class="row row-space">
                                  <div class="col-2">
                                <div class="input-group">
								                    <label class="label--desc"> (ફોટો) Photo</label>
                                    <input class="input--style-5" type="file" name="image" accept="image/*">
                                </div>
                              </div>

                              <div class="col-2">
                                  <div class="input-group-desc">
              <label class="label--desc"> (ઇમેઇલ) email</label>
                                      <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="input--style-5" title="enter valid email" type="email" name="email">

                                  </div>
                              </div>

                              </div>


                            </div>
                        </div>
						<div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (મોબાઈલ નંબર) Phone Number1*</label>
                                            <input type="tel" class="input--style-5" type="text" id="phone" name="phone" required>

                                            <div><small id="phone_error" style="color:red;display:none;" ></small></div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (Whatsapp નંબર) Whatsapp Number</label>
                                            <input id="phone2" class="input--style-5" type="tel" name="phone2">

                                            <div><small id="phone_error2" style="color:red;display:none;" ></small></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
						<div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (ઉંમર) Age</label>
                                            <input min="1" max="100" class="input--style-5" type="number" name="age">

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (બ્લડ ગ્રુપ) Blood Group</label>
                    <div class="rs-select2 js-select-simple select--search">
                      <select class="form-control select2" name="blood_group">
                      <option value="">Select Blood Group</option>
                      <option value="A+VE">A+VE</option>
                      <option value="A-VE">A-VE</option>
                      <option value="B+VE">B+VE</option>
                      <option value="B-VE">B-VE</option>
                      <option value="O+VE">O+VE</option>
                      <option value="O-VE">O-VE</option>
                      <option value="AB+VE">AB+VE</option>
                      <option value="AB-VE">AB-VE</option>
                      </select>
                      <div class="select-dropdown"></div>




                                        </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
						<div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (અભ્યાસ) Education</label>
                                            <input class="input--style-5" type="text" name="education">

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (વ્યવસાય) Occupation</label>
                                            <input class="input--style-5" type="text" name="occupation">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
						<div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (દેશ) Country</label>
                                            <div class="rs-select2 js-select-simple select--search">
                                              {!! Form::select('country_id', $countries, (old('country_id'))?old('country_id'):"101", ['class' => 'form-control','id'=>'country_id']) !!}

                                        <div class="select-dropdown"></div>
                                    </div>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (રાજ્ય) State</label>
                                            <div class="rs-select2 js-select-simple select--search">
                                        {!! Form::select('state_id', $states, (old('state_id'))?old('state_id'):"12", ['class' => 'form-control','id'=>'state_id']) !!}
                                        <div class="select-dropdown"></div>
                                    </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
						<div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (શહેર) City*</label>
                                            <div class="rs-select2 js-select-simple select--search">
                                              {!! Form::select('city_id', $cities, old('city_id'), ['class' => 'form-control','id'=>'city_id' ,'required'=>'required']) !!}

                                        <div class="select-dropdown"></div>
                                    </div>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (ગામ) Village</label>
										<input class="input--style-5" type="text" name="village">

                                    </div>

                                        </div>
                                    </div>
                                </div>

						</div>


                        <div class="form-row">

                            <div class="value">
                                <div class="input-group">
								<label class="label--desc"> (હાલ સરનામું) Address*</label>
                                    <textarea class="input--style-5" name="address" required></textarea>
                                </div>
                            </div>
                        </div>

						<div class="form-row">

                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (આવવા ની તારીખ) Arrival Date</label>
                                            <input readonly class="input--style-5" type="text" name="from_date">

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
										<label class="label--desc"> (જવા ની તારીખ) Departure Date</label>
                                            <input readonly class="input--style-5" type="text" name="to_date">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="form-row p-t-20">
                            <label class="label label--block"> (જાતિ) Gender</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Male (પુરુષ)
                                    <input type="radio" checked="checked" name="gender" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">Female (સ્ત્રી)
                                    <input type="radio" name="gender" value="0">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="value">
                                <div class="input-group">
								<label class="label--desc"> આપ કઈ સંસ્થા / મંદિર સાથે જોડાયેલ છો ? (જેથી ગ્રુપમાં ઉતારા આપી શકાય) Group</label>
                                    <input type="text" class="input--style-5" name="group" >
                                </div>
                            </div>
                        </div>


                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<div style="text-align: center;color: #fff;"><p style="">Managed by <a target="_blank" href="https://mminfo.tech/" title="MM Infotech" style="display: inline-block;position: relative;top: 5px;"><img src="{{ url('public/images/logo-mm-white.png') }}" alt="mm" style="width: 45px;"></a></p></div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ url('public/front/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Vendor JS-->
    <script src="{{ url('public/front/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ url('public/front/vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ url('public/front/vendor/datepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('public/front/vendor/intlTelInput/intlTelInput.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ url('public/front/js/global.js') }}"></script>


    <!-- https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js -->
    <script src="{{ url('public/adminlte/js/sweetalert.min.js') }}"></script>


    @if(\Session::has('error'))
    <script>
    swal("Oops!", "{{ Session::get('error') }}", "error");
    </script>
    @endif

    @if(\Session::has('message'))
    <script>
    swal("Success!", "{{ Session::get('message') }}", "success");
    </script>
    @endif


	<script>


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
		  var iti2 = window.intlTelInput(phone2,{
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


  $('#register_form').on('submit', function (e) {

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

                $( "#phone" ).focus();
                $( "#phone_error" ).show();
                e.preventDefault();
            }


            if ($( "#phone2" ).val()!= "" && !iti2.isValidNumber()) {


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

                $( "#phone2" ).focus();
                $( "#phone_error2" ).show();
                e.preventDefault();
            }

            $("#phone").val(iti1.getNumber());
            $("#phone2").val(iti2.getNumber());

        });

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
$(document).ready(function() {
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


	<script>
$(function() {

  $('input[name="from_date"]').daterangepicker({
    singleDatePicker: true,
    autoUpdateInput: false,
	locale: {
      format: 'DD-MM-YYYY'
    }
  }, function(chosen_date) {
  $('input[name="from_date"]').val(chosen_date.format('DD-MM-YYYY'));
});

  $('input[name="to_date"]').daterangepicker({
    singleDatePicker: true,
    autoUpdateInput: false,
	locale: {
      format: 'DD-MM-YYYY'
    }
  }, function(chosen_date) {
  $('input[name="to_date"]').val(chosen_date.format('DD-MM-YYYY'));
});

});
</script>



</body>

</html>
<!-- end document-->
