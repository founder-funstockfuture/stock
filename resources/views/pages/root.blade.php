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
      <div class="row justify-content-center">
        <div class="col-1">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">台股</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">亞洲</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">美洲</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="tab" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">歐洲</a>
          </div>
        </div>
        <div class="col-10">
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
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖5</text></svg>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>

            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>

            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="200" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>




  <section class="good-articles">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h4>Share! 好文推薦</h4>
                        <div class="line"></div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-lg-4 p-0">
                <div class="about__article__bg" style="background-image: url(img/photo01.png);"></div>
                <div class="overlay">【台積600】市值超越股神巴菲特公司躍居 全球第10大</div>
              </div>
              <div class="col-lg-5 p-0">
                <div class="about__article__text pl-4">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="#"><img src="img/news-icon.png" alt="">行情終將在狂熱中毀滅，但2021會越來越好</a></li>
                    <li class="list-group-item"><img src="img/news-icon.png" alt="">
                    <a href="#">營收創新高！為何還跌停賣不掉 ?大盤現已..「四面楚歌」?(台股盤後......</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">Apple Car概念股飆、鴻海站回100元...台股老手：投資不能憑情緒......</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">[台積600]市值超越股神巴菲特公司 躍居全球第10大</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">這次不一樣？比特幣飆漲又暴跌，破解5大迷思</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">2021怎麼投資？《富比世》雜誌10大趨勢</a></li>
                    <li><button type="button" class="btn btn-secondary btn-block">More</button></li>
                  </ul>

                </div>
              </div>
            </div>

            <div class="row justify-content-center mt-3">
              <div class="col-lg-5 p-0">
                <div class="about__article__text pr-4">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="#"><img src="img/news-icon.png" alt="">行情終將在狂熱中毀滅，但2021會越來越好</a></li>
                    <li class="list-group-item"><img src="img/news-icon.png" alt="">
                    <a href="#">營收創新高！為何還跌停賣不掉 ?大盤現已..「四面楚歌」?(台股盤後......</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">Apple Car概念股飆、鴻海站回100元...台股老手：投資不能憑情緒......</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">[台積600]市值超越股神巴菲特公司 躍居全球第10大</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">這次不一樣？比特幣飆漲又暴跌，破解5大迷思</a></li>
                    <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">2021怎麼投資？《富比世》雜誌10大趨勢</a></li>
                    <li><button type="button" class="btn btn-secondary btn-block">More</button></li>
                  </ul>

                </div>
              </div>
              <div class="col-lg-4 p-0">
                <div class="about__article__bg" style="background-image: url(img/photo01.png);"></div>
                <div class="overlay">全球股民狂歡　百兆市值的夢幻時代， 破兩個世界紀錄</div>
              </div>

            </div>




        </div>
    </section>





    <!-- ##### Video Area Start ##### -->
    <section class="section-padding-80">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="tab-content">
                    <div class="tab-pane fade show active" id="post-1" role="tabpanel" aria-labelledby="post-1-tab">
                            <!-- Single Feature Post -->
                            <div class="single-feature-post video-post bg-img" style="background-image: url(img/bg-img/50.png);">
                                <!-- Play Button -->
                                <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                                <!-- Video Duration -->
                                <span class="video-duration">05.03</span>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="post-2" role="tabpanel" aria-labelledby="post-2-tab">
                            <!-- Single Feature Post -->
                            <div class="single-feature-post video-post bg-img" style="background-image: url(img/bg-img/8.jpg);">
                                <!-- Play Button -->
                                <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>

                                <!-- Video Duration -->
                                <span class="video-duration">05.03</span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="post-3" role="tabpanel" aria-labelledby="post-3-tab">
                            <!-- Single Feature Post -->
                            <div class="single-feature-post video-post bg-img" style="background-image: url(img/bg-img/9.jpg);">
                                <!-- Play Button -->
                                <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>

                                <!-- Video Duration -->
                                <span class="video-duration">05.03</span>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="post-4" role="tabpanel" aria-labelledby="post-4-tab">
                            <!-- Single Feature Post -->
                            <div class="single-feature-post video-post bg-img" style="background-image: url(img/bg-img/10.jpg);">
                                <!-- Play Button -->
                                <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>

                                <!-- Video Duration -->
                                <span class="video-duration">05.03</span>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-4">
                    <ul class="nav vizew-nav-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="post-1-tab" data-toggle="pill" href="#post-1" role="tab" aria-controls="post-1" aria-selected="true">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post style-2 d-flex align-items-center">
                                    <div class="post-thumbnail">
                                        <img src="img/bg-img/s50.png" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h6 class="post-title">【股期龍哥】蘇建豐 分析師｜龍哥非凡 連線~不看可惜~ </h6>
                                        <div class="post-meta d-flex justify-content-between">
                                            <span>2020/01/15</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="post-2-tab" data-toggle="pill" href="#post-2" role="tab" aria-controls="post-2" aria-selected="false">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post style-2 d-flex align-items-center">
                                    <div class="post-thumbnail">
                                        <img src="img/bg-img/s51.png" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h6 class="post-title">【股期龍哥】蘇建豐 分析師｜龍哥非凡 連線~不看可惜~ </h6>
                                        <div class="post-meta d-flex justify-content-between">
                                            <span>2020/01/14</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="post-3-tab" data-toggle="pill" href="#post-3" role="tab" aria-controls="post-3" aria-selected="false">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post style-2 d-flex align-items-center">
                                    <div class="post-thumbnail">
                                        <img src="img/bg-img/s52.png" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h6 class="post-title">【股期龍哥】蘇建豐 分析師｜龍哥非凡 連線~不看可惜~ </h6>
                                        <div class="post-meta d-flex justify-content-between">
                                            <span>2020/01/13</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="post-4-tab" data-toggle="pill" href="#post-4" role="tab" aria-controls="post-4" aria-selected="false">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post style-2 d-flex align-items-center">
                                    <div class="post-thumbnail">
                                        <img src="img/bg-img/s53.png" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h6 class="post-title">【股期龍哥】蘇建豐 分析師｜龍哥非凡 連線~不看可惜~ </h6>
                                        <div class="post-meta d-flex justify-content-between">
                                            <span>2020/01/12</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Video Area End ##### -->






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