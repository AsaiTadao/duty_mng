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
                                <button type="submit" class="btn btn-sm btn-primary float-right" @click="childcarePlan()">
                                    託児計画作成
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary float-right mr-2">
                                    <i class="fas fa-qrcode fa-lg"></i>
                                    QRコード発行
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
                                            {{childInfor.number}}
                                        </td>
                                        <td>
                                            {{childInfor.name}}
                                        </td>
                                        <td v-if="childInfor.gender == 1">
                                            男
                                        </td>
                                        <td v-else>
                                            女
                                        </td>
                                        <td>
                                            {{childInfor.birthday}}
                                        </td>
                                        <td>
                                            {{childInfor.birthday}}
                                        </td>
                                        <td>
                                            {{getChildClass()}}
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
                                            {{getDateFormat(childInfor.admissionDate)}}
                                        </td>
                                        <td>
                                            {{getDateFormat(childInfor.exitDate)}}
                                        </td>
                                        <td>
                                            {{childInfor.email}}
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-0 mb-1">
                            <table
                                class="table table-bordered table-hover mb-0"
                            >
                                <tbody class="text-center">
                                    <tr>
                                        <td class="light-blue align-middle" style="width: 200px">
                                            備考欄
                                        </td>
                                        <td class="p-0 bg-white">
                                            {{childInfor.remarks}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td rowspan="3" class="text-center text-white dark-pink align-middle">
                                            登園予定
                                        </td>
                                        <td class="light-pink text-center">火曜・水曜・木曜</td>
                                        <td class="light-pink text-center">8:00～17:00</td>
                                    </tr>
                                    <tr class="light-pink text-center">
                                        <td>月曜・金曜</td>
                                        <td>9:00～18:00</td>
                                    </tr>
                                    <tr class="light-pink text-center">
                                        <td>ー</td>
                                        <td>ー</td>
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
                                            従業員枠企業名
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            {{getChildType()}}
                                        </td>
                                        <td>
                                            {{childInfor.companyName}}
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
                                            {{getChildType()}}
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
                                        <td v-if="this.childInfor.freeOfCharge">
                                            対象
                                        </td>
                                        <td v-else>非対象</td>
                                        <td v-if="this.childInfor.certificateOfPayment">
                                            有り
                                        </td>
                                        <td v-else>
                                            無し
                                        </td>
                                        <td>
                                            {{getDateFormat(this.childInfor.certificateExpirationDate)}}
                                        </td>
                                        <td v-if="this.childInfor.taxExemptHousehold">
                                            〇
                                        </td>
                                        <td v-else></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right mr-2" @click="presentManagement()">登降園管理</button>
                            <button class="btn btn-primary float-right" @click="editChild()">編集</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import moment from 'moment';
import { mapState } from 'vuex';
import api, { apiErrorHandler } from '../global/api';
import actionLoading from '../mixin/actionLoading';

export default {
    mixins: [actionLoading],
    data() {
        return {
            retiredDisplay: false,
            childId: null,
            childInfor: {
                number: '',
                name: '',
                gender: null,
                birthday: null,
                classId: null,
                type: null,
                companyName: '',
                freeOfCharge: null,
                certificateOfPayment: null,
                certificateExpirationDate: null,
                taxExemptHousehold: null,
                remarks: null
            },
        }
    },
    computed: {
        ...mapState({
            childrenClasses: state => state.constants.childrenClasses,
            childTypes: state => state.constants.childTypes
        }),
    },
    methods: {
        childcarePlan() {
            this.$router.push('childcare-plan');
        },
        presentManagement() {
            this.$router.push('present-management');
        },
        getChildInfor() {
            if(this.actionLoading) return;
            this.setActionLoading();
            api.get('child/' + this.childId, null)
                .then(response => {
                    this.childInfor = response;
                    this.unsetActionLoading();
                })
                .catch(e => {
                    apiErrorHandler(e);
                    this.unsetActionLoading();
                });
        },
        getChildClass() {
            if(this.childInfor != null) {
                const result = this.childrenClasses.find(element => {
                return element.id == this.childInfor.classId;
                });
                if(result)
                    return result.name;
                else
                    return null;
            } else {
                return null;
            }
        },
        getDateFormat(date) {
            if(!date) return null;
            return moment(date).format('YYYY年 MM月 DD日');
        },
        getChildType() {
            if(this.childInfor != null) {
                const result = Object.values(this.childTypes).find(element => {
                return element.key == this.childInfor.type;
                });
                if(result)
                    return result.value;
                else
                    return null;
            } else {
                return null;
            }
        },
        editChild() {
            this.$router.push({name: 'children-edit', params: {id: this.childId}});
        }
    },
    mounted() {
        const childId = this.$route.params.id;
        this.childId = parseInt(childId);
        this.getChildInfor();
    }
};
</script>
