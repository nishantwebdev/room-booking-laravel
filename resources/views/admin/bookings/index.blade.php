@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.bookings.title')</h3>
    @can('booking_create')
    <p>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

    </p>
    @endcan

    @can('booking_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.bookings.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.bookings.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
          <form action="{{ route('admin.bookings.index') }}" method="GET" >

              <div class="input-group col-md-4 pull-right">
                  <input type="text" class="form-control" name="q"
                      placeholder="Search users" value="{{ (isset($_GET['q']))?$_GET['q']:"" }}"> <span class="input-group-btn">
                      <button type="submit" class="btn btn-default">
                          <span class="glyphicon glyphicon-search"></span>
                      </button>
                  </span>
              </div>

          </form>
            <table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable-pagination' : '' }} @can('booking_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('booking_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('#ID')</th>
                        <th>@lang('quickadmin.bookings.fields.customer')</th>
                        <th>Phone No.</th>
                        <th>@lang('Wing >> Building >>') @lang('quickadmin.bookings.fields.room')</th>
                        <th>@lang('quickadmin.bookings.fields.time-from')</th>
                        <th>@lang('quickadmin.bookings.fields.time-to')</th>
                        <th>@lang('quickadmin.bookings.fields.additional-information')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if (count($bookings) > 0)
                        @foreach ($bookings as $booking)
                            <tr data-entry-id="{{ $booking->id }}">
                                @can('booking_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='id'>{{ $booking->id }}</td>
                                <td field-key='customer'>{{ $booking->customer->full_name or '' }}</td>
                                <td field-key='customer'>{{ $booking->customer->phone or '' }}</td>
                                <td field-key='room'>
                                  {{ (!is_null( $booking->room->building) && !is_null( $booking->room->building->wing))?  $booking->room->building->wing->name :"N/A" }}
                                  >>
                                  {{ (!is_null( $booking->room->building))? $booking->room->building->name :"N/A" }}
                                  >>
                                  {{ $booking->room->room_number or '' }}
                                </td>
                                <td field-key='time_from'>{{ $booking->time_from }}</td>
                                <td field-key='time_to'>{{ $booking->time_to }}</td>
                                <td field-key='additional_information'>{!! $booking->additional_information !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('booking_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.bookings.restore', $booking->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('booking_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.bookings.perma_del', $booking->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('booking_view')
                                    <a href="{{ route('admin.bookings.show',[$booking->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('booking_edit')
                                    <a href="{{ route('admin.bookings.edit',[$booking->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('booking_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.bookings.destroy', $booking->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $bookings->links() }} ({{ $bookings->total() }} Total Records)
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('booking_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.bookings.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
