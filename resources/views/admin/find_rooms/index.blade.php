@extends('layouts.app')
@section('style')
<style>
    .confirm {
        background: red;
        color: white;
    }
</style>

@stop
@section('content')

    <h3 class="page-title">@lang('quickadmin.find-room.title')</h3>
    <div class="panel panel-default">

        {!! Form::open(['method' => 'post', 'route' => ['admin.find_rooms.index']]) !!}
        <div class="row" style="margin-top: 5px;">
            <div class="col-md-9 col-xs-12">
                <div class="col-xs-6 col-md-4 form-group">
                    {!! Form::label('time_from', trans('quickadmin.bookings.fields.time-from').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('time_from', old('time_from'), ['class' => 'form-control datetimepicker', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('time_from'))
                        <p class="help-block">
                            {{ $errors->first('time_from') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 col-md-4 form-group">
                    {!! Form::label('time_to', trans('quickadmin.bookings.fields.time-to').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('time_to', old('time_to'), ['class' => 'form-control datetimepicker', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('time_to'))
                        <p class="help-block">
                            {{ $errors->first('time_to') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 col-md-4 form-group">

                    {!! Form::label('category_id', trans('Type').'*', ['class' => 'control-label',]) !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif

                </div>

{{--                <div class="col-xs-6 col-md-4 form-group">
                    {!! Form::label('wing_id', trans('Wing').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('wing_id', $wing, old('wing_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif

                </div>--}}
            <!-- By JATIN Start   -->
{{--            <div class="col-xs-6 col-md-4 form-group">
--}}
{{--              <label for="state">Wing</label>
--}}
{{--									<div>
--}}
{{--										{!! Form::select('wing',$wing,$wing_id,['class' => 'form-control','id'=>'wing','required'=>'true']) !!}
--}}
{{--									</div>
--}}
{{--                <p class="help-block"></p>
--}}
{{--                @if($errors->has('time_to'))
--}}
{{--                    <p class="help-block">
--}}
{{--                        {{ $errors->first('time_to') }}
--}}
{{--                    </p>
--}}
{{--                @endif
--}}
{{--            </div>
--}}
{{--            <div class="col-xs-6 col-md-4 form-group">
--}}
{{--              <label for="state">Building</label>
--}}
{{--                  <div>
--}}
{{--                    {!! Form::select('building',['' => ''],$building_id,['class' => 'form-control','id'=>'building','required'=>'true']) !!}
--}}
{{--                  </div>
--}}
{{--                <p class="help-block"></p>
--}}
{{--                @if($errors->has('time_to'))
--}}
{{--                    <p class="help-block">
--}}
{{--                        {{ $errors->first('time_to') }}
--}}
{{--                    </p>
--}}
{{--                @endif
--}}
{{--            </div>
--}}
            <!-- By JATIN End   -->

                <div class="col-xs-12 col-md-12 form-group">
                  {!! Form::label('customer_id', trans('quickadmin.bookings.fields.customer').'', ['class' => 'control-label']) !!}
                  {!! Form::select('customer_id[]', $customers, old('customer_id'), ['class' => 'form-control','multiple'=>'','id'=>'customer_id']) !!}

                  @if($errors->has('customer_id'))
                      <p class="help-block">
                          {{ $errors->first('customer_id') }}
                      </p>
                  @endif

                </div>

            </div>
            <div class="col-md-2 col-xs-6">
                <div class="form-group" style="margin-top: 5px;">
                  {!! Form::label('additional_information', trans('Note').'*', ['class' => 'control-label']) !!}
                  {!! Form::text('additional_information', old('additional_information'), ['class' => 'form-control', 'placeholder' => '']) !!}
                  <p class="help-block"></p>
                  @if($errors->has('additional_information'))
                      <p class="help-block">
                          {{ $errors->first('additional_information') }}
                      </p>
                  @endif
                </div>

                <div class="form-group" style="margin-top: 5px;">
                    <label class="control-label"></label>
                    {!! Form::submit('Search for rooms', ['class' => 'btn btn-danger btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @if (isset($rooms) && is_null($rooms))
            <div class="form-group" style="text-align: center">
                <label>@lang('quickadmin.find-room.no_rooms_found')</label>
            </div>
        @endif
        @if (!is_null($rooms))
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($rooms) > 0 ? 'datatable1' : '' }} ">
                <thead>
                <tr>

                    <th>@lang('Room')</th>

                    @foreach($date_array as $key => $date)

                    <th align="center">
                      @if($key==0)
                      {{date('d-m-y, H:i', strtotime($date))}}
                      <br>To<br>
                      {{date('d-m-y, H:i', strtotime($date_array[1]))}}
                      @elseif($key == (count($date_array) -1 ))
                      {{date('d-m-y, H:i', strtotime($date))}}
                      <br>To<br>
                      {{date('d-m-y, H:i', strtotime($time_to))}}
                      @else
                      {{date('d-m-y, H:i', strtotime($date))}}
                      @endif

                    </th>

                    @endforeach
                    <th></th>

                </tr>

                </thead>
                <tbody>
                    @foreach ($rooms as $key => $room)


                        <tr data-entry-id="{{ $room->id }}">

                            <td field-key='room_number'>

                              {{ (!is_null($room->building) && !is_null($room->building->wing))? $room->building->wing->name :"N/A" }}
                              >>
                              {{ (!is_null($room->building))?$room->building->name :"N/A" }}
                              >>
                              {{ $room->room_number }}

                            </td>

                            @foreach($date_array as $key => $date)

                            <td class="{{($room->size - $room[$date]['total_booking']) <= 0 ?'confirm' : ''}}">
                              {{ $room->size - $room[$date]['total_booking'] }} avilable
                              <br>
                              {{ $room[$date]['total_booking'] }} / {{ $room->size }}
                            </td>

                            @endforeach


                            <td>
                                @can('booking_create')

                                        <button class="btn btn-danger submit_btn" onclick="bookRoom({{ $room->id }})" href="{{ route('admin.bookings.create',
                                        ['room_id' => $room->id,'time_from' => $time_from, 'time_to' => $time_to]) }}">
                                            {!!trans('quickadmin.find-room.book_room')!!}</button>

                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('javascript')
    @parent
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>

    $(document).ready(function(){

            $("#customer_id").select2({
              placeholder: 'Search for a user',
              minimumInputLength: 3,
                ajax: {
                    url: "{{ route('admin.find_users.ajax') }}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term,
                            _token:$('meta[name="csrf-token"]').attr('content') // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });

        function bookRoom(id){

          $('.submit_btn').attr("disabled", true);
          if($('#customer_id').val() !== null){

            $.ajax({
              url : '<?php echo route('admin.bookings.store.ajax') ?>',
              type: "POST",
              data : {
                room_id:id,
                time_from:'<?php echo $time_from  ?>',
                time_to:'<?php echo $time_to  ?>',
                customer_id: $('#customer_id').val(),
                additional_information: $('#additional_information').val(),
                _token:$('meta[name="csrf-token"]').attr('content')
              },
              success:function(data, textStatus, jqXHR){
                  //console.log(data);
                  if(data.status == "success"){
                    window.open('<?php echo route('admin.bookings.confirmed') ?>?ids='+data.booking_ids+'&room_id='+data.room_id);
                      window.location.href = "/admin/find_rooms";
                  }else {
                    cosyAlert('Something Went Wrong.', { vPos : 'top', hPos : 'right' });
                  }
                  $('.submit_btn').attr("disabled", false);
              },
              error: function(jqXHR, textStatus, errorThrown){
                $('.submit_btn').attr("disabled", false);
              }

              });

          }else {


            cosyAlert('Please Select User from list.', { vPos : 'top', hPos : 'right' });
            $('.submit_btn').attr("disabled", false);

          }

        }

        $('.datetimepicker').datetimepicker({
            format: "YYYY-MM-DD HH:mm"
        });

        $('.datatable1').dataTable({
            retrieve: true,
            dom: 'lBfrtip<"actions">',
            columnDefs: [],
            "iDisplayLength": 100,
            "aaSorting": [],
            buttons: [
                {
                    extend: 'copy',
                    text: window.copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    text: window.csvButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    text: window.excelButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    text: window.pdfButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: window.printButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: window.colvisButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ]
        });

    //get building by wing JATIn Start

    {{--$(document).on('change', '#wing', function() {--}}
    {{--     var wing = $('#wing').val();--}}
    {{--   $.ajax({--}}
    {{--     type:'POST',--}}
    {{--     async:true,--}}
    {{--     dataType: "json",--}}
    {{--     url: "getBuilding",--}}
    {{--     data: {_token:'{{ csrf_token() }}',wing:wing},--}}
    {{--     context:this,--}}
    {{--     success:function(data){--}}
    {{--       $('#building').empty();--}}
    {{--         $('#building').append($("<option/>", {--}}
    {{--             value: '',--}}
    {{--             text: 'select Building'--}}
    {{--         }));--}}
    {{--       $.each(data,function(key,value){--}}
    {{--         $('#building').append($("<option/>", {--}}
    {{--           value: key,--}}
    {{--           text: value--}}
    {{--         }));--}}
    {{--       });--}}
    {{--     }--}}
    {{--     });--}}
    {{--  });--}}

    {{--$(document).ready(function () {--}}
    {{--    var wing = "{{$wing_id}}";--}}
    {{--    $.ajax({--}}
    {{--        type:'POST',--}}
    {{--        async:true,--}}
    {{--        dataType: "json",--}}
    {{--        url: "getBuilding",--}}
    {{--        data: {_token:'{{ csrf_token() }}',wing:wing},--}}
    {{--        context:this,--}}
    {{--        success:function(data){--}}
    {{--            $('#building').empty();--}}
    {{--            $('#building').append($("<option/>", {--}}
    {{--                value: '',--}}
    {{--                text: 'select Building'--}}
    {{--            }));--}}
    {{--            $.each(data,function(key,value){--}}
    {{--                $('#building').append($("<option/>", {--}}
    {{--                    value: key,--}}
    {{--                    text: value--}}
    {{--                }));--}}
    {{--            });--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}

    //get building by wing JATIn End
    </script>
    @if(isset($category_id))
    <script>
      $('#category_id').val("{{ $category_id }}");
    </script>
    @endif
@stop
