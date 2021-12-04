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
                    <div class="col-md-5">
                        <input type="text" name="office_number"
                            class="form-control"
                            placeholder="事業所No入力"
                            v-model="data.number"
                            :class="{'is-invalid' : errors.number}"
                        />
                        <span class="error invalid-feedback">
                            {{ errors.number }}
                        </span>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <input type="text" name="office_name"
                            class="form-control"
                            placeholder="事業所名入力"
                            v-model="data.name"
                            :class="{'is-invalid' : errors.name}"
                        />
                        <span v-if="errors.name" class="error invalid-feedback">
                            {{ errors.name }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row align-items-center">
                    <template v-for="restDeduction in restDeductions">
                        <div class="col-md-5" :key="restDeduction.id">
                            <input type="radio" name="type" :value="restDeduction.id" v-model="data.restDeductionId">
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
            })
        },
        watch: {
            data : function (){
                this.errors = {
                    name: '',
                    number: '',
                    restDeductionId: ''
                };
            },
        },
        data() {
            return {
                errors: {
                    name: '',
                    number: '',
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
                    this.errors.number = 'Please input number';                            // need trans
                    valid = false;
                }
                if (!this.data.name) {
                    this.errors.name = 'Please input name';                                 // need trans
                    valid = false;
                }
                if (!this.data.restDeductionId) {
                    this.errors.restDeductionId = 'Please select rest deduction type'       // need trans
                    valid = false;
                }
                return valid;
            }
        }
    }
</script>
