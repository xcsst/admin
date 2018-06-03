<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ config('params.project_name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ config('params.misc_url') }}/css/bootstrap/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ config('params.misc_url') }}/css/font-awesome/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ config('params.misc_url') }}/css/Ionicons/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ config('params.misc_url') }}/css/jvectormap/jquery-jvectormap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ config('params.misc_url') }}/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ config('params.misc_url') }}/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ config('params.misc_url') }}/js/html5shiv.min.js"></script>
    <script src="{{ config('params.misc_url') }}/js/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 3 -->
    <script src="{{ config('params.misc_url') }}/js/jquery.min.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include('layouts._top')
@include('layouts._menu')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    @include('layouts._footer')
</footer>

</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="{{ config('params.misc_url') }}/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ config('params.misc_url') }}/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ config('params.misc_url') }}/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="{{ config('params.misc_url') }}/js/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="{{ config('params.misc_url') }}/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ config('params.misc_url') }}/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="{{ config('params.misc_url') }}/js/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="{{ config('params.misc_url') }}/js/Chart.js"></script>
<script type="text/javascript">
    var routeName = '{{ \Route::currentRouteName()}}';
    var routeArray = routeName.split('.');

    var route = routeArray[0];
    if ($("a[route='" + routeName + "']").length <= 0) {
        routeName = route + '.index';
    }

    if ($("a[route='" + routeName + "']").length > 0) {
        // console.info('aaa');
        // setTimeout(function () {
        //     $('.start').removeClass();
        //     $("a[route=" + route + "]").click();
        //     $("a[route=" + routeName + "]").parent('li').addClass('start active');
        // }, 1)
    }
</script>
</body>
</html>