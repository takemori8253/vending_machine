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
                        
                        <form method="GET" action="{{ route('home') }}">
                            @csrf
                        <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="keyword" placeholder="商品名を入力してください">

                </div>

                <div class="form-group">
                    <label for="company_name">メーカー</label>
                    <select class="form-control" id="company_name" name="company_id">
                        <option value = "">{{"メーカーを選択してください"}}</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">検索</button>
                    </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>商品画像</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>在庫数</th>
                                    <th>メーカー名</th>
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
                                        <td>
                                            <form action="{{ route('detailForm', ['id'=>$article->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-primary" type="submit" >詳細表示</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('deleteData', ['id'=>$article->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <div>
                                    {{$articles->links() }}
                                </div>
                            </tbody>
                        </table>

                        <button type="button" onclick=location.href="{{ route('addForm') }}" class="btn btn-primary">商品登録</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
