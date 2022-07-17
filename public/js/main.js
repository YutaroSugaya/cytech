/**
 * 共通のvue.js
 */

var app =
    new Vue({
        el: '#main',
        data: function () {
            return {

                productList: [],
                filterProductList: [],
                searchList: [],
                keyword: "",
                priceUnder: "",
                priceTop: "",
                createFlg: false, //新規作成フラグ
                topPrice: "",
                underPrice: "",
                totalPrice: "",
                screenFlg: false,

            }
        },

        //インスタンス後に実行する
        created: function () {
            let vm = this;
            axios
                .get("/home/showGetList", {
                })
                .then(response => {
                    vm.productList = response.data;
                    vm.screenFlg = true;
                })
                .catch(err => {
                    (vm.errored = true), (vm.error = err);
                })
        },
        // //メソッド内容
        methods: {

            sortId: function () {
                this.productList.forEach(element => {
                    sort(element);

                });
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
            },
            /*
            * 更新時の確認チェックをする
            */
            detail: function (id) {
                location.href = '/showUpdate/' + id;
            },
            /*
             * 更新時の確認チェックをする
             */
            deleteConfirm: function (index) {
                if (confirm('削除してよろしいですか？')) {
                    // 指定されたindexの要素を1つ削除します。
                    this.productList.splice(index, 1);
                } else {
                    return false;
                }
            },
            deleteCheck: function(id) {
                console.log();
            },

            postList: function (keyword) {
                let vm = this;
                if (keyword != "") {
                    axios.post('/search/' + keyword, {
                        keyword: this.keyword
                    })
                        .then(response => {
                            vm.productList = response.data;
                            vm.screenFlg = false;

                        })
                        .catch(err => {
                            (vm.errored = true), (vm.error = err);
                        })
                } else {
                    axios
                        .get("/home/showGetList", {
                        })
                        .then(response => {
                            vm.productList = response.data;
                        })
                        .catch(err => {
                            (vm.errored = true), (vm.error = err);
                        })
                }
            },

            numberList: function (top, under) {
                var topPrice = top;
                var underPrice = under;
                let vm = this;
                if (topPrice != "" && underPrice != "") {
                    axios.post('/search2', {
                        topPrice: this.topPrice,
                        underPrice: this.underPrice,
                    })
                        .then(response => {
                            vm.productList = response.data;
                            vm.screenFlg = false;
                        })
                        .catch(err => {
                            (vm.errored = true), (vm.error = err);
                        })
                } else {
                    axios
                        .get("/home/showGetList", {
                        })
                        .then(response => {
                            vm.productList = response.data;
                        })
                        .catch(err => {
                            (vm.errored = true), (vm.error = err);
                        })
                }
            }
        },

        //アップデートの処理
        updated: function () {
            if (this.dataSetFlg == true) {
                this.updateFlg = true;
            }
        },
    });
