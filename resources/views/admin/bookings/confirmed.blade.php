@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Booking Confirmed')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('List')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($customers) > 0 ? 'datatable' : '' }} @can('customer_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th></th>
                        <th>@lang('ID')</th>
                        <th>@lang('Name')</th>
                        <!-- <th>@lang('quickadmin.customers.fields.last-name')</th> -->
                        <!-- <th>@lang('quickadmin.customers.fields.address')</th> -->
                        <th>@lang('quickadmin.customers.fields.phone')</th>

                        <th>&nbsp;</th>

                    </tr>
                </thead>

                <tbody>
                    @if (count($customers) > 0)
                        @foreach ($customers as $customer)
                            <tr data-entry-id="{{ $customer->id }}">

                                <td field-key=''></td>
                                <td field-key='first_name'>{{ $customer->id }}</td>
                                <td field-key='first_name'>{{ $customer->first_name }} {{ $customer->last_name }}</td>

                                <td field-key='phone'>{{ $customer->phone }}</td>


                                <td>
                                    @can('customer_view')
                                    <a href="{{ route('admin.customers.show',[$customer->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    <a href="{{URL::to('admin/customer/print-card/'.$customer['id'])}}" target="_blank" class="btnprn btn btn-xs btn-primary">Print Icard</a>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <h3>Room Detail</h3>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>@lang('Wing >> Building')</th>
                    <td field-key='room_number'>
                      {{ (!is_null($room->building) && !is_null($room->building->wing))? $room->building->wing->name :"N/A" }}
                      >>
                      {{ (!is_null($room->building))?$room->building->name :"N/A" }}

                    </td>
                </tr>
                <tr>
                    <th>@lang('quickadmin.rooms.fields.room-number')</th>
                    <td field-key='room_number'>{{ $room->room_number }}</td>
                </tr>
                <tr>
                    <th>@lang('quickadmin.rooms.fields.floor')</th>
                    <td field-key='floor'>{{ $room->floor }}</td>
                </tr>
                <tr>
                    <th>@lang('quickadmin.rooms.fields.description')</th>
                    <td field-key='description'>{!! $room->description !!}</td>
                </tr>
                <tr>
                    <th>@lang('Address')</th>
                    <td field-key='description'>{!! $room->address !!}</td>
                </tr>
            </table>

        </div>
    </div>
@stop

@section('javascript')
    <script>


    </script>
@endsection
