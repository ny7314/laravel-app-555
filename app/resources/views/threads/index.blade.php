@extends('layouts.app')
@inject('message_serveice', 'App\Services\MessageService')

@section('content')
<div class="container">
  <div class="row justiry-content-center">
    <div class="col-md-10">
      @include('layouts.flash-message')
      {{ $threads->links() }}
    </div>
  </div>
  <div class="row justify-content-center">
    @foreach ($threads as $thread)
      <div class="col-md-10 mb-5">
        <div class="card text-center">
          <div class="card-header">
            <h3><span class="badge badge-primary">{{ $thread->messages->count() }}<small>メッセージ</small></span></h3>
            <h3 class="m-0">{{ $thread->title }}</h3>
          </div>
          @foreach ($thread->messages as $message)
          @if ($loop->index >= 5)
            @continue
          @endif
            <div class="card-body">
              <h5 class="card-title">{{ $loop->iteration }} {{ $message->user->name }}：{{ $message->created_at }}</h5>
              <p class="card-text">{!! $message_serveice->convertUrl($message->body) !!}</p>
            </div>
          @endforeach
        </div>
        <div class="card-footer">
          <form action="{{ route('messages.store', $thread->id) }}" method="POST" class="mb-5">
            @csrf
            <div class="form-group">
              <label for="thread-first-content">内容</label>
              <textarea name="body" id="thread-first-content" rows="5" class="form-control mb-3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">書き込む</button>
          </form>
          <a href="{{ route('threads.show', $thread->id) }}">メッセージ一覧</a>
          <a href="{{ route('threads.index') }}">再読み込み</a>
        </div>
      </div>
    @endforeach
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
          <h5 class="card-header">新規投稿作成</h5>
          <div class="card-body">
            <form action="{{ route('threads.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="thread-title">投稿タイトル</label>
                <input type="text" name="title" class="form-control mb-3" id="thread-title" placeholder="投稿タイトルを記入してください" required>
              </div>
              <div class="form-group">
                <label for="thread-first-content">内容</label>
                <textarea name="content" class="form-control mb-3" id="thread-first-content" rows="3" placeholder="内容を記入してください" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">投稿する</button>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection