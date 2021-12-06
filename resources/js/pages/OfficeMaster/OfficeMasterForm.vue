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
                        <input type="text" name="office_number"
                            class="form-control"
                            placeholder="事業所No入力"
                            v-model="data.number"
                            :class="{'is-invalid' : errors.number}"
                            @keyup="errors.number = null"
                        />
                        <span class="error invalid-feedback">
                            {{ errors.number }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="office_name"
                            class="form-control"
                            placeholder="事業所名入力"
                            v-model="data.name"
                            :class="{'is-invalid' : errors.name}"
                            @keyup="errors.name = null"
                        />
                        <span v-if="errors.name" class="error invalid-feedback">
                            {{ errors.name }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" v-model="data.officeGroupId" :class="{'is-invalid' : errors.officeGroup}" @change="errors.officeGroup = null">
                            <option v-for="officeGroup in officeGroups" :key="officeGroup.id" :value="officeGroup.id">{{officeGroup.name}}</option>
                        </select>
                        <span v-if="errors.officeGroup" class="error invalid-feedback">
                            {{ errors.officeGroup }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row align-items-center">
                    <template v-for="restDeduction in restDeductions">
                        <div class="col-md-5" :key="restDeduction.id">
                            <input type="radio" name="type" :value="restDeduction.id" v-model="data.restDeductionId" @change="errors.restDeduction = null">
                            <label class="ml-auto">{{ restDeduction.name }}</label>
                        </div>
                        <div class="col-md-1" :key="restDeduction.id + '_space'"></div>
                    </template>
                    <span v-if="errors.restDeductionId" class="error invalid-feedback d-block">
                        {{ errors.restDeductionId }}
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="button" class="btn btn-primary" @click="saveOffice">登録</button>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import api, { apiErrorHandler } from '../../global/api';
import actionLoading from '../../mixin/actionLoading';
import { showSuccess } from '../../helpers/error';

    export default {
        mixins: [actionLoading],
        props: {
            data: {},
        },
        computed: {
            ...mapState({
                restDeductions: state => state.constants.restDeductions,
                officeGroups:   state => state.constants.officeGroups,
            })
        },
        watch: {
            ['data.id'] : function (){
                this.errors = {
                    name: '',
                    number: '',
                    officeGroup: '',
                    restDeductionId: ''
                };
            },
        },
        data() {
            return {
                errors: {
                    name: '',
                    number: '',
                    officeGroup: '',
                    restDeductionId: ''
                }
            }
        },
        methods: {
            saveOffice() {
                if (this.actionLoading) return;
                if (!this.validate()) return;
                this.setActionLoading();
                let request;
                if (this.data.id) {
                    request = api.put('office-master/' + this.data.id, null, this.data);
                } else {
                    request = api.post('office-master', null, this.data);
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
                if (!this.data.number) {
                    this.errors.number = this.$t('Please input number');                            // need trans
                    valid = false;
                }
                if (!this.data.name) {
                    this.errors.name = this.$t('Please input name');                                 // need trans
                    valid = false;
                }
                if (!this.data.officeGroupId) {
                    this.errors.officeGroup = this.$t('Please select officeGroup');                  // need trans
                    valid = false;
                }
                if (!this.data.restDeductionId) {
                    this.errors.restDeductionId = this.$t('Please select rest deduction type');       // need trans
                    valid = false;
                }
                return valid;
            }
        }
    }
</script>
