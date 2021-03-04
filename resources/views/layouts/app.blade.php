<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Stock') - fun Stock</title>
  <meta name="description" content="@yield('description', '永誠 stock')" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}" >
  <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
  @yield('styles')

</head>

<body>
  <div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container_parent">

      @include('shared._messages')

      @yield('content')

    </div>

    @include('layouts._footer')
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.slicknav.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/topbutton.js') }}"></script>
  @yield('scriptsAfterJs')

  <script>


    $(function () { 
        $('#mobile-search').popover({
            placement: 'bottom',
            title: '搜尋代號/名稱',
            content: $('#search-form-content').html(),
            html: true,
            sanitize : false
        }).on('click', function(){
            // had to put it within the on click action so it grabs the correct info on submit
            $('.popover-body').on("click", "#search-form-button" , function() {
                alert($('.popover-body #search-form-input').val());
            /*
            $.post('/echo/html/',  {
                searchValue: $('#search-form-input').val(),
            }, function(r){
                $('#pops').popover('hide')
                $('#result').html('resonse from server could be here' )
            })
                */


            })
        })

        $(".mobile-menu").slicknav({
            label: '',
            prependTo: '#mobile-menu-wrap',
            allowParentLinks: false,
        });

        $.topbutton({
            html : '<i class="fas fa-2x fa-chevron-up"></i><br>Top',
            css : "width:60px; height:60px; background:#F47209;border-radius:50%; border:none; font-size:16px;line-height:1rem;bottom:45px;z-index:9999;",
            scrollAndShow :true,
            // default: 150
            scrollSpeed : 300

        });


    })



  </script>



</body>

</html>