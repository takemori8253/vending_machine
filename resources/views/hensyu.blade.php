@extends('layouts.app')

@section('title', '投稿画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品編集') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <form method="POST" action="{{ route('updateProduct', ['id' => $id],['product' => $product])}}">
                @csrf   

                <label for="id">商品ID</label>
                <div class="form-group">
                    <td>{{$id}}</td>
                </div>

                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product_name" value="{{ $product->product_name }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="product_name">メーカー</label>
                    <select class="form-control" id="company_name" name="company_id">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
    </select>
                </div>

                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="PRICE" value="{{ $product->price }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="STOCK" value="{{ $product->stock }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Comment">{{ $product->comment }}</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="img_path">商品画像</label>
                    <input type="file" class="form-control" id="img_path" name="img_path">
                    @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">編集</button>
            </form>
            <form action="{{ route('detailForm', ['id'=>$id]) }}" method="POST">
                @csrf
                <button class="btn btn-primary" type="submit" >戻る</button>
                </form>
        </div>
    </div>
@endsection