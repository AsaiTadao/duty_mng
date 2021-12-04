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
                                    <input type="checkbox" name="office_name" :value="office.id" v-model="data.offices"
                                    :disabled="selectedOffices.find(e => e.id === office.id) && !data.offices.includes(office.id)"
                                    @click="onOfficeChange(office.id)">
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
            offices: {},
            selectedOffices: {},
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
                console.log("onSaveRegion", this.data);
                this.form.fill(this.data);
                console.log("onSaveRegion", this.form.all());
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
            },
            onOfficeChange(officeId) {
                const index = this.selectedOffices.findIndex(item => item.id == officeId);
                if(index != -1){
                    this.selectedOffices.splice(index, 1);
                }
            }
        }
    }
</script>
