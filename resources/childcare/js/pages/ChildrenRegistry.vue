<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title mb-0">保育システム</h3>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-primary float-right">
                                    新規登録
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-children table-hover mb-0"
                            >
                                <thead class="text-center">
                                    <tr class="dark-brown text-white">
                                        <th>
                                            園児ID
                                        </th>
                                        <th>
                                            園児氏名
                                        </th>
                                        <th>
                                            性別
                                        </th>
                                        <th>
                                            生年月日
                                        </th>
                                        <th>
                                            年齢
                                        </th>
                                        <th>
                                            クラス
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <input class="form-control" v-model="formData.childNumber" :class="{'is-invalid' : errors.childNumber}" @keyup="errors.childNumber = null"/>
                                            <span v-if="errors.childNumber" class="error invalid-feedback">
                                                {{ errors.childNumber }}
                                            </span>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="formData.childName" :class="{'is-invalid' : errors.childName}" @keyup="errors.childName = null"/>
                                            <span v-if="errors.childName" class="error invalid-feedback">
                                                {{ errors.childName }}
                                            </span>
                                        </td>
                                        <td>
                                            <select class="form-control" v-model="formData.gender" :class="{'is-invalid' : errors.gender}">
                                                <option value="1">男</option>
                                                <option value="2">女</option>
                                            </select>
                                            <span v-if="errors.gender" class="error invalid-feedback">
                                                {{ errors.gender }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.birthYear" :class="{'is-invalid' : errors.birthYear}" @keyup="errors.birthYear = null">
                                                    <span v-if="errors.birthYear" class="error invalid-feedback">
                                                        {{ errors.birthYear }}
                                                    </span>
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" v-model="formData.birthMonth" :class="{'is-invalid' : errors.birthMonth}" @keyup="errors.birthMonth = null">
                                                    <span v-if="errors.birthMonth" class="error invalid-feedback">
                                                        {{ errors.birthMonth }}
                                                    </span>
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.birthDay" :class="{'is-invalid' : errors.birthDay}" @keyup="errors.birthDay = null">
                                                    <span v-if="errors.birthDay" class="error invalid-feedback">
                                                        {{ errors.birthDay }}
                                                    </span>
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            0歳7ヶ月
                                        </td>
                                        <td>
                                            <select class="form-control" v-model="formData.classId" :class="{'is-invalid' : errors.gender}">
                                                <option v-for="childrenClass in childrenClasses" :key="childrenClass.id" :value="childrenClass.id">{{childrenClass.name}}</option>
                                            </select>
                                            <span v-if="errors.classId" class="error invalid-feedback">
                                                {{ errors.classId }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table
                                class="table table-bordered table-children table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-brown text-white">
                                        <th>
                                            入園日
                                        </th>
                                        <th>
                                            退園日
                                        </th>
                                        <th>
                                            メールアドレス
                                        </th>
                                        <th>
                                            パスワード
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.admissionDateYear" :class="{'is-invalid' : errors.admissionDateYear}" @keyup="errors.admissionDateYear = null">
                                                    <span v-if="errors.admissionDateYear" class="error invalid-feedback">
                                                        {{ errors.admissionDateYear }}
                                                    </span>
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" v-model="formData.admissionDateMonth" :class="{'is-invalid' : errors.admissionDateMonth}" @keyup="errors.admissionDateMonth = null">
                                                    <span v-if="errors.admissionDateMonth" class="error invalid-feedback">
                                                        {{ errors.admissionDateMonth }}
                                                    </span>
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.admissionDateDay" :class="{'is-invalid' : errors.admissionDateDay}" @keyup="errors.admissionDateDay = null">
                                                    <span v-if="errors.admissionDateDay" class="error invalid-feedback">
                                                        {{ errors.admissionDateDay }}
                                                    </span>
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.exitDateYear" :class="{'is-invalid' : errors.exitDateYear}" @keyup="errors.exitDateYear = null">
                                                    <span v-if="errors.exitDateYear" class="error invalid-feedback">
                                                        {{ errors.exitDateYear }}
                                                    </span>
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" v-model="formData.exitDateMonth" :class="{'is-invalid' : errors.exitDateMonth}" @keyup="errors.exitDateMonth = null">
                                                    <span v-if="errors.exitDateMonth" class="error invalid-feedback">
                                                        {{ errors.exitDateMonth }}
                                                    </span>
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" v-model="formData.exitDateDay" :class="{'is-invalid' : errors.exitDateDay}" @keyup="errors.exitDateDay = null">
                                                    <span v-if="errors.exitDateDay" class="error invalid-feedback">
                                                        {{ errors.exitDateDay }}
                                                    </span>
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="formData.email" :class="{'is-invalid' : errors.email}" @keyup="errors.email = null"/>
                                            <span v-if="errors.email" class="error invalid-feedback">
                                                {{ errors.email }}
                                            </span>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="formData.password" :class="{'is-invalid' : errors.password}" @keyup="errors.password = null"/>
                                            <span v-if="errors.password" class="error invalid-feedback">
                                                {{ errors.password }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-registry table-hover mb-0"
                            >
                                <thead class="text-center">
                                    <tr class="dark-yellow text-white">
                                        <th>
                                            区分
                                        </th>
                                        <th>
                                            従業員枠企業所名
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <div class="d-flex align-middle d-flex">
                                                <div v-for="childType in childTypes" :key = "childType.key" class="d-flex align-items-center mr-3">
                                                    <input type="radio" class="align-middle" :value="childType.key" v-model="formData.type">
                                                    <label class="ml-1 mr-4">{{childType.value}}</label>
                                                    <span v-if="errors.type" class="error invalid-feedback">
                                                        {{ errors.type }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="formData.companyName" :class="{'is-invalid' : errors.companyName}" @keyup="errors.companyName = null"/>
                                            <span v-if="errors.companyName" class="error invalid-feedback">
                                                {{ errors.companyName }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table
                                class="table table-bordered table-registry table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-yellow text-white">
                                        <th>
                                            無償化
                                        </th>
                                        <th>
                                            支給認定証
                                        </th>
                                        <th>
                                            支給認定証有効期限
                                        </th>
                                        <th>
                                            非課税世帯
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" v-model="formData.freeOfCharge">
                                                <div class="ml-1 mr-4">対象</div>
                                                <input type="radio" class="align-middle" :value="0" v-model="formData.freeOfCharge">
                                                <div class="ml-1 mr-4">対象外</div>
                                                <span v-if="errors.freeOfCharge" class="error invalid-feedback">
                                                    {{ errors.freeOfCharge }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" v-model="formData.certificateOfPayment" :class="{'is-invalid' : errors.certificateOfPayment}" @change="errors.certificateOfPayment = null">
                                                <div class="ml-1 mr-4">有り</div>
                                                <input type="radio" class="align-middle" :value="0" v-model="formData.certificateOfPayment">
                                                <div class="ml-1 mr-4">無し</div>
                                            </div>
                                            <span v-if="errors.certificateOfPayment" class="error invalid-feedback">
                                                {{ errors.certificateOfPayment }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.certificateExpirationDateYear" :class="{'is-invalid' : errors.certificateExpirationDateYear}" @keyup="errors.certificateExpirationDateYear = null">
                                                    <span v-if="errors.certificateExpirationDateYear" class="error invalid-feedback">
                                                        {{ errors.certificateExpirationDateYear }}
                                                    </span>
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" v-model="formData.certificateExpirationDateMonth" :class="{'is-invalid' : errors.certificateExpirationDateMonth}" @keyup="errors.certificateExpirationDateMonth = null">
                                                    <span v-if="errors.certificateExpirationDateMonth" class="error invalid-feedback">
                                                        {{ errors.certificateExpirationDateMonth }}
                                                    </span>
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" v-model="formData.certificateExpirationDateDay" :class="{'is-invalid' : errors.certificateExpirationDateDay}" @keyup="errors.certificateExpirationDateDay = null">
                                                    <span v-if="errors.certificateExpirationDateDay" class="error invalid-feedback">
                                                        {{ errors.certificateExpirationDateDay }}
                                                    </span>
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" v-model="formData.taxExemptHousehold">
                                                <div class="ml-1 mr-4">対象</div>
                                                <input type="radio" class="align-middle" :value="0" v-model="formData.taxExemptHousehold">
                                                <div class="ml-1 mr-4">対象外</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-0">
                            <table
                                class="table table-bordered table-hover mb-0"
                            >
                                <tbody class="text-center">
                                    <tr>
                                        <td class="light-blue align-middle">
                                            備考欄
                                        </td>
                                        <td class="p-0 bg-white">
                                            <textarea class="textarea-fit" v-model="formData.remarks">

                                            </textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right" @click="saveChild">登録</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import api, { apiErrorHandler } from '../global/api';
import actionLoading from '../mixin/actionLoading';
import { mapState } from 'vuex';
import { showSuccess } from '../../../js/helpers/error';

export default {
    mixins: [actionLoading],
    data() {
        return {
            formData: {
                childNumber: '',
                childName: '',
                gender: null,
                birthYear: null,
                birthMonth: null,
                birthDay: null,
                classId: null,
                admissionDateYear: null,
                admissionDateMonth: null,
                admissionDateDay: null,
                exitDateYear: null,
                exitDateMonth: null,
                exitDateDay: null,
                email: null,
                password: null,
                type: null,
                companyName: '',
                freeOfCharge: null,
                certificateOfPayment: null,
                certificateExpirationDateYear: null,
                certificateExpirationDateMonth: null,
                certificateExpirationDateDay: null,
                taxExemptHousehold: null,
                remarks: null
            },
            errors: {
                childNumber: '',
                childName: '',
                gender: null,
                birthYear: null,
                birthMonth: null,
                birthDay: null,
                classId: null,
                admissionDateYear: null,
                admissionDateMonth: null,
                admissionDateDay: null,
                exitDateYear: null,
                exitDateMonth: null,
                exitDateDay: null,
                email: null,
                password: null,
                type: null,
                companyName: '',
                freeOfCharge: null,
                certificateOfPayment: null,
                certificateExpirationDateYear: null,
                certificateExpirationDateMonth: null,
                certificateExpirationDateDay: null,
                taxExemptHousehold: null,
                remarks: null
            },
            childId: null,
            childInfor: {},
        }
    },
    computed: {
        ...mapState({
            childrenClasses: state => state.constants.childrenClasses,
            childTypes: state => state.constants.childTypes
        }),
    },
    methods: {
        getChildInfor() {
            if(this.actionLoading) return;
            this.setActionLoading();
            api.get('child/' + this.childId, null)
                .then(response => {
                    this.childInfor = response;
                    this.convertDataToFormData();
                    this.unsetActionLoading();
                })
                .catch(e => {
                    apiErrorHandler(e);
                    this.unsetActionLoading();
                });
        },
        registerChild() {
            this.$router.push({name: 'children-register'});
        },
        saveChild() {
            if (this.actionLoading) return;
            if (!this.validate()) return;
            const requestData = {
                'number': this.formData.childNumber,
                'name': this.formData.childName,
                'gender': this.formData.gender,
                'birthday': moment(this.formData.birthYear + '-' + this.formData.birthMonth + '-' + this.formData.birthDay).format("YYYY-MM-DD"),
                'class_id': this.formData.classId,
                'admission_date': moment(this.formData.admissionDateYear + '-' + this.formData.admissionDateMonth + '-' + this.formData.admissionDateDay).format("YYYY-MM-DD"),
                'exit_date': moment(this.formData.exitDateYear + '-' + this.formData.exitDateMonth + '-' + this.formData.exitDateDay).format("YYYY-MM-DD"),
                'email': this.formData.email,
                'password': this.formData.password,
                'type': this.formData.type,
                'company_name': this.formData.companyName,
                'free_of_charge': this.formData.freeOfCharge,
                'certificate_of_payment': this.formData.certificateOfPayment,
                'certificate_expiration_date': moment(this.formData.certificateExpirationDateYear + '-' + this.formData.certificateExpirationDateMonth + '-' + this.formData.certificateExpirationDateDay).format("YYYY-MM-DD"),
                'tax_exempt_household': this.formData.taxExemptHousehold,
                'remarks': this.formData.remarks,
            };
            this.setActionLoading();
            let request;
            if(this.childId) {
                request = api.put('register/' + this.childId, null, requestData);
            } else {
                request = api.post('register', null, requestData);
            }
            request.then(() => {
                this.unsetActionLoading();
                showSuccess(this.$t('Successfully saved'));
            })
            .catch(e => {
                apiErrorHandler(e);
                this.unsetActionLoading();
            });
        },
        convertDataToFormData() {
            this.formData.childNumber = this.childInfor.number;
            this.formData.childName = this.childInfor.name;
            this.formData.gender = this.childInfor.gender;
            if(this.childInfor.birthDay){
                this.formData.birthYear = this.childInfor.birthDay.split('-')[0];
                this.formData.birthMonth = this.childInfor.birthDay.split('-')[1];
                this.formData.birthDay = this.childInfor.birthDay.split('-')[2];
            }
            this.formData.classId = this.childInfor.classId;
            if(this.childInfor.admissionDate) {
                this.formData.admissionDateYear = this.childInfor.admissionDate.split('-')[0];
                this.formData.admissionDateMonth = this.childInfor.admissionDate.split('-')[1];
                this.formData.admissionDateDay = this.childInfor.admissionDate.split('-')[2];
            }
            if(this.childInfor.exitDate) {
                this.formData.exitDateYear = this.childInfor.exitDate.split('-')[0];
                this.formData.exitDateMonth = this.childInfor.exitDate.split('-')[1];
                this.formData.exitDateDay = this.childInfor.exitDate.split('-')[2];
            }
            this.formData.email = this.childInfor.email;
            // this.formData.password = this.chi
            this.formData.type = this.childInfor.type;
            this.formData.companyName = this.childInfor.companyName;
            this.formData.freeOfCharge = this.childInfor.freeOfCharge;
            this.formData.certificateOfPayment = this.childInfor.certificateOfPayment;
            if(this.childInfor.certificateExpirationDate) {
                this.formData.certificateExpirationDateYear = this.childInfor.certificateExpirationDate.split('-')[0];
                this.formData.certificateExpirationDateMonth = this.childInfor.certificateExpirationDate.split('-')[1];
                this.formData.certificateExpirationDateDay = this.childInfor.certificateExpirationDate.split('-')[2];
            }
            this.formData.taxExemptHousehold = this.childInfor.taxExemptHousehold;
            this.formData.remarks = this.childInfor.remarks;
        },
        validate() {
            let valid = true;
            if (!this.formData.childNumber) {
                    this.errors.childNumber = this.$t('Please input number');                                 // need trans
                    valid = false;
            }
            if (!this.formData.childName) {
                this.errors.childName = this.$t('Please input name');                                 // need trans
                valid = false;
            }
            if (!this.formData.gender) {
                this.errors.gender = this.$t('Please input gender');                              //need trans
                valid = false;
            }
            if (!this.formData.birthYear) {
                this.errors.birthYear = this.$t('Please input number');                              //need trans
                valid = false;
            }
            if (!this.formData.birthMonth) {
                this.errors.birthMonth = this.$t('Please input number');                              //need trans
                valid = false;
            }
            if (!this.formData.birthDay) {
                this.errors.birthDay = this.$t('Please input number');                              //need trans
                valid = false;
            }
            if (!this.formData.classId) {
                this.errors.classId = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.admissionDateYear) {
                this.errors.admissionDateYear = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.admissionDateMonth) {
                this.errors.admissionDateMonth = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.admissionDateDay) {
                this.errors.admissionDateDay = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.exitDateYear) {
                this.errors.exitDateYear = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.exitDateMonth) {
                this.errors.exitDateMonth = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.exitDateDay) {
                this.errors.exitDateDay = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.email) {
                this.errors.email = this.$t('Please input email');
                valid = false;
            }
            if (!this.formData.password) {
                this.errors.password = this.$t('Please input password');
                valid = false;
            }
            if (!this.formData.type) {
                this.errors.type = this.$t('Please input type');
                valid = false;
            }
            if (!this.formData.companyName) {
                this.errors.companyName = this.$t('Please input name');
                valid = false;
            }
            if (this.formData.freeOfCharge === null || this.formData.freeOfCharge === undefined) {
                this.errors.freeOfCharge = this.$t('Please input name');
                valid = false;
            }
            if (this.formData.certificateOfPayment === null || this.formData.certificateOfPayment === undefined) {
                this.errors.certificateOfPayment = this.$t('Please input name');
                valid = false;
            }
            if (!this.formData.certificateExpirationDateYear) {
                this.errors.certificateExpirationDateYear = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.certificateExpirationDateMonth) {
                this.errors.certificateExpirationDateMonth = this.$t('Please input number');
                valid = false;
            }
            if (!this.formData.certificateExpirationDateDay) {
                this.errors.certificateExpirationDateDay = this.$t('Please input number');
                valid = false;
            }
            if (this.formData.taxExemptHousehold === null || this.formData.taxExemptHousehold === undefined) {
                this.errors.taxExemptHousehold = this.$t('Please input number');
                valid = false;
            }
            return valid;
        }
    },
    mounted() {
        const childId = this.$route.params.id;
        if(childId) {
            this.childId = parseInt(childId);
            this.getChildInfor();
        }
    }
};
</script>
