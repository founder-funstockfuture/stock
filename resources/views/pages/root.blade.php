@extends('layouts.app')
@section('title', '首頁')

@section('content')
  <h1>這裏是首頁</h1>
@stop

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
@stop

@section('scriptsAfterJs')
  <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>

  <script>
    $(document).ready(function() {

    });
  </script>
@stop