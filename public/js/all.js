/**
 * 共通のvue.js
 */

var app =
    new Vue({
        el: '#app',
        data: function() {
            return {

                message: "test",
                productList:[],
                id: "id",
                image: "image",
                productName: "productName1234",
                price: "price",
                stock: "stock",
                company_name: "companyName",
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
            console.log("created");
            if (this.createFlg) {
                this.productList = {
                    companyName: "",
                    productName: "",
                    productPrice: "",
                    productStock: "",
                    comment: "",
                }
                this.dataSetFlg = true;
                loadJsonAjax("/showUpdate/update");
            } else {
                console.log("else");[]
                console.log(jsonData);
                var callback = function(jsonData) {
                    var data = jsonData;
                    app.$set(app, data);
                    app.dataSetFlg = true;
                    app.productList = data.productList;
                }
                loadJsonAjax("/home/showGetList", callback);
            }
        },

        // //メソッド内容
        methods: {

            /*
            *  新規登録のフラグを立てる処理
            */
           create: function() {
               return this.createFlg = true;
           },


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
