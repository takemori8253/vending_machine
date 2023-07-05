<table id="article-list" class="table table-striped">
    <table id="article-list" class="table table-striped">
        <thead>
            <tr>
                <th>@sortablelink('id', 'ID')</th>
                <th>商品画像</th>
                <th>@sortablelink('product_name', '商品名')</th>
                <th>@sortablelink('price', '価格')</th>
                <th>@sortablelink('stock', '在庫数')</th>
                <th>@sortablelink('company_name', '企業名')</th>
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
                            <button class="btn btn-primary" type="submit">詳細表示</button>
                        </form>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $article->id }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" data-id="{{ $article->id }}">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</table>

<div>
    {{ $articles->links() }}
</div>
