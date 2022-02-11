<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">テラル保育園</h3>
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
                            <div class="table-responsive p-0" style="height: 500px;" id="children_present_table">
                                <table class="table table-bordered table-striped table-children table-head-fixed table-hover">
                                    <thead class="text-center text-white">
                                        <tr class="dark-brown">
                                            <th class="children-present-fix" style="left: 0px; z-index: 12 !important; outline: white solid 1px;">日付</th>
                                            <th class="children-present-fix-140" style="z-index: 12 !important; outline: white solid 1px;">曜日</th>
                                            <th>登園時間</th>
                                            <th>降園時間</th>
                                            <th>延長</th>
                                            <th>編集</th>
                                        </tr>
                                    </thead>
                                        <tbody class="text-center children-present-tr">
                                            <tr v-for="day in days" :key="day.getDate()">
                                                <td class="children-present-fix">
                                                    {{day.getDate()}}
                                                </td>
                                                <td class="children-present-fix-140">
                                                    <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                    <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                    <div v-else>{{day|formatWeek}}</div>
                                                </td>
                                                <td>8:58</td>
                                                <td>18:00</td>
                                                <td>-</td>
                                                <td>
                                                    <a href="#" class="mx-2">
                                                        <i class="far fa-edit fa-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                            <div class="float-right d-flex align-items-center mt-2">
                                <button class="btn btn-primary float-right">CSV出力</button>
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
import actionLoading from '../mixin/actionLoading';
import { showSuccess } from '../helpers/error';

export default {
    data() {
        return {
            editmode: false,
            currentDate: new Date(),
            displayDate: new Date(),
            days: [],
            attendance: {},
            total: {},
            selectedMonth: '',
            month: new Date('YYYY-MM'),
            officeName: '',
            offices: [],
        }
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
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('YYYY-MM');
            return new Date(date.getFullYear(), date.getMonth(), 1);
        },
        getNextMonthDate() {
            const date = this.currentDate;
            this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY年 M月');
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY-MM');
            return new Date(date.getFullYear(), date.getMonth() + 1, 1);
        },
        getPrevMonthDate() {
            const date = this.currentDate;
            this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY年 M月');
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY-MM');
            return new Date(date.getFullYear(), date.getMonth() - 1, 1);
        },
        getResults(month_date) {
            this.updateTable(month_date);
        },
        currentTime(){
            var today = new Date();
            var month = today.getMonth() + 1;
            var day = today.getDate();
            return month + "月" + day + "日 "
            + today.getHours() + ":"
            + today.getMinutes();
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
        this.selectedMonth = moment(this.displayDate).format('YYYYMM');
        this.month = moment(this.displayDate).format('YYYY-MM');
        this.displayDate = moment(this.displayDate).format('YYYY年 M月');
        this.getResults(this.getThisMonthDate());
    },
    mounted() {
    }
};
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
