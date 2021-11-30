<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 home-panel">
                <div class="card home-panel">
                    <div class="card-header">
                        ラテラル保育園 - 阿部 一子 {{ formatDate(new Date()) }}
                    </div>
                    <br>
                    <div class="text-center mt-3">
                        <h4>現在の時刻</h4>
                        <h1 class="font-weight-bold mb-0">
                            {{formatTime()}}
                        </h1>
                    </div>
                    <div
                        class="card-body d-flex flex-column justify-content-center align-items-center"
                    >
                        <div class="form-group">
                            <button
                                type="button"
                                class="btn btn-large px-5"
                                :disabled="data.attended"
                                :class="[
                                    data.attended
                                        ? 'btn-secondary'
                                        : 'btn-danger'
                                ]"
                                @click="attend()"
                            >
                                出　　勤
                            </button>
                        </div>
                        <br>
                        <div class="form-group">
                            <button
                                type="button"
                                class="btn btn-large px-5"
                                :disabled="data.leaved || !data.attended"
                                :class="
                                    data.leaved || !data.attended
                                        ? 'btn-secondary'
                                        : 'btn-danger'
                                "
                                @click="leave()"
                            >
                                退　　勤
                            </button>
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
            data: {}
        };
    },
    methods: {
        formatDate(date, showWeek = true) {
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var strDate = year + "年" + month + "月" + day + "日";
            if (showWeek) {
                strDate += "（" + this.weeks[date.getDay()] + "）";
            }
            return strDate;
        },
        formatTime() {
            var hour = ('0' + new Date().getHours()).slice(-2);
            var minute = ('0' + new Date().getMinutes()).slice(-2);
            var strTime = hour + ":" + minute;
            return strTime;
        },
        attend() {
            //TODO: axios.post
            // loadAttendance();
            this.data = {
                attended: true,
                leaved: false
            };
        },
        leave() {
            //TODO: axios.post
            // loadAttendance();
            this.data = {
                attended: true,
                leaved: true
            };
        },
        loadAttendance() {
            //TODO: axios.get
            this.data = {
                attended: false,
                leaved: false
            };
        }
    },
    created() {
        this.weeks = ["日", "月", "火", "水", "木", "金", "土"];
        this.loadAttendance();
    },
};
</script>
<style scoped>
.home-panel {
    min-height: 400px;
}
</style>
