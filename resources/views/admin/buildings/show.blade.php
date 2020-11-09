@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.buildings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">


                        <tr>
                            <th>@lang('Wing')</th>
                            <td field-key='name'>{{ (is_null($building->wing))?"N/A":$building->wing->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.buildings.fields.name')</th>
                            <td field-key='name'>{{ $building->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Address')</th>
                            <td field-key='phonecode'>{{ $building->address }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.buildings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
