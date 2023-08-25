<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>一覧画面</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a id="" class="nav-item nav-link" href="/showCreate">新規登録</a>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <div class="container" id="main">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>商品一覧</h2>
                <form>
                    <input type="text" v-model="keyword" style="width:250px" placeholder="商品名または会社名を入力">
                    <input type="button" value="検索" class="btn btn-primary" @click="postList(keyword)">
                </form>
                <br>

                <form><input type="text" v-model="topPrice" placeholder="金額上限" style="width:200px">
                    ~
                    <input type="text" v-model="underPrice" placeholder="金額下限" style="width:200px">
                    <input type="button" value="検索" class="btn btn-primary"
                        @click="numberList(topPrice,underPrice)">
                </form>
                <div id="app">
                    <table class="table table-striped">
                        <br>
                        <tr>
                            <th @click="sort('id')">
                                商品ID
                                <span v-if="sortKey === 'id' && sortOrder === 1">&#9650;</span>
                                <span v-if="sortKey === 'id' && sortOrder === -1">&#9660;</span>
                            </th>
                            <th>商品画像</th>
                            <th @click="sort('productName')">
                                商品名
                                <span v-if="sortKey === 'productName' && sortOrder === 1">&#9650;</span>
                                <span v-if="sortKey === 'productName' && sortOrder === -1">&#9660;</span>
                            </th>
                            <th @click="sort('price')">
                                価格
                                <span v-if="sortKey === 'price' && sortOrder === 1">&#9650;</span>
                                <span v-if="sortKey === 'price' && sortOrder === -1">&#9660;</span>
                            </th>
                            <th @click="sort('stock')">
                                在庫数
                                <span v-if="sortKey === 'stock' && sortOrder === 1">&#9650;</span>
                                <span v-if="sortKey === 'stock' && sortOrder === -1">&#9660;</span>
                            </th>
                            <th @click="sort('company_id')">
                                メーカー名
                                <span v-if="sortKey === 'company_id' && sortOrder === 1">&#9650;</span>
                                <span v-if="sortKey === 'company_id' && sortOrder === -1">&#9660;</span>
                            </th>
                            <th>詳細画面</th>
                            <th>データ削除</th>
                        </tr>

                        <tr v-for="(item,index) in sortedProductList">
                            <td v-text="item.id"></td>
                            <td><img src="{{ Storage::url('') }}" width="30px"></td>
                            <td v-text="item.productName"></td>
                            <td v-text="item.price"></td>
                            <td v-text="item.stock"></td>
                            <td v-text="item.company_name"></td>
                            <td><button type="button" class="btn btn-success" @click="detail(item.id)">詳細表示</button>
                            </td>
                            <td><button type="button" class="btn btn-danger" @click="deleteConfirm(index)">削除</button>
                            </td>
                        </tr>
                    </table>
                </div>
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
