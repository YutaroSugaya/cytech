<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>一覧画面</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="">ログイン画面</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">商品一覧画面 <span class="sr-only"></span></a>
                    <a class="nav-item nav-link" href="#">新規登録</a>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>商品一覧</h2>
                <table class="table table-striped">
                    <tr>
                        <th>@sortablelink('id', '商品ID')</th>
                        <th>商品画像</th>
                        <th>@sortablelink('productName', '商品名')</th>
                        <th>@sortablelink('price', '価格')</th>
                        <th>@sortablelink('stock', '在庫数')</th>
                        <th>@sortablelink('company_id', 'メーカー名')</th>
                        <th>詳細画面</th>
                        <th>データ削除</th>
                    </tr>
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ Storage::url($product->image_path) }}" width="30px"></td>
                        <td>{{ $product->productName }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->company_name }}</td>
                        {{-- <td><button type="button" class="btn btn-success"
                                onclick="location.href='/blog/{{ $product->id }}'">詳細表示</button></td>
                        <td><button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger removeList">削除</button></td> --}}
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <footer class="footer bg-dark  fixed-bottom">
        <div class="container text-center">
            <span class="text-light">©️cytech</span>
        </div>
    </footer>
</body>

</html>
