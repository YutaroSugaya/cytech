<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>新規登録フォーム</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

</head>

<div class="row" id="create">
    <div class="table-responsive">
        <div class="col-md-8 col-md-offset-2">
            <h2>新規登録フォーム</h2>
            <form method="POST" action="{{ route('exeStore') }}">
                @csrf

                <div class="form-group">
                    <label for="productName">
                        商品名
                    </label>
                    <input id="productName" name="productName" class="form-control" value="{{ old('productName') }}"
                        type="text">
                    @if ($errors->has('productName'))
                        <div class="text-danger">
                            {{ $errors->first('productName') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="price">
                        価格
                    </label>
                    <input id="price" name="price" class="form-control" value="{{ old('price') }}"
                        type="text">
                    @if ($errors->has('price'))
                        <div class="text-danger">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="stock">
                        在庫数
                    </label>
                    <input id="stock" name="stock" class="form-control" value="{{ old('stock') }}"
                        type="text">
                    @if ($errors->has('stock'))
                        <div class="text-danger">
                            {{ $errors->first('stock') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">

                    <label>会社名</label>
                    <select id="id" name="company_name">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" @if (old('id') == $company->id) selected @endif>
                                {{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('company'))
                        <div class="text-danger">
                            {{ $errors->first('company') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">
                        コメント
                    </label>
                    <textarea id="comment" name="comment" class="form-control" rows="4">{{ old('comment') }}</textarea>
                    @if ($errors->has('comment'))
                        <div class="text-danger">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>

                <input id="image_path" type="file" name="image_path">

                <div class="mt-5">
                    <a class="btn btn-secondary" href="{{ '/home' }}">
                        戻る
                    </a>
                    <button type="submit" class="btn btn-primary">
                        登録する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
