<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper">

@include('partials.topbar')
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))

                        <div class="alert alert-info alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Message!</strong> {{ Session::get('message') }}
</div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
</body>
</html>
