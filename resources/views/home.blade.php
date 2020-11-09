@extends('layouts.app')

@section('style')
<style>
.info-box-text {
	white-space: normal;
}
  </style>

@stop
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Assign Room</span>
                    <span class="info-box-number">{{$complete_room}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Remaing Room</span>
                    <span class="info-box-number">{{$pending_room}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total General Room Remaing</span>
                    <span class="info-box-number">{{$general_room}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total VIP Room Remaing</span>
                    <span class="info-box-number">{{$vip_room}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total VVIP Room Remaing</span>
                    <span class="info-box-number">{{$vvip_room}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Non Leave Customer</span>
                    <span class="info-box-number">{{count($nonLeavedUser)}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row" style="margin: 10px">
        <h1>Today Leave Customers</h1>
        <table class="table table-bordered table-striped datatable @can('role_delete') dt-select @endcan">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Wing</th>
                <th>Building</th>
                <th>Room No.</th>
                <th>Date From</th>
                <th>Date To</th>
            </tr>
            </thead>
            <tbody>
            @foreach($todayLeave as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->wings_name}}</td>
                    <td>{{$row->buildings_name}}</td>
                    <td>{{$row->room_name}}</td>
                    <td>{{$row->time_from}}</td>
                    <td>{{$row->time_to}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row" style="margin: 10px">
        <h1>Tomorrow Leave Customers</h1>
        <table class="table table-bordered table-striped datatable @can('role_delete') dt-select @endcan">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Wing</th>
                <th>Building</th>
                <th>Room No.</th>
                <th>Date From</th>
                <th>Date To</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tomorrowLeave as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->wings_name}}</td>
                    <td>{{$row->buildings_name}}</td>
                    <td>{{$row->room_name}}</td>
                    <td>{{$row->time_from}}</td>
                    <td>{{$row->time_to}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row" style="margin: 10px">
        <h1>Non Leave Customers</h1>
        <table class="table table-bordered table-striped datatable @can('role_delete') dt-select @endcan">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Wing</th>
                <th>Building</th>
                <th>Room No.</th>
                <th>Date From</th>
                <th>Date To</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nonLeavedUser as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->wings_name}}</td>
                    <td>{{$row->buildings_name}}</td>
                    <td>{{$row->room_name}}</td>
                    <td>{{$row->time_from}}</td>
                    <td>{{$row->time_to}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
