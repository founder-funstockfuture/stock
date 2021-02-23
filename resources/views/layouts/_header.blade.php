<header class="header-section">
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 d-inline-flex flex-row-reverse align-self-end">

                        <ul class="nav-right">
                            <li class="fb-icon">
                              <a href="./index.html">
                                  <img src="img/fb-icon.png" alt="">
                              </a>
                            </li>
                            <li class="line-icon">
                              <a href="./index.html">
                                  <img src="img/line-icon.png" alt="">
                              </a>
                            </li>
                            <li class="youtube-icon">
                              <a href="./index.html">
                                  <img src="img/youtube-icon.png" alt="">
                              </a>
                            </li>
                            <li class="cart-icon">
                              <a href="./index.html">
                                  <img src="img/cart.png" alt="">
                              </a>
                            </li>
                            <li class="notice-icon">
                              <a href="./index.html">
                                  <img src="img/notice-icon.png" alt="">
                              </a>
                            </li>
                            <li class="login">
                              <button type="button" class="btn btn-outline-warning">登入</button></li>
                            <li class="register">
                              <button type="button" class="btn btn-outline-warning">註冊</button></li>
                        </ul>
                        
                        <div class="search-bar">
                            <div class="input-group">
                                <input class="form-control py-2" type="search" id="search-input">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <nav class="nav-menu navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">航海日誌</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">漁夫物語</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">專家影視廳</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">市場瞭望台</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">盤後金銀島</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">選股藏寶圖</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">FUN商城</a>
                        </li>

                    </ul>
                </nav>
            
                <nav class="nav-menu mobile-menu navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">航海日誌</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">漁夫物語</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">專家影視廳</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">市場瞭望台</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">盤後金銀島</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">選股藏寶圖</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">FUN商城</a>
                        </li>

                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>

    </header>



@section('scriptsAfterJs')
  <script type="text/javascript" src="{{ asset('js/jquery.slicknav.js') }}"></script>

  <script>
    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

  </script>
@stop