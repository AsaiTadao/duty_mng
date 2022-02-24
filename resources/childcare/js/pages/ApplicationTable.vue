<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">仙台本社</h3>
                            <div class="mx-5">申請用帳票</div>
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
                            <button type="button" class="btn btn-primary float-right" @click="exportExcel()">
                                Excel出力
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="m-2">
                                    [{{displayDate}}]
                                </div>
                                <div class="m-2">
                                    {{total.officeName}}
                                </div>
                                <div class="m-2">
                                    定員
                                </div>
                                <div class="m-2">
                                    {{total.employeeCount}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <table class="table table-bordered table-diary text-center h-100">
                                        <tbody>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    0歳児
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenStat[1]}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    1歳児
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenStat[2]}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    2歳児
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenStat[3]}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    3歳児
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenStat[4]}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    4歳児
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenStat[5]}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    5歳児
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenStat[6]}}名
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-bordered table-diary text-center h-100">
                                        <tbody>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    従業員枠
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenTypeStat.employeeQuota}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    地域枠
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenTypeStat.regional}}名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    従業員枠割合
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenTypeStat.employeeQuotaRatio}}%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    地域枠割合
                                                </td>
                                                <td class="align-middle">
                                                    {{total.childrenTypeStat.regionalRatio}}%
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100 overflow-scroll-x">
                                        <table class="table table-bordered table-diary text-center w-2500-px">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="dark-blue header-fix-sub" style="width:10%; left: 0; z-index: 12 !important;outline: 1px;" colspan="3">
                                                        日付
                                                    </th>
                                                    <th v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex" class="align-middle light-blue" style="left: 77px;z-index: 13 !important;outline: 1px;">
                                                        {{dayIndex}}
                                                    </th>
                                                    <th rowspan="2" class="align-middle">
                                                        合計
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="align-middle dark-blue header-fix-sub" colspan="3">曜日</th>
                                                    <th v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex" class="align-middle light-blue">
                                                        <div v-if="getWeekEnd(dayIndex) === 1" class="blue">{{getDay(dayIndex)|formatWeek}}</div>
                                                        <div v-else-if="getWeekEnd(dayIndex) === 2" class="red">{{getDay(dayIndex)|formatWeek}}</div>
                                                        <div v-else>{{getDay(dayIndex)|formatWeek}}</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td class="dark-blue align-middle header-fix-sub" rowspan="5">
                                                        延長時間
                                                    </td>
                                                    <td class="light-blue header-fix-sub-89">
                                                        通常開所時間
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        A
                                                    </td>
                                                    <td v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex+'A'" class="align-middle">
                                                        {{extension.a}}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        18:31～19:00
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        B
                                                    </td>
                                                    <td v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex+'B'" class="align-middle">
                                                        {{extension.b}}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        19:01～19:30
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        C
                                                    </td>
                                                    <td v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex+'C'" class="align-middle">
                                                        {{extension.c}}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        19:31～20:00
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        D
                                                    </td>
                                                    <td v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex+'D'" class="align-middle">
                                                        {{extension.d}}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        それ以外
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        E
                                                    </td>
                                                    <td v-for="(extension, dayIndex) in total.childrenStat.extensionStat" :key="dayIndex+'E'" class="align-middle">
                                                        {{extension.e}}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table v-for="(childrenClass, index) in total.childrenTable" :key="index" class="table table-bordered table-diary text-center w-3500-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            {{index - 1}}歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle" style="width:150px;">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle" style="width:100px;">
                                                年齢
                                            </td>
                                            <td rowspan="2" class="align-middle" style="width:200px;">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle" style="width:150px;">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle" style="width:80px;">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle" style="width:100px;">支給認定証</td>
                                            <td rowspan="2" class="align-middle" style="width:150px;">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                            <td rowspan="2" class="align-middle">備考</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day + '-childtable'" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr v-for="(child, index) in childrenClass" :key="index">
                                            <td class="header-fix-sub-40 bg-white">
                                                {{index + 1}}
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                {{changeBirthFormat(child.birthDay)}}
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                {{child.name}}
                                            </td>
                                            <td>
                                                {{changeBirthFormat(child.birthDay)}}
                                            </td>
                                            <td>{{getAge(child.birthday)}}</td>
                                            <td>{{child.type}}</td>
                                            <td>{{child.type}}</td>
                                            <td>{{child.freeOfCharge}}</td>
                                            <td>{{child.certificateOfPayment}}</td>
                                            <td>{{child.certificateExpirationDate}}</td>
                                            <td>{{child.taxExemptHousehold}}</td>
                                            <td v-for="(stat,dayIndex) in child.extensionState" :key="dayIndex+'AB'" class="align-middle">
                                                {{stat}}
                                            </td>
                                            <td>{{child.attendCount}}</td>
                                            <td>{{child.absentCount}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{child.exitDate}}</td>
                                            <td>〇</td>
                                            <td></td>
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
import actionLoading from '../mixin/actionLoading';
import { showSuccess } from '../helpers/error';
import api, { apiErrorHandler } from '../global/api';
import LocalStorage from '../helpers/localStorage';

