@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.customers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('ID')</th>
                            <td field-key=''>{{ $customer->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.customers.fields.first-name')</th>
                            <td field-key='first_name'>{{ $customer->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.customers.fields.last-name')</th>
                            <td field-key='last_name'>{{ $customer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.customers.fields.address')</th>
                            <td field-key='address'>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.customers.fields.phone')</th>
                            <td field-key='phone'>{{ $customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.customers.fields.email')</th>
                            <td field-key='email'>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.customers.fields.country')</th>
                            <td field-key='country'>{{ $customer->country->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('State')</th>
                            <td field-key=''>{{ $customer->state->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('City')</th>
                            <td field-key=''>{{ $customer->city->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Village')</th>
                            <td field-key=''>{{ $customer->village or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('QR Code')</th>
                            <td >
                              @if($customer->qr_code)
                              <img src="{{ asset('public/images/qr/'.$customer->qr_code) }}" title="Qr Code" style="width: 180px;" />
                              <a href="{{ asset('public/images/qr/'.$customer->qr_code) }}" download="QrCode-{{$customer->id}}">
                                download
                              </a>
                              @else
                              N/A
                              @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{asset('public/images/user/'.$customer->image)}}" title="User Image" style="width: 180px;" ></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <a href="{{URL::to('admin/customer/print-card/'.$customer['id'])}}" target="_blank" class="btnprn btn btn-primary">Print Icard</a>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">

<li role="presentation" class="active"><a href="#bookings" aria-controls="bookings" role="tab" data-toggle="tab">Bookings</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="bookings">
<table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.bookings.fields.customer')</th>
                        <th>@lang('quickadmin.bookings.fields.room')</th>
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
                    <td field-key='customer'>{{ $booking->customer->first_name or '' }}</td>
                                <td field-key='room'>{{ $booking->room->room_number or '' }}</td>
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
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.customers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
