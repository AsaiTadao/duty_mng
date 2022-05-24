<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">{{ officeName }}</h3>
                            <div class="card-tools calendar-center flex-grow-1">
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0" style="height: 500px;" id="children_attendance_table">
                                <table class="table table-bordered table-striped table-children table-head-fixed table-hover">
                                    <thead class="text-center text-white">
                                        <tr class="dark-brown">
                                            <th>クラス</th>
                                            <th>氏名</th>
                                            <th>登園時間</th>
                                            <th>降園時間</th>
                                            <th>欠席</th>
                                            <th>延長</th>
                                            <th>連絡帳</th>
                                            <th>編集</th>
                                            <th style="width: 120px;">日誌</th>
                                        </tr>
                                    </thead>
                                        <tbody class="text-center">
                                            <template v-for="(attendance, index1) in attendances">
                                                <template v-for="(indiAttendance, index2) in attendance">
                                                    <tr :key="index1 + '_' + index2">
                                                        <td v-if="index2 == 0" :rowspan="attendance.length" class="dark-brown align-middle">
                                                            {{index1}}歳児
                                                        </td>
                                                        <td class="align-middle">
                                                            <router-link :to="{name: 'children-detail', params: {id: indiAttendance.id}}">
                                                                {{indiAttendance.name}}
                                                            </router-link>
                                                        </td>
                                                        <td class="align-middle">{{changeTimeFormat(indiAttendance.commutingTime)}}</td>
                                                        <td class="align-middle">{{changeTimeFormat(indiAttendance.leaveTime)}}</td>
                                                        <td class="align-middle">{{getAbsenceName(indiAttendance.reasonForAbsenceId, indiAttendance.noSchedule)}}</td>
                                                        <td class="align-middle">{{changeExtensionFormat(indiAttendance.extension)}}</td>
                                                        <td class="align-middle">
                                                            <router-link :to="{name: 'contact-book', params: {id: indiAttendance.id, date: selectedDate}}">
                                                                <template v-if="indiAttendance.contactStatus == 0">未入力</template>
                                                                <template v-else-if="indiAttendance.contactStatus == 1">一時保存</template>
                                                                <template v-else-if="indiAttendance.contactStatus == 2">完了</template>
                                                            </router-link>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a href="javascript:void(0)" @click="onEditClicked(indiAttendance.id)">編集</a>
                                                            <div class="tooltip3" v-if="indiAttendance.notificationChildId">
                                                                <i v-if="indiAttendance.processFlag == 0" class="fas fa-bell text-danger" @click="onFinishNotice(indiAttendance.notificationChildId, 1)"></i>
                                                                <i v-else-if="indiAttendance.processFlag == 1" class="fas fa-bell-slash text-gray" @click="onFinishNotice(indiAttendance.notificationChildId, 0)"></i>
                                                                <div class="description3">{{ indiAttendance.notificationMessage }}</div>
                                                            </div>
                                                        </td>
                                                        <td v-if="index2 == 0" :rowspan="attendance.length" class="align-middle">
                                                            <div>
                                                                <router-link class="btn btn-primary mb-1"
                                                                    :to="{name: 'childcare-diary-read', params: {classId: index1 + 1}, query: {date: selectedDateLabel}}">
                                                                    日誌閲覧
                                                                </router-link>
                                                            </div>
                                                            <div>
                                                                <router-link class="btn btn-primary mb-1"
                                                                    :to="{name: 'childcare-diary', params: {classId: index1 + 1}, query: {date: selectedDateLabel}}">
                                                                    日誌作成
                                                                </router-link>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </template>
                                            </template>
                                        </tbody>
                                </table>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="attend-edit-form" tabindex="-1" role="dialog" aria-labelledby="attend-edit-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <edit-form :editData="editFormData" :date="selectedDate" v-on:success="onAttendSaved"></edit-form>
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
import Datepicker from "vuejs-datepicker";
import { ja } from 'vuejs-datepicker/dist/locale';
import moment from 'moment-timezone';
import { mapState } from 'vuex';
import actionLoading from '../mixin/actionLoading';
import EditForm from './ChildrenAttendances/EditForm.vue';
import api, { apiErrorHandler } from '../global/api';

