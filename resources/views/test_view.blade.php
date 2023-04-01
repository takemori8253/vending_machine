@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($articles as $article)
        <tr>
            <br>
            <td>{{ $article->id }}</td>
            <td>{{ $article->name }}</td>
            <td>{{ $article->email }}</td>
            <button type="button" class="btn btn-primary" onclick = location.href="{{ route('register') }}">
                {{ __('詳細表示') }}
            </button>
            <button type="button" class="btn btn-primary" onclick = location.href="{{ route('register') }}">
                {{ __('削除') }}
            </button>
        </tr>
    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
