/**
 * 共通のvue.js
 */
var allJs =
    new Vue({
        el: 'allJs',
        data: function () {

        },
        //メソッド内容
        methods: {

            /*
            * 更新時の確認チェックをする
            */
            checkSubmit: function () {
                if (confirm('更新してよろしいですか？')) {
                    return true;
                } else {
                    return false;
                }
            },

        },
    });
