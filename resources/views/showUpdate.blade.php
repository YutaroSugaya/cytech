<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>編集画面</title>
    <link rel="stylesheet" href="/css/app.css">
    {{-- <script src="{{ asset('/js/all.js') }}"></script> --}}
</head>

<body>
    <div class="row">
        <div class="mb-5 col-md-6 col-md-offset-2">
            <h2 class="text-secondary">商品編集フォーム</h2>
            <form method="POST" action="{{ route('exeUpdate') }}" onSubmit="return checkSubmit()"
                enctype="multipart/form-data">
                @csrf


                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="form-group text-secondary">
                    <label for="title">
                        商品名
                    </label>
                    <input id="productName" name="productName" class="form-control col-md-6"
                        value="{{ $product->productName }}" type="text">
                    @if ($errors->has('productName'))
                        <div class="text-danger">
                            {{ $errors->first('productName') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">

                    <label>会社名</label>
                    <select id="id" name="company_name">
                        @foreach ($companies as $company)
                            <option id="id" name="company_name" value="{{ $company->id }}"
                                @if ($company->id === $product->company_id) selected @endif>{{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('company'))
                        <div class="text-danger">
                            {{ $errors->first('company') }}
                        </div>
                    @endif
                </div>

                <div class="form-group text-secondary">
                    <label for="price">
                        価格
                    </label>
                    <input id="price" name="price" class="form-control col-md-3" value="{{ $product->price }}"
                        type="text">
                    @if ($errors->has('price'))
                        <div class="text-danger">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                </div>

                <div class="form-group text-secondary">
                    <label for="stock">
                        在庫数
                    </label>
                    <input id="stock" name="stock" class="form-control col-md-3" value="{{ $product->stock }}"
                        type="text">
                    @if ($errors->has('stock'))
                        <div class="text-danger">
                            {{ $errors->first('stock') }}
                        </div>
                    @endif
                </div>

                <div class="form-group text-secondary">
                    <label for="comment">
                        コメント
                    </label>
                    <textarea id="comment" name="comment" class="form-control" rows="4">{{ $product->comment }}</textarea>
                    @if ($errors->has('comment'))
                        <div class="text-danger">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>

                <div class="form-group text-secondary">
                    <label for="image_path">
                        商品画像
                    </label>
                    <br>
                    <img src="{{ asset('/storage/' . $product->image_path) }}" class="img-fluid"
                        alt="{{ $product->image_path }}" width="200" height="200">
                    <br>
                    <br>
                    <input type="file" class="form-control-file" name='image_path' id="image_path">
                    @if ($errors->has('image_path'))
                        <div class="text-danger">
                            {{ $errors->first('image_path') }}
                        </div>
                    @endif
                </div>
                <div class="mt-5">
                    <button type="button" class="btn btn-secondary" onclick="location.href='/home'">
                        戻る
                    </button>

                    <button type="submit" class="btn btn-primary">
                        更新する
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
