<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
<div class="container">
    <!-- Branding Image -->
    <a class="navbar-brand " href="{{ url('/') }}">
    funstockfuture
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link" href="{{ route('topics.index') }}">話題</a></li>
        <li class="nav-item {{ topic_category_nav_active(1) }}"><a class="nav-link" href="{{ route('topic_categories.show', 1) }}">分享</a></li>
        <li class="nav-item {{ topic_category_nav_active(2) }}"><a class="nav-link" href="{{ route('topic_categories.show', 2) }}">教程</a></li>
        <li class="nav-item {{ topic_category_nav_active(3) }}"><a class="nav-link" href="{{ route('topic_categories.show', 3) }}">問答</a></li>
        <li class="nav-item {{ topic_category_nav_active(4) }}"><a class="nav-link" href="{{ route('topic_categories.show', 4) }}">公告</a></li>
      </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav navbar-right">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">註冊</a></li>
        @else
        <li class="nav-item">
          <a class="nav-link mt-1" href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
              <i class="fa fa-plus"></i>
            </a>
        </li>
        <li class="nav-item notification-badge">
          <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
            {{ Auth::user()->notification_count }}
          </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
            {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">
                <i class="far fa-user mr-2"></i>
                個人中心
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">
                <i class="far fa-edit mr-2"></i>
                編輯資料
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('products.index') }}" >
              <i class="fas fa-cart-plus mr-2"></i>商城</a>
              <a class="dropdown-item" href="{{ route('orders.index') }}" >
              <i class="fas fa-align-justify mr-2"></i>我的訂單</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('products.favorites') }}" >
              <i class="far fa-heart mr-2"></i>商品收藏</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" id="logout" href="#">
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('您確定要退出嗎？');">
                  {{ csrf_field() }}
                  <button class="btn btn-block btn-danger" type="submit" name="button">登出</button>
                </form>
              </a>
            </div>
        </li>
        @endguest
    </ul>
    </div>
</div>
</nav>