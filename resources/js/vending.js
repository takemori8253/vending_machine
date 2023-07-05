// サブミットイベントの処理を行う関数
function handleSubmit(event) {
    event.preventDefault(); // フォームのデフォルトの送信を防止
    // 入力値の取得
    var inputValues = getInputValues();
    // Ajaxリクエストの作成
    $.ajax({
        url: "home",
        type: 'GET',
        data: inputValues,
        dataType: 'html',
        success: function(data) {
            // レスポンスを表示する要素に結果をセット
            var extractedElement = $(data).find("#article-list-wrapper");
            $("#article-list-wrapper").html(extractedElement);
        },
        error: function(xhr) {
            console.log(xhr);
        }
    });
}

// 入力値の取得を行う関数
function getInputValues() {
    var keyword = $('#product_name').val();
    var company_id = $('#company_name').val();
    var price_low = $('#price_lower').val();
    var price_up = $('#price_upper').val();
    var stock_low = $('#stock_lower').val();
    var stock_up = $('#stock_upper').val();
    return {
        keyword: keyword,
        company_id: company_id,
        price_low: price_low,
        price_up: price_up,
        stock_low: stock_low,
        stock_up: stock_up,
    };
}

// 削除処理を行う関数
function deleteItem(event) {
    event.preventDefault(); // フォームのデフォルトの送信を防止
    var form = $(event.target);
    var id = form.find('button').data('id');
    var url = "delete" + id; // 適切なURLを指定します
    // Ajaxリクエストの作成
    $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(),
        success: function(data) {
            handleSubmit(event); // handleSubmit関数の呼び出し
        },
        error: function(xhr) {
            console.log(xhr);
        }
    });
}

$(document).ready(function() {
    // フォームのサブミットイベントを処理
    $('#search-form').submit(handleSubmit);
    $(document).on('submit', 'form[id^="deleteForm-"]', function(event) {
        if(confirm("削除しますか？")) {
            deleteItem(event);
        } else {
            event.preventDefault();
        }
    });
});
