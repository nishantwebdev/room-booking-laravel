@extends('layouts.app')

@section('content')
    <h3 class="page-title">Range</h3>

    <form action="{{URL::to('admin/token/update')}}" id="wizard-validation-form" method="POST" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    {!! Form::text('name', $get->name, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

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
  </form>
@stop
