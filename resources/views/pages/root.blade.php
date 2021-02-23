@extends('layouts.app')
@section('title', '首頁')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="notice-bar">
          <div class="w-75 ml-2 py-1 text-center">
              <img src="img/news-icon.png" alt=""> 
              <span class="text-danger">即時消息</span> 2021/02/08交易所休市(辦理結算交割) 2021/02/20 補上班但交易所不交易
          </div>
        </div>
      </div>
    </div>
  </div>



  <div id="carouselControls" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselControls" data-slide-to="0" class="active"></li>
      <li data-target="#carouselControls" data-slide-to="1"></li>
      <li data-target="#carouselControls" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="img/carousel/image-1.png" alt="slide1">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/carousel/image-1.png" alt="slide2">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/carousel/image-1.png" alt="slide3">
      </div>
    </div>
    
    <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>


  <div class="container my-4 vertical-tabs">
      <div class="row">
        <div class="col-1">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">台股</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">亞洲</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">美洲</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="tab" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">歐洲</a>
          </div>
        </div>
        <div class="col-11">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖3</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖3</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>

            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖3</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖3</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
              <div class="ichart">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>






<div style="height:400px;"></div>


@stop

@section('styles')


@stop

@section('scriptsAfterJs')


  <script>

    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    $('.carousel').carousel({
      interval: 2000
    })



    
  </script>
@stop