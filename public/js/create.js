/**
 * vue.js
 */

var productCreate =
    new Vue({
        el: '#create',
        data: function() {
            return {
                message: "test",
                productList:[],
                companyList:[],

                validate: {
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

            }
        },

        //インスタンス後に実行する
        created: function() {
            console.log("created");
        //     this.productList = {
        //         productName: "",
        //         productPrice: "",
        //         productStock: "",
        //         comment: "",
        //     }
        //     var callback = function(jsonData) {
        //         productCreate.companyList = jsonData.companyList
        //     }
        //     loadJsonAjax("/showCreate/companyGet",callback);
        //     this.dataSetFlg = true;
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
            }
        },

        //アップデートの処理
        updated: function() {
            if(this.dataSetFlg == true) {
                this.updateFlg = true;
            }
        },
    });
