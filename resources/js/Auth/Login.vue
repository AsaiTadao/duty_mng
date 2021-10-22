<template>
    <div class="login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-header text-center p-0">
                    <a href="#" class="h1"
                        ><img src="/images/logo.png" class="w-100"
                    /></a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input
                                type="email"
                                class="form-control"
                                placeholder="社員No"
                            />
                            <!-- <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div> -->
                        </div>
                        <div class="input-group mb-3">
                            <input
                                type="password"
                                class="form-control"
                                placeholder="パスワード"
                            />
                            <!-- <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div> -->
                        </div>
                        <div class="row d-flex justify-content-center mb-3">
                            <!-- /.col -->
                            <div class="col-4">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-block"
                                    @click="onLogin"
                                >
                                    ログイン
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="電話番号は＊＊＊＊＊です。">ログイン情報をお忘れですか？</a>
                    </p>
                    <!-- <p class="mb-0">
                        <a href="#" class="text-center">新規会員登録</a>
                    </p> -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        onLogin() {
            this.$router.push("/user/");
        }
    }
};
</script>
