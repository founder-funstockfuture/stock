@extends('layouts.app')
@section('title', $product->title)

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body product-info">
    <div class="row">
      <div class="col-5">
        <img class="cover" src="{{ $product->image_url }}" alt="">
      </div>
      <div class="col-7">
        <div class="title">{{ $product->title }}</div>
        <div class="price"><label>價格</label><em>$</em><span>{{ $product->price }}</span></div>
        <div class="sales_and_reviews">
          <div class="sold_count">累計銷量 <span class="count">{{ $product->sold_count }}</span></div>
          <div class="review_count">累計評價 <span class="count">{{ $product->review_count }}</span></div>
          <div class="rating" title="評分 {{ $product->rating }}">評分 <span class="count">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span></div>
        </div>
        <div class="skus">
          <label>選擇</label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            @foreach($product->skus as $sku)
            <label
                class="btn sku-btn"
                data-price="{{ $sku->price }}"
                data-stock="{{ $sku->stock }}"
                data-toggle="tooltip"
                title="{{ $sku->description }}"
                data-placement="bottom">
                <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->title }}
            </label>
            @endforeach
          </div>
        </div>
        <div class="cart_amount"><label>數量</label><input type="text" class="form-control form-control-sm" value="1"><span>件</span><span class="stock"></span></div>
        <div class="buttons">
          @if($favored)
            <button class="btn btn-danger btn-disfavor">取消收藏</button>
          @else
            <button class="btn btn-success btn-favor">❤ 收藏</button>
          @endif
          <button class="btn btn-primary btn-add-to-cart">加入購物車</button>
        </div>
      </div>
    </div>
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab" aria-selected="true">商品詳情</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab" aria-selected="false">用戶評價</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
          {!! $product->description !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
          <!-- 評論列表開始 -->
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <td>使用者</td>
              <td>商品</td>
              <td>評分</td>
              <td>評價</td>
              <td>時間</td>
            </tr>
            </thead>
            <tbody>
              @foreach($reviews as $review)
              <tr>
                <td>{{ $review->order->user->name }}</td>
                <td>{{ $review->productSku->title }}</td>
                <td>{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</td>
                <td>{{ $review->review }}</td>
                <td>{{ $review->reviewed_at->format('Y-m-d H:i') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- 評論列表結束 -->


        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
    
    $('.sku-btn').click(function () {
      $('.product-info .price span').text($(this).data('price'));
      $('.product-info .stock').text('庫存：' + $(this).data('stock') + '件');
    });


    $('.btn-favor').click(function () {
      axios.post('{{ route('products.favor', ['product' => $product->id]) }}')
        .then(function () {
          Swal.fire({
              title: '操作成功!',
              type: 'success'
          }).then(
              function () {
                  window.location.reload();
              }
          );
        }, function(error) {
          if (error.response && error.response.status === 401) {
            alert('請先登錄');
          }  else if (error.response && error.response.data.msg) {
            alert(error.response.data.msg);
          }  else {
            alert('系統錯誤');
          }
        });
    });

    $('.btn-disfavor').click(function () {
      axios.delete('{{ route('products.disfavor', ['product' => $product->id]) }}')
        .then(function () {
          Swal.fire({
              title: '操作成功!',
              type: 'success'
          }).then(
              function () {
                  window.location.reload();
              }
          );
        });
    });

    // 加入購物車按鈕點擊事件
    $('.btn-add-to-cart').click(function () {

      // 請求加入購物車接口
      axios.post('{{ route('cart.add') }}', {
        sku_id: $('label.active input[name=skus]').val(),
        amount: $('.cart_amount input').val(),
      })
        .then(function () { // 請求成功執行此回調
          alert('加入購物車成功');
        }, function (error) { // 請求失敗執行此回調
          if (error.response.status === 401) {

            // http 狀態碼爲 401 代表用戶未登入
            alert('請先登入');

          } else if (error.response.status === 422) {

            // http 狀態碼爲 422 代表用戶輸入校驗失敗
            var html = '<div>';
            _.each(error.response.data.errors, function (errors) {
              _.each(errors, function (error) {
                html += error+'<br>';
              })
            });
            html += '</div>';
            alert(html)
          } else {

            // 其他情況應該是系統掛了
            alert('系統錯誤');
          }
        })
    });


  });
</script>
@endsection