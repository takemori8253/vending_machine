@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('商品情報一覧') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

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
                                        <td><button type="button" onclick=location.href="" class="btn btn-primary">詳細表示</button></td>
                                        <td>
                                        <form action="{{ route('Submit.delete', ['id'=>$article->id]) }}" method="POST">
                                            @csrf
                                        <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="button" onclick=location.href="{{ route('add') }}" class="btn btn-primary">商品登録</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
