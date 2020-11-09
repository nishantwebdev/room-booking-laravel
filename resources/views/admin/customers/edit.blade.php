@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.customers.title')</h3>

    {!! Form::model($customer, ['method' => 'PUT', 'route' => ['admin.customers.update', $customer->id],'enctype'=>'multipart/form-data']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
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

                  <br>


                  {!! Form::label('vibhag', trans('vibhag').'*', ['class' => 'control-label']) !!}

                  <select class="form-control select2 " id="vibhag" name="vibhag" >
                    <option value="Nyalkaran">Nyalkaran</option>
                    <option value="Sarjudas">Sarjudas</option>
                    <option value="Sahajanand">Sahajanand</option>
                    <option value="Harikrushna">Harikrushna</option>
                    <option value="Nilkanth">Nilkanth</option>
                    <option value="Swaminarayan">Swaminarayan</option>
                  </select>
                  @if($errors->has('vibhag'))
                      <p class="help-block">
                          {{ $errors->first('vibhag') }}
                      </p>
                  @endif


              </div>
          </div>
          <div class="row">
              <div class="col-xs-12 form-group">
                <div class="snap_div">
                <div id="camera">


                </div>
                <button style="width: 100%;" onClick="take_snapshot();return false;" class="btn btn-default">Click Photo</button>
              </div>


                <div id="results" class="snap_image">

                  @if($customer->image)
                  <p>Image</p>
                  <img src="{{ asset('public/images/user/'.$customer->image) }}" title="Image" style="width: 150px;" />
                  @endif

                </div>
                <input type="hidden" id="namafoto"  name="namafoto" value="">

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
                <div class="col-md-6 col-xs-12 form-group">
                    {!! Form::label('phone', trans('quickadmin.customers.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6 col-xs-12 form-group">
                    {!! Form::label('phone2', trans('phone2').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone2', old('phone2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone2'))
                        <p class="help-block">
                            {{ $errors->first('phone2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.customers.fields.email').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('country_id', trans('quickadmin.customers.fields.country').'', ['class' => 'control-label']) !!}
                    {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control select2']) !!}
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
                    {!! Form::label('age','Age*', ['class' => 'control-label']) !!}
                    {!! Form::text('age', old('age'), ['class' => 'form-control', 'placeholder' => 'Age', 'required' => '']) !!}
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
                    {!! Form::label('blood_group','Blood Group*', ['class' => 'control-label']) !!}
                    {!! Form::select('blood_group',[''=>'Select Blood Group','A+VE'=>'A+VE','A-VE'=>'A-VE','B+VE'=>'B+VE','B-VE'=>'B-VE','O+VE'=>'O+VE','O-VE'=>'O-VE','AB+VE'=>'AB+VE','AB-VE'=>'AB-VE'], old('blood_group'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                    {!! Form::label('state_id', trans('State').'', ['class' => 'control-label']) !!}
                    {!! Form::select('state_id', $states, (old('state_id'))?old('state_id'):"12", ['class' => 'form-control','id'=>'state_id']) !!}
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
                    {!! Form::select('city_id', $cities, old('city_id'), ['class' => 'form-control','id'=>'city_id']) !!}
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
                {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => '','rows'=> '1']) !!}
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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')

<script language="JavaScript">
          Webcam.set({
            width: 150,
            height: 150,
            dest_width: 640,
              dest_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90
          });
            Webcam.attach( '#camera' );
    </script>

    <script language="JavaScript">
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML =
        '<p>Here is your image:</p>' +
					'<img width="150" src="'+data_uri+'"/>';
          var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
          document.getElementById('namafoto').value = raw_image_data;


			} );



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

@if($customer->vibhag)
<script>
$("#vibhag").val('{{ $customer->vibhag }}');
</script>

@endif
@stop
