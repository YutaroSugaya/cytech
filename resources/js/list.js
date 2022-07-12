$(function() {
    //記事を削除するときの確認画面
    $(document).on('click', '.removeList', function() {
        $(this)
            .parent()
            .parent()
            .remove();
    });


    //検索ボタンをクリックして検索結果を表示する
    $('#get_blogs').on('click', function() {
        var keyword = $('#keyword').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: '/blog/search/' + keyword,
            type: 'POST',
            data: {
                'keyword': keyword
            },
            dataType: 'text',
        }).done(function(data) {
            $('.blog-table').html(data);
            $('#keyword').val(keyword);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            console.log("textStatus     : " + textStatus); // タイムアウト、パースエラー
            console.log("errorThrown    : " + errorThrown.message); // 例外情報
            console.log("URL            : " + url);
        });
    });


    // ページネーション
    $(document).on('click', '.hogehoge', function() {
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        var keyword = $('#keyword').val(); //検索ワード取得
        var url;

        //keywordの有無でurlを指定
        if (!keyword) {
            url = '/blog/list';
        } else {
            url = '/blog/search/' + keyword;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: url, //通信するリクエスト先
            type: 'POST',
            data: {
                'page': page
            },
        }).done(function(data) {
            console.log(data);
            $('.blog-table').html(data);
            $('#keyword').val(keyword);
        });
    }
});
