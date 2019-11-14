@extends('layout')
@section('title','新規投稿')

@section('content')
    <section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
              @if($errors->any())

                <ul>
                  @foreach($errors->all() as $message)
                    <li class="alert alert-danger">{{$message}}</li>
                  @endforeach
                </ul>

              @endif
              <form action="{{route('diary.store')}}" method="post">
              <!-- 他のサイトからの投稿を防ぐ@csrfで -->
                @csrf
                <div class="form-group">
                  <label for="title">タイトル</label>
                 
                  <!-- oldを使うことで前に入力した値を使える -->
                    <!-- inputはバリューの値を持つからバリューに追加 -->
                  <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">

                </div>
                <div class="form-group">
                <label for="body">本文</label>
                <!-- textareaはバリューをもたないので、htmlに追加 -->
                  <textarea id="body" class="form-control" name="body" >{{old('body')}}</textarea>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">投稿</button>
                </div>
                </form>
            </div>
        </div>
    </section>
    @endsection
