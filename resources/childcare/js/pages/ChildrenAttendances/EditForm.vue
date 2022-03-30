<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">編集</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <div class="col-md-3 col-3">
                    日付
                </div>
                <div class="col-md-6 col-6">
                    {{dateFormat(date)}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-3">
                    事業所
                </div>
                <div class="col-md-5 col-5">
                    {{ currentOfficeName }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-3">
                    氏名
                </div>
                <div class="col-md-5 col-5">
                    {{ editData.name }}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-3">登園時間</div>
                <div class="col-md-3 col-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="23" class="form-control mr-2" :class="{'is-invalid' : errors.commutingTimeHour}" v-model="formData.commutingTimeHour" @change="() => {errors.commutingTimeHour=null}">

                    </div>
                    <span v-if="errors.commutingTimeHour" class="error invalid-feedback">
                        {{ errors.commutingTimeHour }}
                    </span>
                </div>
                <div class="form-control-label">時</div>
                <div class="col-md-3 col-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="59" class="form-control mr-2" :class="{'is-invalid' : errors.commutingTimeMin}" v-model="formData.commutingTimeMin" @change="() => {errors.commutingTimeMin=null}">
                    </div>
                    <span v-if="errors.commutingTimeMin" class="error invalid-feedback">
                        {{ errors.commutingTimeMin }}
                    </span>
                </div>
                <div class="form-control-label">分</div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-3">降園時間</div>
                <div class="col-md-3 col-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="23" class="form-control mr-2" :class="{'is-invalid' : errors.leaveTimeHour}" v-model="formData.leaveTimeHour" @change="() => {errors.leaveTimeHour=null}">
                    </div>
                    <span v-if="errors.leaveTimeHour" class="error invalid-feedback">
                        {{ errors.leaveTimeHour }}
                    </span>
                </div>
                <div class="form-control-label">時</div>
                <div class="col-md-3 col-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="59" class="form-control mr-2" :class="{'is-invalid' : errors.leaveTimeMin}" v-model="formData.leaveTimeMin" @change="() => {errors.leaveTimeMin=null}">
                    </div>
                    <span v-if="errors.leaveTimeMin" class="error invalid-feedback">
                        {{ errors.leaveTimeMin }}
                    </span>
                </div>
                <div class="form-control-label">分</div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-3">欠席</div>
                <div class="col-md-6 col-6">
                    <select class="form-control" v-model="formData.reasonForAbsenceId" :class="{'is-invalid' : errors.reasonForAbsenceId}" @change="errors.reasonForAbsenceId = null;">
                        <option></option>
                        <option v-for="reason in reasonForAbsences" :key="reason.id" :value="reason.id">{{reason.name}}</option>
                    </select>
                    <span v-if="errors.reasonForAbsenceId" class="error invalid-feedback">
                        {{ errors.reasonForAbsenceId }}
                    </span>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-md-3">遅刻</div>
                    <div class="col-md-4">
                        <div class="d-flex is-invalid">
                            <input type="number" min="0" max="24" class="form-control mr-2">
                        </div>
                    </div>
                    <div class="form-control-label">分</div>
            </div> -->
            <div class="form-group row">
                <div class="col-md-3 col-3">延長</div>
                <div class="col-md-3 col-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="23" class="form-control mr-2" :class="{'is-invalid' : errors.extensionTimeHour}" v-model="formData.extensionTimeHour" @change="() => {errors.extensionTimeHour=null}">
                    </div>
                    <span v-if="errors.extensionTimeHour" class="error invalid-feedback">
                        {{ errors.extensionTimeHour }}
                    </span>
                </div>
                <div class="form-control-label">時</div>
                <div class="col-md-3 col-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="59" class="form-control mr-2" :class="{'is-invalid' : errors.extensionTimeMin}" v-model="formData.extensionTimeMin" @change="() => {errors.extensionTimeMin=null}">
                    </div>
                    <span v-if="errors.extensionTimeMin" class="error invalid-feedback">
                        {{ errors.extensionTimeMin }}
                    </span>
                </div>
                <div class="form-control-label">分</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary" @click="saveAttendance">登録</button>
        </div>
    </div>
</template>
<script>
import moment from 'moment-timezone';
import { mapState } from 'vuex';
import api, { apiErrorHandler } from '../../global/api';
import actionLoading from '../../mixin/actionLoading';
import { showSuccess } from '../../helpers/error';

    export default {
        mixins: [actionLoading],
        props: {
            editData: {},
            date: null,
            childId: null
        },
        computed: {
            ...mapState({
                reasonForAbsences: state => state.constants.reasonForAbsences,
                currentOfficeName: state =>  {
                    if (state.session.info.office) return state.session.info.office.name;
                    return '';
                }
            })
        },
        watch: {
            ['editData']: function() {
                this.errors = {
                    id: null,
                    commutingTimeHour: '',
                    commutingTimeMin: '',
                    leaveTimeHour: '',
                    leaveTimeMin: '',
                    extensionTimeHour: '',
                    extensionTimeMin: '',
                    reasonForAbsenceId: null
                }
                this.convertToFormData();
                this.initFormError();
            }
        },
        data() {
            return {
                formData: {
                    id: null,
                    commutingTimeHour: null,
                    commutingTimeMin: null,
                    leaveTimeHour: null,
                    leaveTimeMin: null,
                    extensionTimeHour: null,
                    extensionTimeMin: null,
                    reasonForAbsenceId: null
                },
                errors: {
                    id: null,
                    commutingTimeHour: '',
                    commutingTimeMin: '',
                    leaveTimeHour: '',
                    leaveTimeMin: '',
                    extensionTimeHour: '',
                    extensionTimeMin: '',
                    reasonForAbsenceId: null
                },
            }
        },
        methods: {
            saveAttendance() {
                if (this.actionLoading) return;
                if(!this.validate()) return;

                let requestData = {
                    'date': moment(this.date).format('YYYY-MM-DD'),
                    // 'commuting_time': ("0" + this.formData.commutingTimeHour).slice(-2) + ":" + ("0" + this.formData.commutingTimeMin).slice(-2),
                    // 'leave_time': ("0" + this.formData.leaveTimeHour).slice(-2) + ":" + ("0" + this.formData.leaveTimeMin).slice(-2),
                    'reason_for_absence_id': this.formData.reasonForAbsenceId,
                    'behind_time': this.formData.behindTime,
                }
                if(this.formData.commutingTimeHour && this.formData.commutingTimeMin) {
                    requestData['commuting_time'] = ("0" + this.formData.commutingTimeHour).slice(-2) + ":" + ("0" + this.formData.commutingTimeMin).slice(-2);
                } else {
                    requestData['commuting_time'] = null;
                }
                if(this.formData.leaveTimeHour && this.formData.leaveTimeMin) {
                    requestData['leave_time'] = ("0" + this.formData.leaveTimeHour).slice(-2) + ":" + ("0" + this.formData.leaveTimeMin).slice(-2);
                } else {
                    requestData['leave_time'] = null;
                }
                if(this.formData.extensionTimeHour || this.formData.extensionTimeMin) {
                    if(!this.formData.extensionTimeHour) {
                        requestData['extension'] = "00" + ":" + ("0" + this.formData.extensionTimeMin).slice(-2);
                    } else if(!this.formData.extensionTimeMin) {
                        requestData['extension'] = ("0" + this.formData.extensionTimeHour).slice(-2) + ":" + "00";
                    } else {
                        requestData['extension'] = ("0" + this.formData.extensionTimeHour).slice(-2) + ":" + ("0" + this.formData.extensionTimeMin).slice(-2);
                    }
                } else {
                    requestData['extension'] = null;
                }
                this.setActionLoading();
                api.post('attendance/' + this.formData.id, null, requestData)
                .then(() => {
                    this.unsetActionLoading();
                    showSuccess(this.$t('Successfully saved'));
                    this.$emit('success');
                })
                .catch(e => {
                    apiErrorHandler(e);
                    this.unsetActionLoading();
                });
            },
            validate() {
                let valid = true;
                if (!this.formData.reasonForAbsenceId && !this.formData.commutingTimeHour) {
                    this.errors.commutingTimeHour = this.$t('Please input number');                                 // need trans
                    valid = false;
                }
                if (!this.formData.reasonForAbsenceId && !this.formData.commutingTimeMin) {
                    this.errors.commutingTimeMin = this.$t('Please input number');                              //need trans
                    valid = false;
                }
                // if (!this.formData.reasonForAbsenceId && !this.formData.leaveTimeHour) {
                //     this.errors.leaveTimeHour = this.$t('Please input number');
                //     valid = false;
                // }
                // if (!this.formData.reasonForAbsenceId && !this.formData.leaveTimeMin) {
                //     this.errors.leaveTimeMin = this.$t('Please input number');
                //     valid = false;
                // }
                if (this.formData.leaveTimeHour && this.formData.leaveTimeMin && ('0' + this.formData.leaveTimeHour).slice(-2) + ":" + ('0' + this.formData.leaveTimeMin).slice(-2) < ('0' + this.formData.commutingTimeHour).slice(-2) + ":" + ('0' + this.formData.commutingTimeMin).slice(-2)) {
                    this.errors.leaveTimeHour = this.$t('end time must be later than start time');
                    valid = false;
                }
                if (this.formData.commutingTimeHour && this.formData.reasonForAbsenceId || this.formData.commutingTimeMin && this.formData.reasonForAbsenceId) {
                    this.errors.reasonForAbsenceId = this.$t('Please do not select absenceId');
                    valid = false;
                }
                if (this.formData.extensionTimeHour && this.formData.extensionTimeHour < 0) {
                    this.errors.extensionTimeHour = this.$t('Please input positive number');
                    valid = false;
                }
                if (this.formData.extensionTimeMin && this.formData.extensionTimeMin < 0) {
                    this.errors.extensionTimeMin = this.$t('Please input positive number');
                    valid = false;
                }
                // if (!this.formData.extensionTimeHour && this.formData.extensionTimeMin) {
                //     this.errors.extensionTimeHour = this.$t('Please input valid number');
                //     valid = false;
                // }
                // if (this.formData.extensionTimeHour && !this.formData.extensionTimeMin) {
                //     this.errors.extensionTimeMin = this.$t('Please input valid number');
                //     valid = false;
                // }
                return valid;
            },
            convertToFormData() {
                this.initializeFormData();
                if (this.editData) {
                    this.formData.id = this.editData.id;
                    this.formData.commutingTimeHour = this.editData.commutingTime ? moment(this.editData.commutingTime).format('HH') : '';
                    this.formData.commutingTimeMin = this.editData.commutingTime ? moment(this.editData.commutingTime).format('mm') : '';
                    this.formData.leaveTimeHour = this.editData.leaveTime ? moment(this.editData.leaveTime).format('HH') : '';
                    this.formData.leaveTimeMin = this.editData.leaveTime ? moment(this.editData.leaveTime).format('mm') : '';
                    this.formData.reasonForAbsenceId = this.editData.reasonForAbsenceId ? this.editData.reasonForAbsenceId : '';
                    this.formData.extensionTimeHour = this.editData.extension ? moment(this.editData.extension, 'hh:mm:ss').format('HH') : '';
                    this.formData.extensionTimeMin = this.editData.extension ? moment(this.editData.extension, 'hh:mm:ss').format('mm') : '';
                }
            },
            initializeFormData() {
                this.formData = {
                    id: null,
                    commutingTimeHour: '',
                    commutingTimeMin: '',
                    leaveTimeHour: '',
                    leaveTimeMin: '',
                    reasonForAbsenceId: null,
                    extensionTimeHour: null,
                    extensionTimeMin: null,
                };
            },
            initFormError() {
                this.errors = {
                    id: null,
                    commutingTimeHour: '',
                    commutingTimeMin: '',
                    leaveTimeHour: '',
                    leaveTimeMin: '',
                    extensionTimeHour: '',
                    extensionTimeMin: '',
                    reasonForAbsenceId: ''
                }
            },
            dateFormat(date) {
                if(date)
                    return moment(date).format('YYYY年 M月 D日 (ddd)');
            }
        }
    }
</script>
