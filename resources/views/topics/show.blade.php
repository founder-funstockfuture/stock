@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="text-center">
            作者：{{ $topic->user->name }}
          </div>
          <hr>
          <div class="media">
            <div align="center">
              <a href="{{ route('users.show', $topic->user->id) }}">
                <img class="thumbnail img-fluid" src="{{ $topic->user->avatar }}" width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $topic->title }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="far fa-comment"></i>
            {{ $topic->reply_count }}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $topic->body !!}
          </div>

          @can('update', $topic)
            <div class="operate">
              <hr>
              <a href="{{ route('topics.edit', $topic) }}" class="btn btn-outline-secondary btn-sm" role="button">
                <i class="far fa-edit"></i> 編輯
              </a>
              <form action="{{ route('topics.destroy', $topic) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您確定要刪除嗎？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                  <i class="far fa-trash-alt"></i> 刪除
                </button>
              </form>
            </div>
          @endcan

        </div>
      </div>

      {{-- 用戶留言列表 --}}
      <div class="card topic-reply mt-4">
          <div class="card-body">

          @if(Auth::check())
            @include('shared._error')

            <div class="reply-box">
              <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                <div class="form-group">
                  <textarea class="form-control" rows="3" placeholder="分享你的見解~" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i> 留言</button>
              </form>
            </div>
            <hr>
          @endif

          <ul class="list-unstyled">
            @foreach ($replies as $index => $reply)
              <li class=" media" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
                <div class="media-left">
                  <a href="{{ route('users.show', [$reply->user]) }}">
                    <img class="media-object img-thumbnail mr-3" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}" style="width:48px;height:48px;" />
                  </a>
                </div>

                <div class="media-body">
                  <div class="media-heading mt-0 mb-1 text-secondary">
                    <a href="{{ route('users.show', [$reply->user]) }}" title="{{ $reply->user->name }}">
                      {{ $reply->user->name }}
                    </a>
                    <span class="text-secondary"> • </span>
                    <span class="meta text-secondary" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

                    {{-- 回覆刪除按鈕 --}}
                    @can('destroy', $reply)
                      <span class="meta float-right">
                        <form action="{{ route('replies.destroy', $reply->id) }}"
                            onsubmit="return confirm('確定要刪除此評論？');"
                            method="post">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-default btn-xs pull-left text-secondary">
                            <i class="far fa-trash-alt"></i>
                          </button>
                        </form>
                      </span>
                    @endcan
                    
                  </div>
                  <div class="reply-content text-secondary">
                    {!! $reply->content !!}
                  </div>
                    {{-- 用戶留言回覆列表 --}}
                    @foreach ($reply->replies2 as $index2 => $reply2)
                      <div class="media mt-3">
                        <a class="mr-3" href="#">
                          <img src="{{ $reply2->user->avatar }}" class="mr-3" style="width:36px;height:36px;">
                        </a>
                        <div class="media-body">
                          <h5 class="mt-0">{{ $reply2->user->name }}</h5>
                          {!! $reply2->content !!}
                        </div>
                      </div>
                    @endforeach

                    @if(Auth::check())
                      @include('shared._error')

                      <div class="reply-box  mt-3">
                        <form action="{{ route('replies2.store') }}" method="POST" accept-charset="UTF-8">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                          <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder="回覆內容{{ $reply->id }}" name="content"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-share mr-1"></i> 回覆</button>
                        </form>
                      </div>
                      <hr>
                    @endif

                </div>
              </li>

              @if ( ! $loop->last)
                <hr>
              @endif

            @endforeach
          </ul>


          </div>
      </div>

    </div>
  </div>
@stop