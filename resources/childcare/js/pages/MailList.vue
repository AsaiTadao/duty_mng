<template>
    <div class="container">
        <br>
        <br>
        <div class="card">
            <div class="card-header calendar-title">
                <h3 class="card-title mb-0">テラル保育園</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <router-link to="/broadcast-mail">
                            <button type="button" class="btn btn-block btn-all-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    一斉メール
                                </div>
                            </button>
                        </router-link>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-2">
                        <router-link to="/send-mail">
                            <div type="button" class="btn btn-block btn-class-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    0歳児クラス
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col-md-2">
                        <router-link to="/send-mail">
                            <div type="button" class="btn btn-block btn-class-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    1歳児クラス
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col-md-2">
                        <router-link to="/send-mail">
                            <div type="button" class="btn btn-block btn-class-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    2歳児クラス
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-2">
                        <router-link to="/send-mail">
                            <div type="button" class="btn btn-block btn-class-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    3歳児クラス
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col-md-2">
                        <router-link to="/send-mail">
                            <div type="button" class="btn btn-block btn-class-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    4歳児クラス
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col-md-2">
                        <router-link to="/send-mail">
                            <div type="button" class="btn btn-block btn-class-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    5歳児クラス
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div class="row justify-content-center my-5">
                    <div class="col-md-2">
                        <router-link to="/emerge-mail">
                            <div type="button" class="btn btn-block btn-emerge-email">
                                <div class="text-white text-center mb-0 mt-2">
                                    緊急メール
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


export default {

};
</script>
