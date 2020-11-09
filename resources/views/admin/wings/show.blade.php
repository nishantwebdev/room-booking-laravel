@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.wings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">


                        <tr>
                            <th>@lang('quickadmin.wings.fields.name')</th>
                            <td field-key='name'>{{ $wing->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Address')</th>
                            <td field-key='phonecode'>{{ $wing->address }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.wings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
