@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.categories.store'],'enctype'=>'multipart/form-data']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.categories.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('label', trans('Label').'', ['class' => 'control-label']) !!}
                    {!! Form::text('label', old('label'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('label'))
                        <p class="help-block">
                            {{ $errors->first('label') }}
                        </p>
                    @endif
                </div>
            </div>

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



        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop
