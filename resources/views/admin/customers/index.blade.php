@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.customers.title')</h3>
    @can('customer_create')
    <p>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

    </p>

    @if(Session('import_data'))

    {!! Session('import_data') !!}

   @endif
    <div class="bulk_create">
      {!! Form::open(['method' => 'POST', 'route' => ['admin.customers.import'],'class' => 'form-system','enctype'=>'multipart/form-data','id'=>'bulk_upload']) !!}
      <div class="row">
          <div class="col-xs-12 form-group">
              {!! Form::label('file', trans('File') , ['class' => 'control-label']) !!}
              {!! Form::file('file', ['class' => 'form-control', 'placeholder' => '','accept'=>'.xls,.xlsx']) !!}

              @if($errors->has('file'))
                  <p class="help-block">
                      {{ $errors->first('file') }}
                  </p>
              @endif

          </div>
      </div>
      {!! Form::submit(trans('Import'), ['class' => 'btn btn-green']) !!}
      {!! Form::close() !!}
    </div>
    @endcan

    @can('customer_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.customers.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.customers.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif

        <div class="panel-body table-responsive">
          <form action="{{ route('admin.customers.index') }}" method="GET" >

    <div class="input-group col-md-4 pull-right">
        <input type="text" class="form-control" name="q"
            placeholder="Search users" value="{{ (isset($_GET['q']))?$_GET['q']:"" }}"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>
            <table class="table table-bordered table-striped {{ count($customers) > 0 ? 'datatable-pagination' : '' }} @can('customer_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('customer_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('ID')</th>
                        <th>@lang('Name')</th>
                        <!-- <th>@lang('quickadmin.customers.fields.last-name')</th> -->
                        <!-- <th>@lang('quickadmin.customers.fields.address')</th> -->
                        <th>@lang('quickadmin.customers.fields.phone')</th>
                        <th>Token</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if (count($customers) > 0)
                        @foreach ($customers as $customer)
                            <tr data-entry-id="{{ $customer->id }}">
                                @can('customer_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='first_name'>{{ $customer->id }}</td>
                                <td field-key='first_name'>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                <!-- <td field-key='last_name'>{{ $customer->last_name }}</td> -->
                                <!-- <td field-key='address'>{{ $customer->address }}</td> -->
                                <td field-key='phone'>{{ $customer->phone }}</td>
                                <td field-key='token'>{{$customer->token}} </td>

                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('customer_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.customers.restore', $customer->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('customer_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.customers.perma_del', $customer->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('customer_view')
                                    <a href="{{ route('admin.customers.show',[$customer->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('customer_edit')
                                    <a href="{{ route('admin.customers.edit',[$customer->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('customer_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.customers.destroy', $customer->id]))
                                    !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                        <a href="{{URL::to('admin/customer/print-card/'.$customer['id'])}}" target="_blank" class="btnprn btn btn-xs btn-primary">Print Icard</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $customers->links() }} ({{ $customers->total() }} Total Records)
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('customer_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.customers.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
