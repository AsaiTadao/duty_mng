<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">テラル保育園</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="inputEmail3" class="col-form-label col-md-1 text-justify-content">宛先</label>
                                <div class="col-md-2 d-flex text-justify-content">
                                    <div class="align-self-center">
                                        ひよこ保育園
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control">
                                        <option>全保護者</option>
                                        <option>０歳児クラス</option>
                                        <option>1歳児クラス</option>
                                        <option>2歳児クラス</option>
                                        <option>3歳児クラス</option>
                                        <option>4歳児クラス</option>
                                        <option>5歳児クラス</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control">
                                        <option>通常メール</option>
                                        <option>緊急メール</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="inputEmail3" class="col-form-label col-md-1 text-justify-content">件名</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="20">
保護者様各位
　ひよこ保育園からのお知らせです。
----------------------------------------------
　ひよこ保育園
　仙台市青葉区花京院2-1
　TEL:022-797-7717
　FAX:022-797-7718
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary float-right" @click="sendMail">送信</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        sendMail() {
            if (!confirm(this.$t("Are you sure you want to send mail?"))) return;
        }
    }
};
</script>
