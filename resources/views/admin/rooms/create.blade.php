@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.rooms.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.rooms.store'],'class' => 'form-system','id'=>'create_form']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-6 form-group">
                    {!! Form::label('room_number', trans('quickadmin.rooms.fields.room-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('room_number', old('room_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('room_number'))
                        <p class="help-block">
                            {{ $errors->first('room_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 col-md-6 form-group">
                    {!! Form::label('size', trans('Room size'), ['class' => 'control-label']) !!}
                    {!! Form::text('size', old('size'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('size'))
                        <p class="help-block">
                            {{ $errors->first('size') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('building_id', trans('Building').'', ['class' => 'control-label']) !!}
                    {!! Form::select('building_id', $buildings, old('building_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('building_id'))
                        <p class="help-block">
                            {{ $errors->first('building_id') }}
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

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('floor', trans('quickadmin.rooms.fields.floor'), ['class' => 'control-label']) !!}
                    {!! Form::number('floor', old('floor'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('floor'))
                        <p class="help-block">
                            {{ $errors->first('floor') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                    {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => '','rows'=> '4']) !!}
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
                    {!! Form::label('description', trans('quickadmin.rooms.fields.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '','rows'=> '4']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
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
<script type="text/javascript">

	(function ($) {
    'use strict';

    var form = $('#create_form'),
        form_data;

    // Success function
    function done_func(response) {

        if(response == "1"){

			cosyAlert('Data Saved', { vPos : 'top', hPos : 'right' });

        form.find('input.form-control,textarea,#namafoto').val('');
        $('.snap_image').html("");

		}else{
			alert("Plaease Enter Vaild Data.");
		}



    }

    // fail function
    function fail_func(data) {
        alert(data.responseText);
    }

    form.submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

$('.submit_btn').attr("disabled", true);
        $.ajax({
    url : form.attr('action'),
    type: "POST",
    data : formData,
    processData: false,
    contentType: false,
    success:function(data, textStatus, jqXHR){
      $('.submit_btn').attr("disabled", false);
        done_func(data);
    },
    error: function(jqXHR, textStatus, errorThrown){
      $('.submit_btn').attr("disabled", false);
      fail_func(errorThrown);
    }
    });

    });
})(jQuery);
	</script>

@stop
