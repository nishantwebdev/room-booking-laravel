@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.wings.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.wings.store'],'class' => 'form-system','id'=>'create_form']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">


            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.wings.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                    {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
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
