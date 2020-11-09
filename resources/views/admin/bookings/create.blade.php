@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.bookings.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.bookings.store']]) !!}
    <input type="hidden" name="created_by" value="{{ \Auth::user()->id }}" >
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('customer_id', trans('quickadmin.bookings.fields.customer').'', ['class' => 'control-label']) !!}
                    {!! Form::select('customer_id', $customers, old('customer_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('customer_id'))
                        <p class="help-block">
                            {{ $errors->first('customer_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <!-- new set BY JATIN START -->
            <div class="row">
              <div class="col-xs-12 form-group">
              <label for="state">Wing</label>
                  <div>
                    {!! Form::select('wing',$wing,null,['class' => 'form-control','id'=>'wing','required'=>'true']) !!}
                  </div>
                  </div>
            </div>
            <div class="row">
              <div class="col-xs-12 form-group">
              <label for="state">Building</label>
                  <div>
                    {!! Form::select('building',['' => ''],null,['class' => 'form-control','id'=>'building','required'=>'true']) !!}
                  </div>
            </div>
            </div>
            <!-- new set BY JATIN END -->
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('room_id', trans('quickadmin.bookings.fields.room').'', ['class' => 'control-label']) !!}
                    {!! Form::select('room_id', ['' => ''], old('room_id'), ['class' => 'form-control select2','id'=>'room']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('room_id'))
                        <p class="help-block">
                            {{ $errors->first('room_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('time_from', trans('quickadmin.bookings.fields.time-from').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('time_from', old('time_from'), ['class' => 'form-control datetimepicker', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('time_from'))
                        <p class="help-block">
                            {{ $errors->first('time_from') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('time_to', trans('quickadmin.bookings.fields.time-to').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('time_to', old('time_to'), ['class' => 'form-control datetimepicker', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('time_to'))
                        <p class="help-block">
                            {{ $errors->first('time_to') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('additional_information', trans('quickadmin.bookings.fields.additional-information'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('additional_information', old('additional_information'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('additional_information'))
                        <p class="help-block">
                            {{ $errors->first('additional_information') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('.datetimepicker').datetimepicker({
            format: "YYYY-MM-DD HH:mm"
        });

        //get building by wing JATIn Start

        $(document).on('change', '#wing', function() {
             var wing = $('#wing').val();
           $.ajax({
             type:'POST',
             async:true,
             dataType: "json",
             url: "../getBuilding",
             data: {_token:'{{ csrf_token() }}',wing:wing},
             context:this,
             success:function(data){
               $('#building').empty();
               $('#room').empty();
             $('#building').append($("<option/>", {
                     value: '',
                     text: 'select Building'
                 }));
               $.each(data,function(key,value){
                 $('#building').append($("<option/>", {
                   value: key,
                   text: value
                 }));
               });
             }
             });
          });


          $(document).on('change', '#building', function() {
               var building = $('#building').val();
             $.ajax({
               type:'POST',
               async:true,
               dataType: "json",
               url: "../getRoom",
               data: {_token:'{{ csrf_token() }}',building:building},
               context:this,
               success:function(data){
                 $('#room').empty();
                 $('#room').append($("<option/>", {
                     value: '',
                     text: 'select Room'
                 }));
                 $.each(data,function(key,value){
                   $('#room').append($("<option/>", {
                     value: key,
                     text: value
                   }));
                 });
               }
               });
            });

        //get building by wing JATIn End
    </script>
@stop
