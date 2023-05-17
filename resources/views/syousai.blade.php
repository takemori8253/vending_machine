@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('商品詳細情報') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>商品画像</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>在庫数</th>
                                    <th>メーカー名</th>
                                    <th>コメント</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->img_path }}</td>
                                        <td>{{ $article->product_name }}</td>
                                        <td>{{ $article->price }}</td>
                                        <td>{{ $article->stock }}</td>
                                        <td>{{ $article->company_name }}</td>
                                        <td>{{ $article->comment }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" onclick = location.href="{{ route('EditForm', ['id'=>$article->id]) }}">編集</button>
                        <button type="button" class="btn btn-primary" onclick = location.href="{{ route('home') }}">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
