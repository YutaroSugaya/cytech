/**
 * 共通のvue.js
 */

var allJs =
    new Vue({
        el: 'allJs',
        data: function () {

            return {
                createFlg: false, //新規作成フラグ

                //バリデーション
                companyName: [ //会社名
                    {
                        required: true
                    },
                ],
                productName: [ //商品名
                    {
                        required: true
                    },
                ],
                productPrice: [ //商品価格
                    {
                        required: true
                    },
                ],
                productStock: [ //商品在庫数
                    {
                        required: true
                    },
                ],
            }
        },

        //インスタンス後に実行する
        created: function() {

            if (this.createFlg) {
                this.product = {
                    companyName: "",
                    productName: "",
                    productPrice: "",
                    productStock: "",
                    comment: "",
                };
                this.dataSetFlg = true,
                loadJsonAjax("/showUpdate/update");
            } else {
                var callback = function(jsonData) {
                    var data = jsonData;
                    allJs.$set(allJs, data);
                    allJs.dataSetFlg = true;
                }
                loadJsonAjax("/showUpdate/update", callback)
            }
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

        //アップデートの処理
        updated: function() {
            if(this.dataSetFlg == true) {
                this.updateFlg = true;
            }
        },
    });
