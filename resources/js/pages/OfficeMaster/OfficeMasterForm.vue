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
                            :class="{'is-invalid' : form.errors().has('number')}"
                        />
                        <span v-if="form.errors().has('number')" class="error invalid-feedback">
                            {{ form.errors().get('number') }}
                        </span>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <input type="text" name="office_name"
                            class="form-control"
                            placeholder="事業所名入力"
                            v-model="data.name"
                            :class="{'is-invalid' : form.errors().has('name')}"
                        />
                        <span v-if="form.errors().has('name')" class="error invalid-feedback">
                            {{ form.errors().get('name') }}
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
                    <span v-if="form.errors().has('restDeductionId')" class="error invalid-feedback d-block">
                        {{ form.errors().get('restDeductionId') }}
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
import form from 'vuejs-form';
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
            data : {
                deep: true,
                immediate: false,
                handler: 'onFormChange'
            }
        },
        data() {
            return {
                form: form({
                    id: null,
                    number: '',
                    name: '',
                    restDeductionId: undefined
                })
                .rules({
                    number: 'required',
                    name: 'required',
                    restDeductionId: 'required'
                })
                .messages({
                    'number.required': 'Please input number',       // need trans
                    'name.required': 'Please input name',    // need trans
                    'restDeductionId.required': 'Please select rest deduction type'    // need trans
                })
            }
        },

        methods: {
            saveOffice() {
                this.form.fill(this.data);
                if (this.actionLoading) return;
                if (this.form.validate().errors().any()) return;
                this.setActionLoading();
                let request;
                if (this.data.id) {
                    request = api.put('office-master/' + this.data.id, null, this.form.all());
                } else {
                    request = api.post('office-master', null, this.form.all());
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
            onFormChange() {
                this.form.errors().forget();
            }
        }
    }
</script>
