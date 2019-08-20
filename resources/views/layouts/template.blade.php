<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce App</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <link rel="stylesheet" href="/css/custom.css"/>
    <script src="https://kit.fontawesome.com/562c9fc675.js"></script>
<!--<script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset("js/ajax.js")}}"></script> -->
    <script src="{{asset("js/app.js")}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@include('layouts.navbar')
@include('layouts.messages')
<div role="main" class="container align-content-center">

        <script type="text/javascript">
            $(document).ready(function (e) {
                var h = $('nav').height() + 20;
                $('body').animate({paddingTop: h});
            });

        </script>


        @yield('content')

</div>
@include('layouts.footer')
</body>
</html>