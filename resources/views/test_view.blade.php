@extends('layouts.app')

@section('content')
    <h1>商品一覧</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>作成日</th>
                <th>更新日</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->product_name }}</td>
                    <td>{{ $article->price }}</td>
                    <td>{{ $article->stock }}</td>
                    <td>{{ $article->comment }}</td>
                    <td>{{ $article->img_path }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>{{ $article->updated_at }}</td>
                    <td><a href="" class="btn btn-primary">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" onclick=location.href="{{ route('add') }}" class="btn btn-primary">商品登録</button>
@endsection
