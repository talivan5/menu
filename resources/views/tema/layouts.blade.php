<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Empresa</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
        @include('tema.sider')
        @include('tema.header')
        <div class="content-wrapper">
            <section class="container">
                <div id="app">
                    @yield('content')
                </div>
            </section>
        </div>

</div>
@include("tema/footer")
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/plantilla.js') }}"></script>
</body>
</html>
