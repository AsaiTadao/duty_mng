<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">申請</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <i class="fas fa-square-full"></i>
                <label>申請者</label>
                <div>阿部 一子</div>
            </div>
            <div class="form-group">
                <i class="fas fa-square-full"></i>
                <label>申請日時</label>
                <div>8月2日 8:11</div>
            </div>
            <div class="form-group">
                <i class="fas fa-square-full"></i>
                <label>修正時間</label>
                <div>遅刻</div>
                <div class="form-row align-items-center">
                    <div class="col-md-1">
                        <div>8:05</div>
                    </div>
                    <div class="form-control-label">⇒</div>
                    <div class="col-md-1">
                        <div>8:00</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <i class="fas fa-square-full"></i>
                <label>申請理由</label>
                <div>雨天によるJR遅延のため</div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">承認</button>
            <button type="submit" class="btn btn-warning">却下</button>
        </div>
    </div>
</template>
<script>

import api, { apiErrorHandler } from '../../global/api';
import actionLoading from '../../mixin/actionLoading';
import { showSuccess } from '../../helpers/error';

    export default {
        mixins: [actionLoading],
        props: {
            formData: {
                name: '',
                number: '',
                employmentStatusId: null,
                enrolled: null,
                regionId: null,
                officeId: null,
                email: '',
                password: '',
                officeGroupId: null,
                workingHours: 8
            },
            regions: [],
        },
        watch: {
            ['formData.id'] : function (){
                this.errors = {
                    name: '',
                    number: '',
                    employmentStatusId: null,
                    enrolled: null,
                    regionId: null,
                    officeId: null,
                    email: '',
                    password: '',
                    officeGroupId: null,
                    workingHours: null
                };
                this.offices = [];
                this.setOffices();
            },
            ['formData.regionId']: function () {
                this.setOffices();
            }
        },
        data() {
            return {
                errors: {
                    name: '',
                    number: '',
                    employmentStatusId: null,
                    enrolled: null,
                    regionId: null,
                    officeId: null,
                    email: '',
                    password: '',
                    officeGroupId: null,
                },
                offices: [],
            }
        },
        methods: {
            saveUser() {
                if (this.actionLoading) return;
                if (!this.validate()) return;
                const requestData = {
                    'name': this.formData.name,
                    'number': this.formData.number,
                    'employment_status_id': this.formData.employmentStatusId,
                    'enrolled': this.formData.enrolled,
                    'office_id': this.formData.officeId,
                    'email': this.formData.email,
                    'password': this.formData.password,
                    'workingHours': this.formData.workingHours
                };
                this.setActionLoading();
                let request;
                if (this.formData.id) {
                    request = api.put('users/' + this.formData.id, null, requestData);
                } else {
                    request = api.post('users', null, requestData);
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
            validate() {
                let valid = true;
                if (!this.formData.name) {
                    this.errors.name = this.$t('Please input name');                                 // need trans
                    valid = false;
                }
                if (!this.formData.number) {
                    this.errors.number = this.$t('Please input number');                              //need trans
                    valid = false;
                }
                if (!this.formData.enrolled) {
                    this.errors.enrolled = this.$t('Please select enrolled');
                    valid = false;
                }
                return valid;
            },
            setOffices() {
                if(this.formData.regionId)  {
                    api.get('office-master', null, {'region_id': this.formData.regionId})
                    .then(response => {
                        this.offices = response;
                        this.setFirstOffice();
                    })
                    .catch(e => apiErrorHandler(e));
                }
            },
            setFirstOffice(){
                if(this.offices.length){
                    this.formData.officeId = this.offices[0].id;
                }
            }
        }
    }
</script>
