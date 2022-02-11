<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title row">
                            <div class="col-md-6 col-12 row">
                                <h4 class="card-title col-4 mb-0">テラル保育園</h4>
                                <label class="card-title col-4 mb-0">ー連絡帳ー</label>
                                <label class="card-title col-4 mb-0">山田　三越</label>
                            </div>
                            <div class="col-md-6 col-12 row d-flex align-items-center">
                                <div class="col-8 d-flex align-items-center">
                                    <datepicker
                                    :language="ja"
                                    :format="customFormatter"
                                    ref="programaticOpen"
                                    :placeholder="todayDate"
                                    @selected="getAttendanceData"
                                    v-model="selectedDate">
                                    </datepicker>
                                    <button type="button" class="btn btn-sm btn-outline mx-2" @click="openDatePicker()">
                                    <i class="fas fa-calendar-alt fa-2x"></i>
                                    </button>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <label for="weatherStauts" class="col-form-label mr-1">天気</label>
                                    <input type="text" class="form-control fixed-width-80" value="晴れ" id="weatherStauts"/>
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
                                <button class="btn btn-primary float-right mr-2">編集</button>
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
import actionLoading from '../mixin/actionLoading';
import api, { apiErrorHandler } from '../global/api';

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
</style>
