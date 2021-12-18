<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">ラテラル保育園</h3>
                            <div class="card-tools calendar-center flex-grow-1">
                                <button type="button" class="btn btn-sm btn-outline" @click="getResults(getPrevMonthDate())">
                                    <i class="fas fa-caret-left fa-2x"></i>
                                </button>
                                <div class="mx-2">{{displayDate}}</div>
                                <button type="button" class="btn btn-sm btn-outline-primary mx-2" @click="getResults(getThisMonthDate())">
                                    今月
                                </button>
                                <button type="button" class="btn btn-sm btn-outline" :hidden="isThisMonth()" @click="getResults(getNextMonthDate())">
                                    <i class="fas fa-caret-right fa-2x"></i>
                                </button>
                                <div class="form-group mx-4 mb-0">
                                    <select class="form-control">
                                        <option>阿部　一子</option>
                                        <option>伊藤　二子</option>
                                        <option>上野　三子</option>
                                        <option>遠藤　四子</option>
                                        <option>小野　五子</option>
                                    </select>
                                </div>
                                <div class="form-group mx-4 mb-0">
                                    <select class="form-control">
                                        <option>ラテラル保育園</option>
                                        <option>ラテラルキッズ本社</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="float-right">
                            <label>一括承認する</label>
                            <input type="checkbox" class="align-middle">
                        </div>
                        <div class="table-responsive p-0 overflow-scroll-x" style="height: 500px;">
                            <table class="table table-bordered table-striped table-kintai table-head-fixed table-hover w-2500-px">
                                <thead class="text-center text-white">
                                    <tr>
                                        <th rowspan="2" class="align-middle p-0" style="left: 0;z-index: 12 !important;outline: 1px solid white;">日付</th>
                                        <th rowspan="2" class="align-middle p-0" style="left: 68px;z-index: 13 !important;outline: 1px solid white;">曜日</th>
                                        <th rowspan="2" class="align-middle">出勤①</th>
                                        <th rowspan="2" class="align-middle">退勤①</th>
                                        <th rowspan="2" class="align-middle">出勤②</th>
                                        <th rowspan="2" class="align-middle">退勤②</th>
                                        <th rowspan="2" class="align-middle">実働<br>時間</th>
                                        <th rowspan="2" class="align-middle">休憩<br>時間</th>
                                        <th rowspan="2" class="align-middle">残業外<br>労働時間</th>
                                        <th rowspan="2" class="align-middle">深夜<br>時間</th>
                                        <th rowspan="2" class="align-middle">連勤日</th>
                                        <th colspan="2">年次有休</th>
                                        <th colspan="2">特休有給</th>
                                        <th colspan="2">特休無給</th>
                                        <th colspan="2">その他無給</th>
                                        <th rowspan="2" class="align-middle">欠勤日数</th>
                                        <th rowspan="2" class="align-middle">休暇・欠勤理由</th>
                                        <th rowspan="2" class="align-middle">備考</th>
                                        <th rowspan="2" class="align-middle p-0">編集</th>
                                        <th rowspan="2" class="align-middle p-0">承認</th>
                                    </tr>
                                    <tr class="heavy-green header-fix-y">
                                        <th>時間</th>
                                        <th>日</th>
                                        <th>時間</th>
                                        <th>日</th>
                                        <th>時間</th>
                                        <th>日</th>
                                        <th>時間</th>
                                        <th>日</th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center header-fix-x-tr">
                                        <tr v-for="day in days" :key="day.getDate()">
                                            <td class="header-fix-x">{{day.getDate()}}日</td>
                                            <td v-if="getWeekEnd(day) === 1" class="blue header-fix-x-68">{{day|formatWeek}}</td>
                                            <td v-else-if="getWeekEnd(day) === 2" class="red header-fix-x-68">{{day|formatWeek}}</td>
                                            <td v-else class="header-fix-x-68">{{day|formatWeek}}</td>
                                            <td>7:55</td>
                                            <td>18:00</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>10:00</td>
                                            <td>1:00</td>
                                            <td>9:00</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td></td>
                                            <td>9.00</td>
                                            <td>5.00</td>
                                            <td>9月1日</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><input type="checkbox"></td>
                                            <td>
                                                <select>
                                                    <option>育児休暇</option>
                                                    <option>育児休暇</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text">
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <i class="fa fa-edit fa-lg blue"></i>
                                                </a>
                                            </td>
                                            <td><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered">
                                <tbody class="text-center">
                                    <tr class="top-green text-white">
                                        <th class="align-middle">勤務日数</th>
                                        <th class="align-middle">勤務割合</th>
                                        <th class="align-middle">実働時間</th>
                                        <th class="align-middle">残業外<br>労働時間</th>
                                        <th class="align-middle">所定労働<br>時間-A</th>
                                        <th class="align-middle">所定労働<br>時間-B</th>
                                        <th class="align-middle">過不足<br>時間</th>
                                        <th class="align-middle">残業時間</th>
                                        <th class="align-middle">深夜時間</th>
                                        <th class="align-middle">遅刻時間</th>
                                    </tr>
                                    <tr class="heavy-green text-white">
                                        <td>178時間</td>
                                        <td>158時間</td>
                                        <td>160時間</td>
                                        <td>-時間</td>
                                        <td>1.50時間</td>
                                        <td>0.50時間</td>
                                        <td>3.25時間</td>
                                        <td>0.50時間</td>
                                        <td>1.25時間</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered">
                                <tbody class="text-center">
                                    <tr class="top-green text-white">
                                        <th class="align-middle" colspan="2">年次有休</th>
                                        <th class="align-middle" colspan="2">特休有給</th>
                                        <th class="align-middle" colspan="2">特休無給</th>
                                        <th class="align-middle" colspan="2">その他無給</th>
                                        <th class="align-middle" rowspan="2">欠勤日数</th>
                                    </tr>
                                    <tr class="top-green text-white">
                                        <th class="align-middle">時間</th>
                                        <th class="align-middle">日数</th>
                                        <th class="align-middle">時間</th>
                                        <th class="align-middle">日数</th>
                                        <th class="align-middle">時間</th>
                                        <th class="align-middle">日数</th>
                                        <th class="align-middle">時間</th>
                                        <th class="align-middle">日数</th>
                                    </tr>
                                    <tr class="heavy-green text-white">
                                        <td>12時間</td>
                                        <td>1日</td>
                                        <td>5時間</td>
                                        <td>1日</td>
                                        <td>6時間</td>
                                        <td>1日</td>
                                        <td>3時間</td>
                                        <td>2日</td>
                                        <td>1日</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary float-right">承認済み</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">申請</h5>
                            <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label v-for="item in applicationClasses" :key="item.id" class="mr-2">
                                    <input type="radio" name="type" :value="item.id">
                                    <label class="ml-auto">{{item.name}}</label>
                                </label>
                            </div>

                            <div class="form-group">
                                <i class="fas fa-square-full"></i>
                                <label>申請日時</label>
                                <div>{{ currentTime() }}</div>
                            </div>
                            <div class="form-group">
                                <i class="fas fa-square-full"></i>
                                <label>修正時間</label>
                                <div class="form-row align-items-center">
                                    <div class="col-md-2">
                                        <input type="number" name="hour" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="minute" class="form-control">
                                    </div>
                                    <div class="form-control-label">⇒</div>
                                    <div class="col-md-2">
                                        <input type="number" name="new_hour" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="new_minute" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <i class="fas fa-square-full"></i>
                                <label>申請理由</label>
                                <input type="text" name="memo" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary">申請</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    import moment from 'moment';
