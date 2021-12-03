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
                <div class="form-row">
                    <div class="col-md-3">
                        <input type="text" name="region_name"
                        class="form-control"
                        placeholder="エリア名入力"
                        v-model="data.name"
                        :class="{'is-invalid' : form.errors().has('number')}">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <template v-for="office in offices">
                                <div class="col-md-4" :key="office.id">
                                    <input type="checkbox" name="office_name" :value="office.id" v-model="data.offices">
                                    <label class="ml-auto">{{office.name}}</label>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary" @click="saveRegion">登録</button>
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
            offices: {}
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
                    name: '',
                    offices: []
                })
                .rules({
                    name: 'required',
                })
                .messages({
                    'name.required': 'Please input name',    // need trans
                })
            }
        },

        methods: {
            saveRegion() {
                this.form.fill(this.data);
                if (this.actionLoading) return;
                if (this.form.validate().errors().any()) return;
                this.setActionLoading();
                let request;
                if (this.data.id) {
                    request = api.post('region/' + this.data.id, null, this.form.all());
                } else {
                    request = api.post('region', null, this.form.all());
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
