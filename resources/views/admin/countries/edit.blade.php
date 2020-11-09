@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.countries.title')</h3>

    {!! Form::model($country, ['method' => 'PUT', 'route' => ['admin.countries.update', $country->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sortname', trans('quickadmin.countries.fields.shortcode').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sortname', old('sortname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sortname'))
                        <p class="help-block">
                            {{ $errors->first('sortname') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phonecode', trans('quickadmin.countries.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phonecode', old('phonecode'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phonecode'))
                        <p class="help-block">
                            {{ $errors->first('phonecode') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.countries.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
