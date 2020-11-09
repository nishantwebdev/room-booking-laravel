@extends('layouts.app')
@section('content')
    <h3 class="page-title">Token Series</h3>
    <form action="{{URL::to('admin/token/store')}}" id="wizard-validation-form" method="POST" enctype="multipart/form-data">

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    {!! Form::label('Range', trans('quickadmin.categories.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
  </form>
@stop
