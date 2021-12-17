<template>
    <div class="card-body">
        <div class="float-right">
            <label>一括承認する</label>
            <input type="checkbox" class="align-middle">
        </div>
        <div class="table-responsive p-0 overflow-scroll-x" style="height: 500px;" @scroll="handleScroll()">
            <table class="table table-bordered table-striped table-kintai table-head-fixed table-hover w-2500-px">
                <thead class="text-center text-white">
                    <tr>
                        <th rowspan="2" class="align-middle p-0" style="left: 0;z-index: 12 !important;outline: 1px solid white;">日付</th>
                        <th rowspan="2" class="align-middle p-0" style="left: 68px;z-index: 13 !important;outline: 1px solid white;">曜日</th>
                        <th rowspan="2" class="align-middle">出勤①</th>
                        <th rowspan="2" class="align-middle">退勤①</th>
                        <th rowspan="2" class="align-middle p-0">遅刻</th>
                        <th rowspan="2" class="align-middle p-0">早退</th>
                        <th rowspan="2" class="align-middle">出勤②</th>
                        <th rowspan="2" class="align-middle">退勤②</th>
                        <th rowspan="2" class="align-middle p-0">遅刻</th>
                        <th rowspan="2" class="align-middle p-0">早退</th>
                        <th rowspan="2" class="align-middle">実働<br>時間</th>
                        <th rowspan="2" class="align-middle">休憩<br>時間</th>
                        <th rowspan="2" class="align-middle">残業外<br>労働時間</th>
                        <th rowspan="2" class="align-middle">法定内<br>残業時間</th>
                        <th rowspan="2" class="align-middle">法定外<br>残業時間</th>
                        <th rowspan="2" class="align-middle">深夜<br>時間</th>
                        <th rowspan="2" class="align-middle p-0">シフト外出勤</th>
                        <th colspan="2" class="align-middle">代休日</th>
                        <th rowspan="2" class="align-middle">連勤日</th>
                        <th colspan="2">年次有休</th>
                        <th colspan="2">特休有給</th>
                        <th colspan="2">特休無給</th>
                        <th colspan="2">その他無給</th>
                        <th rowspan="2" class="align-middle">欠勤日</th>
                        <th rowspan="2" class="align-middle">休暇・欠勤理由</th>
                        <th rowspan="2" class="align-middle">備考</th>
                        <th rowspan="2" class="align-middle p-0">編集</th>
                        <th rowspan="2" class="align-middle p-0">承認</th>
                    </tr>
                    <tr class="heavy-green header-fix-y">
                        <th>時間</th>
                        <th>日付</th>
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
                        <tr v-for="(dayAttendance, index) in attendance" :key="dayAttendance.id">
                            <template  v-if="editMode && selectedIndex == index">
                                <td class="header-fix-x">{{index}}日</td>
                                <td v-if="getWeekEnd(index) === 1" class="blue header-fix-x-68">{{getDate(index)|formatWeek}}</td>
                                <td v-else-if="getWeekEnd(index) === 2" class="red header-fix-x-68">{{getDate(index)|formatWeek}}</td>
                                <td v-else class="header-fix-x-68">{{getDate(index)|formatWeek}}</td>
                                <td>
                                    <input type="text" v-model="editData.startWorkTime1" :class="{'is-invalid' : errors.startWorkTime1}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.startWorkTime1" class="error invalid-feedback">
                                        {{ errors.startWorkTime1 }}
                                    </span>
                                </td>
                                <td>
                                    <input type="text" v-model="editData.endWorkTime1" :class="{'is-invalid' : errors.endWorkTime1}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.endWorkTime1" class="error invalid-feedback">
                                        {{ errors.endTime1 }}
                                    </span>
                                </td>
                                <td>{{notZero(dayAttendance.behindTime1)}}</td>
                                <td>{{notZero(dayAttendance.leaveEarly1)}}</td>
                                <td>
                                    <input type="text" v-model="editData.startWorkTime2" :class="{'is-invalid' : errors.startWorkTime2}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.startWorkTime2" class="error invalid-feedback">
                                        {{ errors.startWorkTime2 }}
                                    </span>
                                </td>
                                <td>
                                    <input type="text" v-model="editData.endWorkTime2" :class="{'is-invalid' : errors.endWorkTime2}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.endWorkTime2" class="error invalid-feedback">
                                        {{ errors.endWorkTime2 }}
                                    </span>
                                </td>
                                <td>{{notZero(dayAttendance.behindTime2)}}</td>
                                <td>{{notZero(dayAttendance.leaveEarly2)}}</td>
                                <td>{{dayAttendance.workingHours ? (dayAttendance.workingHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.restHours ? (dayAttendance.restHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.actualWorkingHours ? (dayAttendance.actualWorkingHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.overtimeHoursStatutory ? (dayAttendance.overtimeHoursStatutory / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.overtimeHoursNonStatutory ? (dayAttendance.overtimeHoursNonStatutory / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.midnightOvertime ? (dayAttendance.midnightOvertime / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.offShiftWorkingHours ? (dayAttendance.offShiftWorkingHours / 60).toFixed(2) : '-'}}</td>
                                <td>
                                    <input type="text" v-model="editData.substituteTime" :class="{'is-invalid' : errors.substituteTime}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.substituteTime" class="error invalid-feedback">
                                        {{ errors.substituteTime }}
                                    </span>
                                </td>
                                <td>{{dayAttendance.substituteDay}}
                                    <input type="text" v-model="editData.substituteDay" :class="{'is-invalid' : errors.substituteDay}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.substituteDay" class="error invalid-feedback">
                                        {{ errors.substituteDay }}
                                    </span>
                                </td>
                                <td>-</td>
                                <td>
                                    <input type="text" v-model="editData.annualPaidTime" :class="{'is-invalid' : errors.annualPaidTime}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.annualPaidTime" class="error invalid-feedback">
                                        {{ errors.annualPaidTime }}
                                    </span>
                                </td>
                                <td>
                                    <input type="checkbox" v-model="editData.annualPaidHoliday" />
                                </td>
                                <td>
                                    <input type="text" v-model="editData.specialPaidTime" :class="{'is-invalid' : errors.specialPaidTime}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.specialPaidTime" class="error invalid-feedback">
                                        {{ errors.specialPaidTime }}
                                    </span>
                                </td>
                                <td>
                                    <input type="checkbox" v-model="editData.specialPaidHoliday" />
                                </td>
                                <td>
                                    <input type="text" v-model="editData.specialUnpaidTime" :class="{'is-invalid' : errors.specialUnpaidTime}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.specialUnpaidTime" class="error invalid-feedback">
                                        {{ errors.specialUnpaidTime }}
                                    </span>
                                </td>
                                <td>
                                    <input type="checkbox" v-model="editData.specialUnPaidHoliday" />
                                </td>
                                <td>
                                    <input type="text" v-model="editData.otherUnpaidTime" :class="{'is-invalid' : errors.otherUnpaidTime}" class="fixed-width-50"/>
                                    <span v-if="editMode && errors.otherUnpaidTime" class="error invalid-feedback">
                                        {{ errors.otherUnpaidTime }}
                                    </span>
                                </td>
                                <td>
                                    <input type="checkbox" v-model="editData.otherUnPaidHoliday" />
                                </td>
                                <td><input type="checkbox"></td>
                                <td>
                                    <select>
                                        <option v-for="item in reasonForVacations" :key="item.id" :value="item.id">{{item.name}}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" v-model="editData.note">
                                </td>
                                <td>
                                    <a href="#" class="mx-2" @click="editOk">
                                        <i class="far fa-check-circle fa-lg"></i>
                                    </a>
                                    <a href="#" class="mx-2" @click="editCancel">
                                        <i class="far fa-window-close fa-lg"></i>
                                    </a>
                                </td>
                                <td>
                                    <input type="checkbox">
                                </td>
                            </template>
                            <template v-else>
                                <td class="header-fix-x">{{index}}日</td>
                                <td v-if="getWeekEnd(index) === 1" class="blue header-fix-x-68">{{getDate(index)|formatWeek}}</td>
                                <td v-else-if="getWeekEnd(index) === 2" class="red header-fix-x-68">{{getDate(index)|formatWeek}}</td>
                                <td v-else class="header-fix-x-68">{{getDate(index)|formatWeek}}</td>
                                <td>{{changeTimeFormat(dayAttendance.commutingTime1)}}</td>
                                <td>{{changeTimeFormat(dayAttendance.leaveTime1)}}</td>
                                <td>{{notZero(dayAttendance.behindTime1)}}</td>
                                <td>{{notZero(dayAttendance.leaveEarly1)}}</td>
                                <td>{{changeTimeFormat(dayAttendance.commutingTime2)}}</td>
                                <td>{{changeTimeFormat(dayAttendance.leaveTime2)}}</td>
                                <td>{{notZero(dayAttendance.behindTime2)}}</td>
                                <td>{{notZero(dayAttendance.leaveEarly2)}}</td>
                                <td>{{dayAttendance.workingHours ? (dayAttendance.workingHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.restHours ? (dayAttendance.restHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.actualWorkingHours ? (dayAttendance.actualWorkingHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.overtimeHoursStatutory ? (dayAttendance.overtimeHoursStatutory / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.overtimeHoursNonStatutory ? (dayAttendance.overtimeHoursNonStatutory / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.midnightOvertime ? (dayAttendance.midnightOvertime / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.offShiftWorkingHours ? (dayAttendance.offShiftWorkingHours / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.substituteTime ? (dayAttendance.substituteTime / 60).toFixed(2) : '-'}}</td>
                                <td>{{dayAttendance.substituteDay}}</td>
                                <td>-</td>
                                <td>{{dayAttendance.annualPaidTime ? (dayAttendance.annualPaidTime / 60).toFixed(2) : '-'}}</td>
                                <template v-if="dayAttendance.annualPaidTime">
                                    <td><i class="fas fa-check fa-lg"></i></td>
                                </template>
                                <template v-else>
                                    <td></td>
                                </template>
                                <td>{{dayAttendance.specialPaidTime ? (dayAttendance.specialPaidTime / 60).toFixed(2) : '-'}}</td>
                                <template v-if="dayAttendance.specialPaidTime">
                                    <td><i class="fas fa-check fa-lg"></i></td>
                                </template>
                                <template v-else>
                                    <td></td>
                                </template>
                                <td>{{dayAttendance.specialUnpaidTime ? (dayAttendance.specialUnpaidTime / 60).toFixed(2) : '-'}}</td>
                                <template v-if="dayAttendance.specialUnpaidTime">
                                    <td><i class="fas fa-check fa-lg"></i></td>
                                </template>
                                <template v-else>
                                    <td></td>
                                </template>
                                <td>{{dayAttendance.otherUnpaidTime ? (dayAttendance.otherUnpaidTime / 60).toFixed(2) : '-'}}</td>
                                <template v-if="dayAttendance.otherUnpaidTime">
                                    <td><i class="fas fa-check fa-lg"></i></td>
                                </template>
                                <template v-else>
                                    <td></td>
                                </template>
                                <td><input type="checkbox" disabled></td>
                                <td>
                                    {{dayAttendance.reason}}
                                </td>
                                <td>
                                    <input type="text"
                                    :value="dayAttendance.applications && dayAttendance.applications.length > 0 ? dayAttendance.applications[0].reason : ''"
                                    readonly>
                                </td>
                                <td>
                                    <a href="#" @click="editRow(index, dayAttendance)">
                                        <i class="fa fa-edit fa-lg blue"></i>
                                    </a>
                                </td>
                                <td><input type="checkbox"></td>
                            </template>
                        </tr>
                    </tbody>
            </table>
        </div>
        <br>
        <div class="table-responsive p-0" id="sumTable1">
            <table class="table table-bordered">
                <tbody class="text-center">
                    <tr class="top-green text-white">
                        <th class="align-middle">勤務日数</th>
                        <th class="align-middle">実働時間</th>
                        <th class="align-middle">残業外<br>労働時間</th>
                        <th class="align-middle">所定労働<br>時間-A</th>
                        <th class="align-middle">所定労働<br>時間-B</th>
                        <th class="align-middle">過不足<br>時間</th>
                        <th class="align-middle">法定内<br>残業時間</th>
                        <th class="align-middle">法定外<br>残業時間</th>
                        <th class="align-middle">深夜時間</th>
                        <th class="align-middle">遅刻時間</th>
                        <th class="align-middle">早退時間</th>
                        <th class="align-middle">シフト外勤務時間</th>
                        <th class="align-middle">代休時間</th>
                        <th class="align-middle">連勤時間</th>
                    </tr>
                    <tr class="heavy-green text-white">
                        <td>{{(total.workingDays / 60).toFixed(2)}}日</td>
                        <td>{{(total.totalWorkingHours / 60).toFixed(2)}}時間</td>
                        <td>{{((total.actualWorkingHoursWeekdays + total.actualWorkingHoursSaturday) / 60).toFixed(2)}}時間</td>
                        <td>{{(total.scheduledWorkingHoursA / 60).toFixed(2)}}時間</td>
                        <td>{{(total.scheduledWorkingHoursB / 60).toFixed(2)}}時間</td>
                        <td>{{(total.excessAndDeficiencyTime / 60).toFixed(2)}}時間</td>
                        <td>{{(total.overtimeHoursStatutory / 60).toFixed(2)}}時間</td>
                        <td>{{(total.overtimeHoursNonStatutory / 60).toFixed(2)}}時間</td>
                        <td>{{(total.midnightOvertime / 60).toFixed(2)}}時間</td>
                        <td>{{(total.behindTime / 60).toFixed(2)}}時間</td>
                        <td>{{(total.leaveEarly / 60).toFixed(2)}}時間</td>
                        <td>{{(total.offShiftWorkingHours / 60).toFixed(2)}}時間</td>
                        <td>{{(total.substituteHolidayTime / 60).toFixed(2)}}時間</td>
                        <td>{{(total.consecutiveWorkingHours / 60).toFixed(2)}}時間</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive p-0" id="sumTable2">
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
</template>
<script>
import moment from 'moment';
import { mapState } from 'vuex';
import api, { apiErrorHandler } from '../../global/api';
import actionLoading from '../../mixin/actionLoading';

    export default {
        props: {
            attendance: {},
            total: {},
            month: '',
        },
        data () {
            return {
                editMode: false,
                currentDate: new Date(),
                displayDate: new Date(),
                scrolling: false,
                timer: null,
                selectedIndex: null,

                editData: {
                    startWorkTime1: '',
                    endWorkTime1: '',
                    startWorkTime2: '',
                    endWorkTime2: '',
                    annualPaidTime: null,
                    annualPaidHoliday: false,
                    specialPaidTime: null,
                    specialPaidHoliday: false,
                    specialUnpaidTime: null,
                    specialUnPaidHoliday: false,
                    otherUnpaidTime: null,
                    otherUnPaidHoliday: false,
                    absenceDay: false,
                    reason: null,
                    note: '',
                },
                errors: {
                    startWorkTime1: '',
                    endWorkTime1: '',
                    startWorkTime2: '',
                    endWorkTime2: '',
                    annualPaidTime: null,
                    annualPaidHoliday: false,
                    specialPaidTime: null,
                    specialPaidHoliday: false,
                    specialUnpaidTime: null,
                    specialUnPaidHoliday: false,
                    otherUnpaidTime: null,
                    otherUnPaidHoliday: false,
                    absenceDay: false,
                    reason: null,
                    note: '',
                }
            }
        },
        computed: {
            ...mapState({
                reasonForVacations: state => state.constants.reasonForVacations
            })
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
            getDate(index) {
                const date = this.month + '-' + ('0' + index).slice(-2);
                return date;
            },
            notZero(number) {
                if(number > 0) {
                    return number + "分";
                } else {
                    return 0;
                }
            },
            editRow(index, dayAttendance) {
                this.selectedIndex = index;
                this.editMode = !this.editMode;
                this.editData.startWorkTime1 = this.changeTimeFormat(dayAttendance.commutingTime1);
                this.editData.endWorkTime1 = this.changeTimeFormat(dayAttendance.leaveTime1);
                this.editData.startWorkTime2 = this.changeTimeFormat(dayAttendance.commutingTime2);
                this.editData.endWorkTime2 = this.changeTimeFormat(dayAttendance.leaveTime2);
                this.editData.annualPaidHoliday = dayAttendance.annualPaidTime ? true : false;
                this.editData.specialPaidHoliday = dayAttendance.specialPaidTime ? true : false;
                this.editData.specialUnPaidHoliday = dayAttendance.specialUnpaidTime ? true : false;
                this.editData.otherUnPaidHoliday = dayAttendance.otherUnpaidTime ? true : false;
                this.editData.annualPaidTime = dayAttendance.annualPaidTime ? (dayAttendance.annualPaidTime / 60).toFixed(2) : 0;
                this.editData.specialPaidTime = dayAttendance.specialPaidTime ? (dayAttendance.specialPaidTime / 60).toFixed(2) : 0;
                this.editData.specialUnPaidTime = dayAttendance.specialUnpaidTime ? (dayAttendance.specialUnpaidTime / 60).toFixed(2) : 0;
                this.editData.otherUnPaidTime = dayAttendance.otherUnpaidTime ? (dayAttendance.otherUnpaidTime / 60).toFixed(2) : 0;
                this.editData.substituteTime = dayAttendance.substituteTime ? (dayAttendance.substituteTime / 60).toFixed(2) : 0;
                this.editData.substituteDay = dayAttendance.substituteDay;
                // this.editData.absenceDay
                this.editData.note = dayAttendance.applications && dayAttendance.applications.length > 0 ? dayAttendance.applications[0].reason : '';
                // this..editData.reason =
            },
            validate() {
                let valid = true;
                if (!this.editData.startWorkTime1) {
                    this.errors.startWorkTime1 = this.$t('Please input name');                                 // need trans
                    valid = false;
                }
                if (!this.editData.endWorkTime1) {
                    this.errors.endWorkTime1 = this.$t('Please input number');                              //need trans
                    valid = false;
                }
                if (!this.editData.startWorkTime2) {
                    this.errors.startWorkTime2 = this.$t('Please select enrolled');
                    valid = false;
                }
                if (!this.editData.endWorkTime2) {
                    this.errors.endWorkTime2 = this.$t('Please select employmentStatusId');
                    valid = false;
                }
                if (!this.editData.annualPaidTime) {
                    this.errors.annualPaidTime = this.$t('Please select region');
                    valid = false;
                }
                if (!this.editData.specialPaidTime) {
                    this.errors.specialPaidTime = this.$t('Please select office');
                    valid = false;
                }
                if (!this.editData.specialUnPaidTime) {
                    this.errors.specialUnPaidTime = this.$t('Please input email');
                    valid = false;
                }
                if (!this.editData.otherUnPaidTime) {
                    this.errors.otherUnPaidTime = this.$t('Please input password');
                    valid = false;
                }
                if (!this.editData.substituteTime) {
                    this.errors.substituteTime = this.$t('Please select working hour');
                    valid = false;
                }
                return valid;
            },
            editOk() {
                if (this.actionLoading) return;
                if (!this.validate()) return;
                const requestData = {
                    'name': this.editData.name,
                    'number': this.editData.number,
                    'employment_status_id': this.editData.employmentStatusId,
                    'enrolled': this.editData.enrolled,
                    'office_id': this.editData.officeId,
                    'email': this.editData.email,
                    'password': this.editData.password,
                    'workingHours': this.editData.workingHours
                };
                this.setActionLoading();
                let request;
                if (this.editData.id) {
                    request = api.put('monthly-summery/' + this.editData.id, null, requestData);
                }
                request.then(() => {
                        this.unsetActionLoading();
                        showSuccess(this.$t("Successfully saved"));
                        this.$emit('success');
                    })
                    .catch(e => {
                        apiErrorHandler(e);
                        this.unsetActionLoading();
                    });
            },
            editCancel() {
                this.editMode = false;
                this.error = [];
            },
            requestModal(){
                this.editMode = true;
                this.firstdate = this.enddate;
                // if(row = this.requests.find(request => request.date.getTime() == date.getTime())) {
                //     this.editMode = true;
                //     this.form.fill(row);
                // } else {
                //     this.editMode = false;
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
            changeTimeFormat(date) {
                if(date) {
                    return moment(date).tz('Asia/Tokyo').format('HH:mm');
                } else {
                    return "-";
                }
            },
            handleScroll() {
                if(this.timer !== null) {
                    clearTimeout(this.timer);
                    $("#sumTable1").fadeOut(400);
                    $("#sumTable2").fadeOut(400);
                }
                this.timer = setTimeout(function() {
                    $("#sumTable1").fadeIn(400);
                    $("#sumTable2").fadeIn(400);
                }, 150);
            },
        },
        created() {
            this.timer = null;
        },
        mounted() {

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
