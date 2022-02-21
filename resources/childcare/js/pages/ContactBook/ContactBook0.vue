<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title row">
                            <div class="col-md-6 col-12 row">
                                <h5 class="card-title col-4 mb-0 px-0">テラル保育園</h5>
                                <div class="col-4 mb-0 px-0">ー連絡帳ー</div>
                                <div class="col-4 mb-0 px-0">山田　三越</div>
                            </div>
                            <div class="col-md-6 col-12 row d-flex align-items-center">
                                <div class="col-7 d-flex align-items-center p-0">
                                    <datepicker
                                    :language="ja"
                                    :format="customFormatter"
                                    ref="programaticOpen"
                                    :placeholder="todayDate"
                                    @selected="getAttendanceData"
                                    v-model="selectedDate">
                                    </datepicker>
                                    <button type="button" class="btn btn-sm btn-outline mx-0" @click="openDatePicker()">
                                    <i class="fas fa-calendar-alt fa-2x"></i>
                                    </button>
                                </div>
                                <div class="col-5 d-flex align-items-center px-0">
                                    <div for="weatherStauts" class="col-form-label mr-2">天気</div>
                                    <input type="text" class="form-control fixed-width-80 px-0" value="晴れ" id="weatherStauts"/>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-4 col-sm-12">
                                    記入者 保護者様名：山田　三越
                                </div>
                                <div class="col-md-3 col-sm-10" style="display:flex;">
                                    <label for="mindername" style="min-width: 80px;">保育士名：</label>
                                    <input type="text" class="form-control" id="mindername" style="width: calc(100% - 85px);"/>
                                </div>
                            </div>
                            <div class="row" style="padding-left:15px; padding-right:15px;">
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        機嫌
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink form-check text-center py-2">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label mr-4">普通</label>
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label mr-4">良い</label>
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label mr-4">悪い</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        検温
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <div>
                                            <input type="number" class="form-control p-1" min="0" max="24">

                                        </div>
                                        <span class="p-1">:</span>
                                        <div>
                                            <input type="number" class="form-control p-1" min="0" max="60">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <input type="text" class="form-control" style="max-width: 40%;"/>℃　
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:15px; padding-right:15px;">
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        お迎え時間
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <div>
                                            <input type="number" class="form-control p-1" min="0" max="24">

                                        </div>
                                        <span class="p-1">:</span>
                                        <div>
                                            <input type="number" class="form-control p-1" min="0" max="60">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        お迎えの方
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center py-2">
                                        山田　光子
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive p-0" id="contactbook">
                                <table class="table table-bordered table-children">
                                    <thead class="text-center text-white">
                                        <tr class="dark-brown">
                                            <th class="contactbook-fix dark-brown">時間</th>
                                            <th>睡眠</th>
                                            <th>検温</th>
                                            <th>排便</th>
                                            <th>食事・その他</th>
                                        </tr>
                                    </thead>
                                        <tbody class="text-center contactbook-tr">
                                            <template v-for="(hour, index) in hours">
                                                <tr :key="hour.time+'hours'">
                                                    <td rowspan="2" class="align-middle contactbook-fix">{{hour.time}}時</td>
                                                    <td class="text-center" style="position:relative;" @click="setHour(index, 1)">
                                                        <div v-if="hour.enabled1" style="background-color: #8BB3FC; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                    </td>
                                                    <td rowspan="2">
                                                        <div class="d-flex justify-content-center" style="width: fit-content; margin: auto;">
                                                            <input type="text" class="form-control"/>
                                                            <label class="align-self-center m-0 ml-1">℃</label>
                                                        </div>
                                                    </td>
                                                    <td rowspan="2">
                                                        <select class="form-control">
                                                            <option>-</option>
                                                            <option>普通</option>
                                                            <option>軟い</option>
                                                            <option>固い</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="2">
                                                        <input type="text" class="form-control px-2" />
                                                    </td>
                                                </tr>
                                                <tr :key="hour.time+'30mins'">
                                                    <td class="text-center" style="position:relative;" @click="setHour(index, 2)">
                                                        <div v-if="hour.enabled2" style="background-color: #8BB3FC; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="dark-blue text-center py-2 text-white">
                                        家庭での様子
                                    </div>
                                    <div class="light-blue p-4 mt-1" style="height: 300px;">
                                        夜泣きがありましたが、その後はぐっすり眠りました。
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="dark-yellow text-center py-2 text-white">
                                        保育園での様子
                                    </div>
                                    <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                        <textarea class="form-control" style="height: 95%;">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="dark-blue text-center py-2 text-white">
                                        家庭からの連絡事項
                                    </div>
                                    <div class="light-blue p-4 mt-1" style="height: 300px;">
                                        夜泣きがありましたが、その後はぐっすり眠りました。
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="dark-yellow text-center py-2 text-white">
                                        保育園からの連絡事項
                                    </div>
                                    <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                        <textarea class="form-control" style="height: 95%;">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right d-flex align-items-center mt-2">
                                <button class="btn btn-primary float-right mr-2">登録</button>
                                <button class="btn btn-primary float-right">Excel出力</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Datepicker from "vuejs-datepicker";
