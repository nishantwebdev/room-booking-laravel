<meta charset="utf-8">
<title>
    @lang('quickadmin.quickadmin_title')
</title>

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">
<meta content="width=device-width, initial-scale=1.0"
      name="viewport"/>
<meta http-equiv="Content-type"
      content="text/html; charset=utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Font Awesome -->
<!-- https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" -->
<link rel="stylesheet" href="{{ url('public/quickadmin/css/font-awesome.min.css') }}"/>
<!-- Ionicons -->
<!-- https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css -->
<link rel="stylesheet" href="{{ url('public/quickadmin/css/ionicons.min.css') }}">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="apple-touch-icon" sizes="57x57" href="{{ url('public/favicon/apple-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ url('public/favicon/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ url('public/favicon/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ url('public/favicon/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ url('public/favicon/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ url('public/favicon/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ url('public/favicon/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ url('public/favicon/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/favicon/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ url('public/favicon/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ url('public/favicon/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ url('public/favicon/manifest.json') }}">
<link href="{{ url('public/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet"
      href="{{ url('public/quickadmin/css') }}/select2.min.css"/>
<link href="{{ url('public/adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
<link href="{{ url('public/adminlte/css/custom.css') }}" rel="stylesheet">
<link href="{{ url('public/adminlte/css/skins/skin-blue.min.css') }}" rel="stylesheet">
<link href="{{ url('public/quickadmin/plugins/cosyAlert/jquery.cosyAlert.min.css') }}" rel="stylesheet">
<!-- https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css -->
<link rel="stylesheet" href="{{ url('public/adminlte/css/jquery-ui.css') }}">
<!-- //cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css -->
<link rel="stylesheet" href="{{ url('public/adminlte/css/jquery.dataTables.min.css') }}"/>
<!-- https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css -->
<link rel="stylesheet" href="{{ url('public/adminlte/css/select.dataTables.min.css') }} "/>
<!-- //cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css -->
<link rel="stylesheet" href="{{ url('public/adminlte/css/buttons.dataTables.min.css') }}"/>
<!-- https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css -->
<link rel="stylesheet" href="{{ url('public/adminlte/css/jquery-ui-timepicker-addon.min.css') }}"/>
<!-- https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css -->
<link rel="stylesheet" href="{{ url('public/adminlte/css/bootstrap-datepicker.standalone.min.css') }}"/>
@yield('style')
