@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.buildings.title')</h3>

    {!! Form::model($building, ['method' => 'PUT', 'route' => ['admin.buildings.update', $building->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">

          <div class="row">
              <div class="col-xs-12 form-group">
                  {!! Form::label('wing_id', trans('quickadmin.customers.fields.country').'', ['class' => 'control-label']) !!}
                  {!! Form::select('wing_id', $wings, old('wing_id'), ['class' => 'form-control select2']) !!}
                  <p class="help-block"></p>
                  @if($errors->has('wing_id'))
                      <p class="help-block">
                          {{ $errors->first('wing_id') }}
                      </p>
                  @endif
              </div>
          </div>


            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.buildings.fields.name').'*', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