import { ja } from 'vuejs-datepicker/dist/locale';
import moment from 'moment-timezone';
import { mapState } from 'vuex';
import actionLoading from '../../mixin/actionLoading';
import api, { apiErrorHandler } from '../../global/api';

export default {
    components: {
        Datepicker
    },
    mixins: [actionLoading],
    data () {
        return {
            editmode: false,
            currentDate: new Date(),
            todayDate: "",
            days: [],
            hours: [
                {
                    time:'18',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'19',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'20',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'21',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'22',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'23',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'24',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'1',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'2',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'3',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'4',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'5',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'6',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'7',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'8',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'9',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'10',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'11',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'12',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'13',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'14',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'15',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'16',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'17',
                    enabled1: true,
                    enabled2: true,
                }],
            attends : [],
            selectedAttend : null,
            selectedUser: null,
            requests : [],
            offices: [],
            officeName: '',
            officeId: 1,
            selectedDate: new Date(),
            ja: ja,
            selectedApp: {},
            selectedAppUserName: '',
        }
    },
    methods: {
        setHour(hourIndex, number) {
            if(number == 1)
                this.hours[hourIndex].enabled1 = !this.hours[hourIndex].enabled1;
            else if(number == 2)
                this.hours[hourIndex].enabled2 = !this.hours[hourIndex].enabled2;
        },
        getOffices() {
            api.get('office/user-capable')
                .then(response => {
                    this.offices = response;
                    const office = this.offices.find(office => office.id === this.officeId);
                    this.officeName = office ? office.name : '';
                })
                .catch(e => apiErrorHandler(e))
        },
        onEditClicked(attend, userId) {
            if(!attend) return;
            this.selectedAttend = attend;
            this.selectedUser = userId;
            this.showEditForm();
        },
        showEditForm() {
            $("#attend-edit-form").modal('show');
        },
        isHonShya(officeId) {
            const office = this.offices.find(office => office.id === officeId);
            let name = office ? office.name : '';
            if(name.indexOf('本社') !== -1) {
                return true;
            } else {
                return false;
            }
        },
        isNormalStaff(employmentStatusId) {
            if(employmentStatusId === 1) {
                return true;
            } else {
                return false;
            }
        },
        notZero(number) {
            if(number > 0) {
                return Math.floor(number).toString() + '分';
            } else {
                return '-';
            }
        },
        getAttendanceData(date) {
            if(this.actionLoading) return;
            this.setActionLoading();
            if(date){
                this.selectedDate = date;
            } else {
                this.selectedDate = new Date();
            }
            this.selectedDate = moment(this.selectedDate).format('YYYY-MM-DD');
            api.get('attend/' + this.officeId, null, {date: this.selectedDate})
                .then(response => {
                    this.unsetActionLoading();
                    this.attends = response;
                    const office = this.offices.find(office => office.id === this.officeId);
                    this.officeName = office ? office.name : '';
                })
                .catch(e => {
                    this.unsetActionLoading();
                    apiErrorHandler(e);
                });
        },
        onWorkStatusSaved() {
            this.getAttendanceData(this.selectedDate);
            $("#attend-edit-form").modal('hide');
        },
        onAppSaved() {
            this.getAttendanceData(this.selectedDate);
            $("#app-aprove-form").modal('hide');
        },
        isThisMonth() {
            const today = new Date();
            return this.currentDate.getFullYear() == today.getFullYear() && this.currentDate.getMonth() == today.getMonth();
        },
        getNextMonthDate() {
            const date = this.currentDate;
            return new Date(date.getFullYear(), date.getMonth() + 1, 1);
        },
        getPrevMonthDate() {
            const date = this.currentDate;
            return new Date(date.getFullYear(), date.getMonth() - 1, 1);
        },
        getResults(month_date) {
            // this.$Progress.start();
            // this.loadAttends(month_date);
            // this.loadRequests(month_date);
            this.updateTable(month_date);
            // this.$Progress.finish();
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
        onApprove(application, userName){
            this.editmode = true;
            this.selectedApp = application;
            this.selectedAppUserName = userName;
            $('#app-aprove-form').modal('show');
        },
        getCurrentDate(){
            return moment().format('YYYY年 M月 D日 (ddd)');
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
            for(let day = firstDay; day <= lastDay; day++) {
                this.days.push(new Date(date.getFullYear(), date.getMonth(), day));
            }

        },
        customFormatter(date) {
            return moment(date).format('YYYY年 M月 D日 (ddd)');
        },
        changeTimeFormat(date) {
            if(date) {
                return moment(date).tz('Asia/Tokyo').format('HH:mm');
            } else {
                return "-";
            }
        },
        openDatePicker(){
            this.$refs.programaticOpen.showCalendar();
        }
    },
    created() {

    },
    mounted() {
        //this.getResults(this.currentDate);
        this.todayDate = this.getCurrentDate().toString();
        //this.getOffices();
        //this.getAttendanceData(this.currentDate);
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
@media (max-width: 500px) {
       h5.card-title {
           font-size: 13px!important;
       }
    }
</style>
<style>
div.vdp-datepicker input{
    width: 145px;
}
@media (max-width: 500px) {

    div.vdp-datepicker input{
        font-size: 10px;
        width: 100px;
    }
}
</style>
