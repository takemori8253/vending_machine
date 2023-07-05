<form id="search-form" method="GET">
    @csrf
    <div class="form-group">
        <label for="product_name">商品名</label>
        <input type="text" class="form-control" id="product_name" name="keyword" placeholder="商品名を入力してください">
    </div>

    <div class="form-group">
        <label for="company_name">メーカー</label>
        <select class="form-control" id="company_name" name="company_id">
            <option value="">{{"メーカーを選択してください"}}</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="product_name">価格</label>
        <input type="number" class="form-control" id="price_lower" name="price_lower" placeholder="下限">
        <input type="number" class="form-control" id="price_upper" name="price_upper" placeholder="上限">
    </div>

    <div class="form-group">
        <label for="product_name">在庫数</label>
        <input type="number" class="form-control" id="stock_lower" name="stock_lower" placeholder="下限">
        <input type="number" class="form-control" id="stock_upper" name="stock_upper" placeholder="上限">
    </div>

    <button type="submit" class="btn btn-primary" id="search-button">検索</button>
</form>
