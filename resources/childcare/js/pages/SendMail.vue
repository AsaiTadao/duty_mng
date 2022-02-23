<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">{{ office.name }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="inputEmail3" class="col-form-label col-md-1 text-justify-content">宛先</label>
                                <div class="col-md-2 d-flex text-justify-content">
                                    <div class="align-self-center">
                                        {{ office.name }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" v-model="childrenClassId">
                                        <option :value="0">全保護者</option>
                                        <option v-for="claz in childrenClasses" :key="claz.id" :value="claz.id">{{ claz.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" v-model="type" :class="{'is-invalid': error.type}">
                                        <option :value="0">通常メール</option>
                                        <option :value="1">緊急メール</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="inputEmail3" class="col-form-label col-md-1 text-justify-content">件名</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder=""
                                        v-model="subject"
                                        :class="{'is-invalid': error.subject}"
                                        @input="() => {error.subject = null;}"
                                    />
                                    <div v-if="error.subject" class="validation-error">
                                        {{ error.subject }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="20"
                                        v-model="content"
                                        :class="{'is-invalid': error.content}"
                                        @input="() => {error.content = null;}"
                                    >
                                    </textarea>
                                    <div v-if="error.content" class="validation-error">
                                        {{ error.content }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary float-right" @click="sendMail">送信</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { mapState } from 'vuex';
import api, { apiErrorHandler } from '../global/api';
import { showSuccess } from '../helpers/error';
import actionLoading from '../mixin/actionLoading';

export default {
    mixins: [actionLoading],
    data() {
        return {
            childrenClassId: 0,
            content: '',
            subject: '',
            type: 0,
            error: {
                subject: null,
                type: null,
                content: null,
            }
        }
    },
    computed: {
        ...mapState({
            childrenClasses: state => state.constants.childrenClasses,
            office: state => state.session.info.office
        }),
    },
    mounted() {
        this.childrenClassId = this.$route.query.childrenClassId;
        this.type = this.$route.query.type;
        this.fetchData();
    },
    methods: {
        sendMail() {
            if (!this.validate()) return;
            if (!confirm(this.$t("Are you sure you want to send mail?"))) return;
            this.setActionLoading();
            api.post('mail', null, {
                subject: this.subject,
                content: this.content,
                childrenClassId: !this.childrenClassId || this.childrenClassId === '0' ? null :  this.childrenClassId,
                type: this.type
            })
            .then(() => {
                showSuccess(this.$t('Successfully saved'));
            })
            .catch(apiErrorHandler)
            .finally(() => this.unsetActionLoading())
        },
        validate() {
            let valid = true;
            this.error = {};
            if (!this.subject) {
                this.error.subject = this.$t('Please input subject');
                valid = false;
            }
            if (!this.content) {
                this.error.content = this.$t('Please input content');
                valid = false;
            }
            return valid;
        },
        fetchData() {
            this.setActionLoading();
            api.get('mail-template', null, {type: this.type})
            .then((response) => {
                this.content = response.content;
            })
            .catch(apiErrorHandler)
            .finally(() => {
                this.unsetActionLoading();
            })
        },
    }
};
</script>
