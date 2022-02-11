<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title mb-0">保育システム</h3>
                            </div>
                            <div class="col-md-3">
                                <label>山田　三越</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td class="text-center text-white dark-pink">
                                            曜日指定
                                        </td>
                                        <td class="light-pink text-center" style="width:80%">
                                            <div class="d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1 mr-4">月曜</div>
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1 mr-4">火曜</div>
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1 mr-4">水曜</div>
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1 mr-4">木曜</div>
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1 mr-4">金曜</div>
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1 mr-4">土曜</div>
                                                    <input type="checkbox" class="align-middle" :value="1">
                                                    <div class="ml-1">祝・祭日を除く</div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="dark-pink text-white">時間指定</td>
                                        <td class="light-pink">
                                            <div class="form-row justify-content-center">
                                                <div class="col-md-1">
                                                    <input type="number" class="form-control" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                                :
                                                <div class="col-md-1">
                                                    <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                                ~
                                                <div class="col-md-1">
                                                    <input type="number" class="form-control" min="0" max="24" :class="{'is-invalid' : errors.endTime}" @change="errors.endTime = null">
                                                    <span v-if="errors.endTime" class="error invalid-feedback">
                                                        {{ errors.endTime }}
                                                    </span>
                                                </div>
                                                :
                                                <div class="col-md-1">
                                                    <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.endTime}" @change="errors.endTime = null">
                                                    <span v-if="errors.endTime" class="error invalid-feedback">
                                                        {{ errors.endTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="float-left mt-2">
                            <button class="btn btn-primary float-left" @click="calendarRegister"><i class="fa fa-calendar fa-lg"></i> カレンダから登録</button>
                        </div>
                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right">+追加</button>
                            <button class="btn btn-primary float-right ml-2">登録</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


export default {
    data() {
        return {
            errors: []
        }
    },
    methods: {
        calendarRegister() {
            this.$router.push("childcare-calendar");
        }
    }
};
</script>
