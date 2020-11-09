@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.rooms.title')</h3>

    {!! Form::model($room, ['method' => 'PUT', 'route' => ['admin.rooms.update', $room->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
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
                    {!! Form::label('floor', trans('quickadmin.rooms.fields.floor').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('description', trans('quickadmin.rooms.fields.description').'*', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
