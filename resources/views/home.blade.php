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

                        @include('search')
                        <div id="article-list-wrapper">
                            @include('list')
                        </div>

                        <button type="button" onclick=location.href="{{ route('addForm') }}" class="btn btn-primary">商品登録</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
