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
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed table-bordered table-striped table-kintai table-hover">
                                <thead class="text-center text-white">
                                    <tr class="heavy-green">
                                        <th>日付</th>
                                        <th>曜日</th>
                                        <th>出勤①</th>
                                        <th>退勤①</th>
                                        <th>出勤②</th>
                                        <th>退勤②</th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center">
                                        <tr v-for="day in days" :key="day.getDate()">
                                            <td>{{day.getDate()}}日</td>
                                            <td v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</td>
                                            <td v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</td>
                                            <td v-else>{{day|formatWeek}}</td>
                                            <td>7:55</td>
                                            <td>18:00</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered text-white">
                                <thead class="text-center">
                                    <tr class="top-green">
                                        <th>実働時間合計</th>
                                        <th>残業外労働時間</th>
                                        <th>所定労働時間</th>
                                        <th>過不足時間</th>
                                        <th>残業時間</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr class="heavy-green">
                                        <td>178時間</td>
                                        <td>158時間</td>
                                        <td>160時間</td>
                                        <td>-2時間</td>
                                        <td>1.5時間</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
        data () {
            return {
                editmode: false,
                currentDate: new Date(),
                displayDate: new Date(),
                days: [],
                attends : [],
                requests : [],
                form: {
                    id : '',
                    date: '',
                    type : 0,
                    hour: '',
                    minute: '',
                    new_hour: '',
                    new_minute: '',
                    memo: '',
                }
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
                this.loadAttends(month_date);
                this.loadRequests(month_date);
                this.updateTable(month_date);
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