export default {
    components: {
        Datepicker,
        EditForm
    },
    mixins: [actionLoading],
    data () {
        return {
            editmode: false,
            currentDate: new Date(),
            todayDate: "",
            days: [],
            attends : [],
            attendances: [],
            selectedAttend : null,
            selectedUser: null,
            requests : [],
            offices: [],
            officeId: 1,
            selectedDate: new Date(),
            ja: ja,
            selectedApp: {},
            selectedAppUserName: '',
            editFormData: {},
        }
    },
    computed: {
        ...mapState({
                reasonForAbsences: state => state.constants.reasonForAbsences,
                session: state => state.session.info
            }),
        selectedDateLabel() {
            return moment(this.selectedDate).format('YYYY-MM-DD');
        },
        officeName() {
            if (!this.session.office) return '';
            return this.session.office.name;
        }
    },
    methods: {
        onEditClicked(childId) {
            const child = this.attends.find(({ id }) => childId === id);
            this.editFormData = {
                ...child
            }
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
            api.get('attendance', null, {date: this.selectedDate})
                .then(response => {
                    this.unsetActionLoading();
                    this.attends = response;

                    this.attendances = [];
                    for(let i = 0; i < 6; i++) {
                        this.attendances[i] = [];
                    }
                    this.attends.forEach(element => {
                        for(let i = 0; i < 6; i++) {
                            if(i === element.classId - 1) {
                                this.attendances[element.classId - 1] = [...this.attendances[element.classId - 1], element];
                            }
                        }
                    });
                })
                .catch(e => {
                    this.unsetActionLoading();
                    apiErrorHandler(e);
                });
        },
        getAbsenceName(reasonForAbsenceId, noSchedule) {
            if(reasonForAbsenceId){
                if(noSchedule) {
                    if(this.reasonForAbsences.find(item => item.id === reasonForAbsenceId))
                        return '（予）' + this.reasonForAbsences.find(item => item.id === reasonForAbsenceId).name;
                    else
                        return null;
                } else {
                    if(this.reasonForAbsences.find(item => item.id === reasonForAbsenceId))
                        return this.reasonForAbsences.find(item => item.id === reasonForAbsenceId).name;
                    else
                        return null;
                }

            } else {
                if(noSchedule) return '託児計画なし';
                return null;
            }
        },
        onWorkStatusSaved() {
            this.getAttendanceData(this.selectedDate);
            $("#attend-edit-form").modal('hide');
        },
        onAttendSaved() {
            this.getAttendanceData(this.selectedDate);
            $("#attend-edit-form").modal('hide');
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
                return moment(date).format('HH:mm');
            } else {
                return "-";
            }
        },
        changeExtensionFormat(extension) {
            if(extension) {
                return moment(extension, 'hh:mm:ss').format('HH:mm');
            }
            return null;
        },
        openDatePicker(){
            this.$refs.programaticOpen.showCalendar();
        },
        openDiary() {
            this.$router.push('childcare-diary');
        },
        getParam(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        },
        onFinishNotice(childId, bool) {
            if (bool) {
                var result = window.confirm('アラートを終了します');
            } else {
                var result = window.confirm('アラートを戻します');
            }
            if( result ) {
                return window.location.href = "/notice-finish/"+childId+"/"+ moment(this.selectedDate).format('YYYY-MM-DD') +"/"+bool;
            }
        },
    },
    created() {

    },
    mounted() {
        var date = this.getParam('date');
        if (date && moment(date).isValid()) {
            this.todayDate = date.toString();
            this.getAttendanceData(new Date(date));
        } else {
            this.todayDate = this.getCurrentDate().toString();
            this.getAttendanceData(this.currentDate);
        }
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
    .tooltip3{
        position: relative;
        cursor: pointer;
        display: inline-block;
    }
    .tooltip3 i{
        margin:0;
        padding:0;
    }
    .description3 {
        display: none;
        position: absolute;
        padding: 10px;
        font-size: 12px;
        line-height: 1.6em;
        color: #fff;
        border-radius: 5px;
        background: #000;
        width: 250px;
        z-index:500;
    }
    .tooltip3:hover .description3{
        display: inline-block;
        top: 30px;
        left: -125px;
    }
</style>
