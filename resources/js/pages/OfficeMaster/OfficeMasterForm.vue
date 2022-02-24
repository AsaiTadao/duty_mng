<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" v-if="!editMode">新規登録</h5>
            <h5 class="modal-title" v-else>編集</h5>
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
                </div>
            </div>
            <div class="form-group">
                <div class="form-row align-items-center">
                    <template v-for="restDeduction in restDeductions">
                        <div class="col-md-5" :key="restDeduction.id">
                            <input type="radio" name="type" :value="restDeduction.id" v-model="data.restDeductionId" @change="errors.restDeductionId = null">
                            <label class="ml-auto">{{ restDeduction.name }}</label>
                        </div>
                        <div class="col-md-1" :key="restDeduction.id + '_space'"></div>
                    </template>
                    <span v-if="errors.restDeductionId" class="error invalid-feedback d-block">
                        {{ errors.restDeductionId }}
                    </span>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-1">
                        <input type="radio" name="kind" :value="1" v-model="nurseOffice">
                        <label class="ml-auto">保育園</label>
                    </div>
                    <div class="col-md-1">
                        <input type="radio" name="kind" :value="0" v-model="nurseOffice">
                        <label class="ml-auto">その他</label>
                    </div>
                </div>
            </div>
            <template v-if="nurseOffice">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-4">
                        <label>以下の項目は保育園のみ登録</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2">
                        開所時間：
                    </div>
                    <div class="col-md-1">
                        <input type="number" class="form-control" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                        <span v-if="errors.startTime" class="error invalid-feedback">
                            {{ errors.startTime }}
                        </span>
                    </div>
                    :
                    <div class="col-md-1">
                        <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                        <span v-if="errors.startTime" class="error invalid-feedback">
                            {{ errors.startTime }}
                        </span>
                    </div>
                    ~
                    <div class="col-md-1">
                        <input type="number" class="form-control" min="0" max="24" :class="{'is-invalid' : errors.endTime}" @change="errors.endTime = null">
                        <span v-if="errors.endTime" class="error invalid-feedback">
                            {{ errors.endTime }}
                        </span>
                    </div>
                    :
                    <div class="col-md-1">
                        <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.endTime}" @change="errors.endTime = null">
                        <span v-if="errors.endTime" class="error invalid-feedback">
                            {{ errors.endTime }}
                        </span>
                    </div>
                </div>
                <div class="form-row mt-1">
                    <div class="col-md-2">
                        定員数：
                    </div>
                    <div class="col-md-1">
                        <div class="d-flex">
                        <input type="number" class="form-control" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                        名
                        <span v-if="errors.startTime" class="error invalid-feedback">
                            {{ errors.startTime }}
                        </span>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-1">
                    <div class="col-md-2">
                        適正職員数：<br>
                        (一人当たり)
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex mb-1 align-middle">
                            <div class="mr-1 align-self-center">0歳児</div>
                            <input type="number" class="form-control" style="width:50%" min="0" max="1000" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                            <div class="ml-1 align-self-center">名</div>
                        </div>
                        <div class="d-flex">
                            <div class="mr-1 align-self-center">3歳児</div>
                            <input type="number" class="form-control" style="width:50%" min="0" max="1000" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                            <div class="ml-1 align-self-center">名</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex mb-1">
                            <div class="mr-1 align-self-center">1歳児</div>
                            <input type="number" class="form-control" style="width:50%" min="0" max="1000" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                            <div class="ml-1 align-self-center">名</div>
                        </div>
                        <div class="d-flex mb-1">
                            <div class="mr-1 align-self-center">4歳児</div>
                            <input type="number" class="form-control" style="width:50%" min="0" max="1000" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                            <div class="ml-1 align-self-center">名</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex mb-1">
                            <div class="mr-1 align-self-center">2歳児</div>
                            <input type="number" class="form-control" style="width:50%" min="0" max="1000" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                            <div class="ml-1 align-self-center">名</div>
                        </div>
                        <div class="d-flex">
                            <div class="mr-1 align-self-center">5歳児</div>
                            <input type="number" class="form-control" style="width:50%" min="0" max="1000" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                            <div class="ml-1 align-self-center">名</div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-1">
                    <div class="col-md-2">
                        事業種別：
                    </div>
                    <div class="col-md-6">
                        <select class="form-control">
                            <option>全業主導型保育事業所</option>
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            </template>
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
            editMode: null,
            modalOpen: null,
        },
        computed: {
            ...mapState({
                restDeductions: state => state.constants.restDeductions,
            })
        },
        watch: {
            ['data.id'] : function (){
                this.errors = {
                    name: '',
                    number: '',
                    restDeductionId: ''
                };
            },
            'modalOpen' : function (){
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
                },
                nurseOffice: 0,
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
                        this.unsetActionLoading();
                        showSuccess(this.$t("Successfully saved"));
                        this.unsetActionLoading();
                        this.$emit('success');
                    })
                    .catch(e => {
                        apiErrorHandler(e);
                        this.unsetActionLoading();
                    });
            },
            validate() {
                let valid = true;
                if (!this.data.number) {
                    this.errors.number = this.$t('Please input number');                            // need trans
                    valid = false;
                }
                if (this.data.number && this.data.number.length > 20) {
                    this.errors.number = this.$t('Please enter 20 characters or less');                            // need trans
                    valid = false;
                }
                if (!this.data.name) {
                    this.errors.name = this.$t('Please input name');                                 // need trans
                    valid = false;
                }
                if (this.data.name && this.data.name.length > 50) {
                    this.errors.name = this.$t('Please enter 50 characters or less');                                 // need trans
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