import { mapState } from 'vuex';
    export default {
        props: {
            attendance: {},
            total: {},
            month: '',
        },
        data () {
            return {
                editmode: false,
                currentDate: new Date(),
                displayDate: new Date(),
                days: [],
                attends : [],
                requests : [],
            }
        },
        computed: {
            ...mapState({
                applicationClasses: state => state.constants.applicationClasses
            })
        },
        methods: {
            getWeekEnd(day) {
                const weekDay = moment(day).format("ddd");;
                if (weekDay === '土'){
                    return 1;
                } else if(weekDay === '日'){
                    return 2;
                } else {
                    return 0;
                }
            },
            isThisMonth() {
                const today = new Date();
                return this.currentDate.getFullYear() == today.getFullYear() && this.currentDate.getMonth() == today.getMonth();
            },
            getThisMonthDate() {
                const date = new Date();
                this.displayDate = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('YYYY年 M月');
                return new Date(date.getFullYear(), date.getMonth(), 1);
            },
            getNextMonthDate() {
                const date = this.currentDate;
                this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY年 M月');
                return new Date(date.getFullYear(), date.getMonth() + 1, 1);
            },
            getPrevMonthDate() {
                const date = this.currentDate;
                this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY年 M月');
                return new Date(date.getFullYear(), date.getMonth() - 1, 1);
            },
            getResults(month_date) {
                //this.$Progress.start();
                this.loadAttends(month_date);
                this.loadRequests(month_date);
                this.updateTable(month_date);
                //this.$Progress.finish();
            },
            createRequest(){
                $('#addNew').modal('hide');
                //TODO: this.form.post
                this.loadRequests();
            },
            updateRequest(){
                $('#addNew').modal('hide');
                //TODO: this.form.post
                this.loadRequests();
            },
            requestModal(){
                this.editmode = true;
                this.firstdate = this.enddate;
                // if(row = this.requests.find(request => request.date.getTime() == date.getTime())) {
                //     this.editmode = true;
                //     this.form.fill(row);
                // } else {
                //     this.editmode = false;
                //     this.form.reset();
                // }
                $('#addNew').modal('show');
            },
            currentTime(){
                var today = new Date();
                var month = today.getMonth() + 1;
                var day = today.getDate();
                return month + "月" + day + "日 "
                + today.getHours() + ":"
                + today.getMinutes();
            },
            loadAttends(date){
                //TODO: axios.get
                this.attends = [
                    {
                        date: new Date('2021/09/01'),
                    },
                ];
            },
            loadRequests(date){
                //TODO: axios.get
                this.requests = {

                };
            },
            updateTable(date){
                this.currentDate = date;
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDate();
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
                this.days = [];
                for(let day = firstDay; day <= lastDay; day++) {
                    this.days.push(new Date(date.getFullYear(), date.getMonth(), day));
                }
            },

        },
        created() {
            this.displayDate = moment(this.displayDate).format('YYYY年 M月');
            this.getResults(this.currentDate);
        }
    }
</script>

<style scoped>
    .calendar-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .calendar-title {
        display: flex;
        align-items: center;
    }
</style>
