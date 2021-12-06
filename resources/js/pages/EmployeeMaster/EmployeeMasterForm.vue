<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">新規登録</h5>
            <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="form-row align-items-center">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="社員No" v-model="formData.number" :class="{'is-invalid' : errors.number}">
                        <span v-if="errors.number" class="error invalid-feedback">
                            {{ errors.number }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="氏名" v-model="formData.name" :class="{'is-invalid' : errors.name}">
                        <span v-if="errors.name" class="error invalid-feedback">
                            {{ errors.name }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" :value="1" v-model="formData.employmentStatusId" :class="{'is-invalid' : errors.employmentStatusId}">
                        <label class="ml-auto">正社員</label>
                        <input type="radio" :value="3" v-model="formData.employmentStatusId">
                        <label class="ml-auto">パート</label>
                        <span v-if="errors.employmentStatusId" class="error invalid-feedback">
                            {{ errors.employmentStatusId }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" :value="1" v-model="formData.enrolled" :class="{'is-invalid' : errors.enrolled}">
                        <label class="ml-auto">在籍中</label>
                        <input type="radio" :value="0" v-model="formData.enrolled">
                        <label class="ml-auto">退職</label>
                        <span v-if="errors.enrolled" class="error invalid-feedback">
                            {{ errors.enrolled }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row align-items-center">
                    <div class="col-md-3">
                        <select class="form-control" v-model="formData.regionId"  @change="setTempRegion(formData.regionId)" :class="{'is-invalid' : errors.regionId}">
                            <option v-for="region in regions" :key="region.id" :value="region.id">{{region.name}}</option>
                        </select>
                        <span v-if="errors.regionId" class="error invalid-feedback">
                            {{ errors.regionId }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" v-model="formData.officeId" :class="{'is-invalid' : errors.officeId}">
                            <option v-for="office in offices" :key="office.id" :value="office.id">{{office.name}}</option>
                        </select>
                        <span v-if="errors.officeId" class="error invalid-feedback">
                            {{ errors.officeId }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="No" v-model="formData.officeGroupId" :class="{'is-invalid' : errors.officeGroupId}">
                        <span v-if="errors.officeGroupId" class="error invalid-feedback">
                            {{ errors.officeGroupId }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control">
                            <option>8時間</option>
                            <option>7時間</option>
                            <option>6時間</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="メールアドレス" v-model="formData.email" :class="{'is-invalid' : errors.email}">
                        <span v-if="errors.email" class="error invalid-feedback">
                            {{ errors.email }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <input type="password" class="form-control" placeholder="パスワード" v-model="formData.password" :class="{'is-invalid' : errors.password}">
                        <span v-if="errors.password" class="error invalid-feedback">
                            {{ errors.password }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary" @click="saveUser()">登録</button>
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
            formData: {},
            regions: [],
        },
        watch: {
            formData : function (){
                this.errors = {
                    name: '',
                };
            },
            ['formData.regionId']: function () {
                this.setOffices();
            }
        },
        data() {
            return {
                errors: {
                    name: '',
                },
                offices: [],
                tempRegionId:  1,
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
                    'password': this.formData.password
                };
                this.setActionLoading();
                let request;
                if (this.formData.id) {
                    request = api.put('users/' + this.formData.id, null, requestData);
                } else {
                    request = api.post('users', null, requestData);
                }
                request.then(() => {
                        showSuccess(this.$t("Successfully saved"));
                        this.$emit('success');
                    })
                    .catch(e => apiErrorHandler(e))
                    .finally(() => {
                        this.unsetActionLoading();
                    })
            },
            validate() {
                let valid = true;
                if (!this.formData.name) {
                    this.errors.name = 'Please input name';                                 // need trans
                    valid = false;
                }
                if (!this.formData.number) {
                    this.errors.number = 'Please input number';                              //need trans
                    valid = false;
                }
                if (!this.formData.enrolled) {
                    this.errors.enrolled = 'Please select enrolled';
                    valid = false;
                }
                if (!this.formData.employmentStatusId) {
                    this.errors.employmentStatusId = 'Please select employmentStatusId';
                    valid = false;
                }
                if (!this.formData.regionId) {
                    this.errors.regionId = 'Please select region';
                    valid = false;
                }
                if (!this.formData.officeId) {
                    this.errors.officeId = 'Please select office';
                    valid = false;
                }
                if (!this.formData.officeGroupId) {
                    this.errors.officeGroupId = 'Please input officeGroupId';
                    valid = false;
                }
                if (!this.formData.email) {
                    this.errors.email = 'Please input email';
                    valid = false;
                }
                if (!this.formData.password) {
                    this.errors.enrolled = 'Please input password';
                    valid = false;
                }
                console.log({valid});
                return valid;
            },
            setOffices() {
                if(this.formData.regionId)  {
                    api.get('office-master', null, {'region_id': this.formData.regionId})
                    .then(response => {
                        this.offices = response;
                    })
                    .catch(e => apiErrorHandler(e));
                } else {
                    api.get('office-master', null, {'region_id': this.tempRegionId})
                    .then(response => {
                        this.offices = response;
                    })
                    .catch(e => apiErrorHandler(e));
                }
            },
            setTempRegion(regionId) {
                this.tempRegionId = regionId;
            }
        }
    }
</script>
