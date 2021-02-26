@extends('layouts.app')
@section('title', '首頁')

@section('content')
  <div class="container d-none d-md-block">
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

  <div id="carouselControls" class="carousel main-slide" data-ride="carousel">
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


  <div class="vertical-tabs my-4 d-none d-lg-block">
      <div class="row justify-content-center">
        <div class="col-lg-1">
          <div class="nav float-right flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">台股</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">亞洲</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">美洲</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="tab" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">歐洲</a>
          </div>
        </div>

        <div class="col-lg-9">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖3</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖4</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖5</text></svg>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>

            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="210" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>

            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="205" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖1</text></svg>
              </div>
              <div class="ichart">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block" width="205" height="138" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">圖2</text></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>


  <div class="good-articles">
    <div class="row">
        <div class="col-12">
            <div class="section-heading">
                <h4>Share! 好文推薦</h4>
                <div class="line"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center first-article">
      <div class="col-lg-3 p-0">
        <div class="about__article__bg" style="background-image: url(img/photo01.png);"></div>
        <div class="overtag">最新<br>文章<br><span class="append">News!</span></div>
        <div class="overlay">【台積600】市值超越股神巴菲特公司躍居 全球第10大</div>
      </div>
      <div class="col-lg-5 p-0">
        <div class="about__article__text">
          <ul class="list-group">
            <li class="list-group-item">
              <a href="#"><img src="img/news-icon.png" alt="">行情終將在狂熱中毀滅，但2021會越來越好</a></li>
            <li class="list-group-item"><img src="img/news-icon.png" alt="">
            <a href="#">營收創新高！為何還跌停賣不掉 ?大盤現已..「四面楚歌」?(台股盤後......</a></li>
            <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">Apple Car概念股飆、鴻海站回100元...台股老手：投資不能憑情緒......</a></li>
            <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">[台積600]市值超越股神巴菲特公司 躍居全球第10大</a></li>
            <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">這次不一樣？比特幣飆漲又暴跌，破解5大迷思</a></li>
            <li class="list-group-item"><a href="#"><img src="img/news-icon.png" alt="">2021怎麼投資？《富比世》雜誌10大趨勢</a></li>
            <li><a class="btn btn-secondary btn-block">More</a></li>
          </ul>

        </div>
      </div>
    </div>

    <div class="row flex-row-reverse justify-content-center mt-4">
      <div class="col-lg-3 p-0">
        <div class="about__article__bg" style="background-image: url(img/photo02.png);"></div>
        <div class="overtag">熱門<br>文章<br><span class="append">Hot!</span></div>
        <div class="overlay">全球股民狂歡　百兆市值的夢幻時代， 破兩個世界紀錄</div>
      </div>
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
            <li><a class="btn btn-secondary btn-block">More</a></li>
          </ul>

        </div>
      </div>

    </div>
  </div>


  <div class="fisherman">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <div class="row">
            <div class="col-12">
              <div class="section-heading">
                <h4>Top 5! 漁夫好文</h4>
                <div class="line"></div>
              </div>
            </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-10">
            <div class="about__article__text">
              <ul class="list-group">
                <li class="list-group-item">
                  <span class="number-sign">1</span>
                  <a href="#">2021怎麼投資？《富比世》雜誌10大趨勢</a>
                </li>
                <li class="list-group-item">
                  <span class="number-sign">2</span>
                  <a href="#">營收創新高！為何還跌停賣不掉 ?大盤現已..「四面楚歌」?(台股盤後......</a>
                </li>
                <li class="list-group-item">
                  <span class="number-sign">3</span>
                  <a href="#">《半導體》台積電今年資本支出估躍增逾45％ 營收再拚新高</a>
                </li>
                <li class="list-group-item">
                  <span class="number-sign">4</span>
                  <a href="#">創4月漲幅新高》美元開始反彈，投資人的樂觀情緒會降溫嗎？</a>
                </li>
                <li class="list-group-item">
                  <span class="number-sign">5</span>
                  <a href="#">台達電、國巨目標價 大摩上修至350元、680元</a>
                </li>
                <li class="mt-5"><a class="btn btn-secondary btn-block">More</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <div class="section-new-video mt-5">
    <div class="row">
        <div class="col-12">
            <div class="section-heading">
                <h4>New! Video 最新影視</h4>
                <div class="line"></div>
            </div>
        </div>
    </div>

      <div class="row no-gutters justify-content-center">
          <div class="col-12 col-md-6 col-lg-6">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="post-1" role="tabpanel" aria-labelledby="post-1-tab">
                <!-- Single Feature Post -->
                <div class="single-feature-post video-post" style="background-image: url(img/bg-img/50.png);">
                    <!-- Play Button -->
                    <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                    <!-- Video Duration -->
                    <span class="video-duration">05.03</span>
                </div>
              </div>

              <div class="tab-pane fade" id="post-2" role="tabpanel" aria-labelledby="post-2-tab">
                  <!-- Single Feature Post -->
                  <div class="single-feature-post video-post" style="background-image: url(img/bg-img/8.jpg);">
                      <!-- Play Button -->
                      <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>

                      <!-- Video Duration -->
                      <span class="video-duration">05.03</span>
                  </div>
              </div>
              <div class="tab-pane fade" id="post-3" role="tabpanel" aria-labelledby="post-3-tab">
                  <!-- Single Feature Post -->
                  <div class="single-feature-post video-post" style="background-image: url(img/bg-img/9.jpg);">
                      <!-- Play Button -->
                      <a href="video-post.html" class="btn play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>

                      <!-- Video Duration -->
                      <span class="video-duration">05.03</span>
                  </div>
              </div>

              <div class="tab-pane fade" id="post-4" role="tabpanel" aria-labelledby="post-4-tab">
                  <!-- Single Feature Post -->
                  <div class="single-feature-post video-post" style="background-image: url(img/bg-img/10.jpg);">
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
                        <div class="d-flex align-items-center">
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

    
  <div class="section-news mt-5">
    <div class="row">
        <div class="col-12">
            <div class="section-heading">
                <h4>New!新聞</h4>
                <div class="line"></div>
            </div>
        </div>
    </div>

    <div class="row no-gutters justify-content-center">
      <div class="col-12 col-md-10" style="display:contents;">
        <div class="col-12 col-md-4">
          <div class="card">
            <img src="img/photo08.png" class="card-img-top" alt="...">
            <div class="overtag">25<br><span class="append">JAN</span></div>
            <div class="card-body">
              <h5 class="card-title">財經</h5>
              <h4 class="card-title">5G、電動車和英特爾釋單消息創需求：台 積電再擴大投資，ADR漲近6%登歷史新高</h4>
              <p class="card-text">疫情爆發以來，居家辦公風潮帶動個人電腦與資 料中心伺服器需求，台積電獲益良多。美國政府 制裁台積電昔日大客戶華為技術有限公司後，台 積電也安度考驗。</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card-group">
            <div class="col-12 col-md-6">
              <div class="card">
                <img src="img/photo09.png" class="card-img-top" alt="...">
                <div class="overtag">14<br><span class="append">JAN</span></div>
                <div class="card-body">
                  <h5 class="card-title">金融</h5>
                  <h4 class="card-title">外資匯出股利 新台幣區間整理 貶2.2分</h4>
                </div>
              </div>
              <div class="card">
                <img src="img/photo10.png" class="card-img-top" alt="...">
                <div class="overtag">14<br><span class="append">JAN</span></div>
                <div class="card-body">
                  <h5 class="card-title">國際</h5>
                  <h4 class="card-title">電動車算什麼？通用在CES秀「 凱迪拉克飛天車」，股價...</h4>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card">
                <img src="img/photo11.png" class="card-img-top" alt="...">
                <div class="overtag">15<br><span class="append">JAN</span></div>
                <div class="card-body">
                  <h5 class="card-title">國際</h5>
                  <h4 class="card-title">美股三大指數小跌 投資人觀望 拜登即將公布的刺激計畫</h4>
                </div>
              </div>

              <div class="card">
                <img src="img/photo12.png" class="card-img-top" alt="...">
                <div class="overtag">15<br><span class="append">JAN</span></div>
                <div class="card-body">
                  <h5 class="card-title">投資理財</h5>
                  <h4 class="card-title">台積電衝破600員還能不能買？ 三個數據告訴你</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-10">
          <a class="btn btn-secondary btn-block">More</a>
        </div>

      </div>

    </div>


  </div>




  <div class="section-hot-video mt-5">
    <div class="row">
      <div class="col-12">
          <div class="section-heading">
              <h4>熱門影視</h4>
              <div class="line"></div>
          </div>
      </div>
    </div>

    <div class="row no-gutters justify-content-center">
      <div class="col-10">
        <div id="carousel-hot-video" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner row w-100 mx-auto" role="listbox">
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                <img src="img/hot-video-1.png" class="img-fluid mx-auto d-block" alt="img1">
            </div>
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                <img src="img/hot-video-2.png" class="img-fluid mx-auto d-block" alt="img2">
            </div>
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                <img src="img/hot-video-3.png" class="img-fluid mx-auto d-block" alt="img3">
            </div>
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                <img src="img/hot-video-1.png" class="img-fluid mx-auto d-block" alt="img4">
            </div>
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                <img src="img/hot-video-2.png" class="img-fluid mx-auto d-block" alt="img5">
            </div>
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                <img src="img/hot-video-3.png" class="img-fluid mx-auto d-block" alt="img6">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carousel-hot-video" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-hot-video" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
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

    $('.slide').carousel({
      interval: 2000
    })

    /*
        Carousel
    */
    $('#carousel-hot-video').on('slide.bs.carousel', function (e) {
        /*
            CC 2.0 License Iatek LLC 2018 - Attribution required
        */
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 5;
        var totalItems = $('.section-hot-video .carousel-item').length;
    
        if (idx >= totalItems-(itemsPerSlide-1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i=0; i<it; i++) {
                // append slides to end
                if (e.direction=="left") {
                    $('.section-hot-video .carousel-item').eq(i).appendTo('.section-hot-video .carousel-inner');
                }
                else {
                    $('.section-hot-video .carousel-item').eq(0).appendTo('.section-hot-video .carousel-inner');
                }
            }
        }
    });

    
  </script>
@stop