export default {
    mixins: [actionLoading],
    data () {
        return {
            editmode: false,
            currentDate: new Date(),
            displayDate: new Date(),
            days: [],
            applications: {},
            total: {
                childrenStat: [],
                childrenTypeStat: {
                    employeeQuota: null,
                    regional: null,
                    employeeQuotaRatio: null,
                    regionalRatio: null
                }
            },
            selectedMonth: '',
            month: new Date('YYYY-MM'),
            officeName: '',
            officeId: 1,
            offices: [],
        }
    },
    methods: {
        getWeekEnd(index) {
            const weekDay = moment(this.month + '-' + ('0' + index).slice(-2)).format('ddd');
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
            this.getTotalData();
            return new Date(date.getFullYear(), date.getMonth(), 1);
        },
        getNextMonthDate() {
            const date = this.currentDate;
            this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY年 M月');
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY-MM');
            this.getTotalData();
            return new Date(date.getFullYear(), date.getMonth() + 1, 1);
        },
        getPrevMonthDate() {
            const date = this.currentDate;
            this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY年 M月');
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY-MM');
            this.getTotalData();
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
        getOffices() {
                api.get('office/user-capable')
                    .then(response => {
                        this.offices = response;
                        const office = this.offices.find(office => office.id === this.officeId);
                        this.officeName = office ? office.name : '';
                        if(this.offices && this.offices.length > 0) {
                            this.officeId = this.offices[0].id;
                            this.getTotalData();
                        }
                    })
                    .catch(e => apiErrorHandler(e))
        },
        getTotalData() {
                if(this.actionLoading) return;
                this.setActionLoading();
                api.get(process.env.MIX_API_BASE_URL + '/childcare-application-table/' + this.officeId, null, {month: this.month})
                    .then(response => {
                        this.unsetActionLoading();
                        this.total = response;
                        console.log(this.total);
                    })
                    .catch(e => {
                        this.unsetActionLoading();
                        apiErrorHandler(e);
                    });
        },
        getDay(dayIndex) {
            return moment(this.month + '-' + ('0' + dayIndex).slice(-2)).format('YYYY-MM-DD');
        },
        getAge(birthDay) {
           if (!birthDay) return null;
            const ageInMonth = moment().diff(birthDay, 'months');
            const y = Math.floor(ageInMonth / 12);
            const m = ageInMonth % 12;
            return (y ? y + '歳' : '') + (m ? m + 'ヶ月' : '');
        },
        changeBirthFormat(birthDay) {
            if(birthDay) {
                return moment(birthDay).format('YYYY年 M月 D日');
            }
            return null;
        },
        exportExcel() {
            console.log(this.officeId);
            location.href = process.env.MIX_APP_BASE_URL + 'childcare-application-table/excel/' + this.officeId + '?month=' + this.month + '&token=' + LocalStorage.getToken();
        }
    },
    mounted() {
        this.selectedMonth = moment(this.displayDate).format('YYYYMM');
        this.month = moment(this.displayDate).format('YYYY-MM');
        this.displayDate = moment(this.displayDate).format('YYYY年 M月');
        this.getResults(this.getThisMonthDate());
        //this.getOffices();
        this.getTotalData();
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
