@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @include('layouts.flash-message')
      <div class="card">
        <h5 class="card-header">新規投稿作成</h5>
        <div class="card-body">
          <form action="{{ route('threads.store') }}" method="POST">
          @csrf
            <div class="form-group">
              <label for="thread-title">投稿タイトル</label>
              <input type="text" name="title" class="form-control" id="thread-title" placeholder="投稿タイトルを記入してください">
            </div>
            <div class="form-group">
              <label for="thread-first-content">内容</label>
              <textarea name="content" class="form-control mb-3" id="thread-first-content" rows="3" placeholder="内容を記入してください"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">投稿する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection