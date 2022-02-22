<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="園児ID, 園児氏名, メールアドレス">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat">検索</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>託児計画作成</label>
                                <select>
                                    <option>全て</option>
                                    <option>未登録</option>
                                    <option>登録有</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-primary float-right" @click="registerChild()">
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
                                            年齢
                                        </th>
                                        <th>
                                            クラス
                                        </th>
                                        <th>
                                            託児計画
                                        </th>
                                        <th>
                                            園児台帳
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="child in childrenList" :key="child.id">
                                        <td>{{child.number}}</td>
                                        <td>{{child.name}}</td>
                                        <td v-if="child.gender == 1">男</td>
                                        <td v-else-if="child.gender == 2">女</td>
                                        <td v-else></td>
                                        <td>{{getAge(child.birthday)}}</td>
                                        <td>{{child.classId}}</td>
                                        <td>{{ child.planRegistered ? '登録有' : '未登録' }}</td>
                                        <td>
                                            <router-link
                                                :to="{name: 'children-detail', params: {id: child.id} }"
                                                >詳細
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
import { showSuccess } from '../helpers/error';

export default {
    mixins: [actionLoading],
    data() {
        return {
            retiredDisplay: false,
            childrenList: [],
            searchInput: '',
            childcareRegistered: 0,

        }
    },
    methods: {
        getChildrenList() {
            if (this.actionLoading) return;
            this.setActionLoading();
            const query = {query: this.searchInput, plan_registered: this.childcareRegistered};
            console.log({query});
            api.get('child', null, query)
                .then(response => {
                    this.unsetActionLoading();
                    this.childrenList = response;
                })
                .catch(e => {
                    apiErrorHandler(e);
                    this.unsetActionLoading();
                });
        },
        registerChild() {
            this.$router.push({name: 'children-register'});
        },
        getAge(birthDay) {
           if (!birthDay) return null;
            const ageInMonth = moment().diff(birthDay, 'months');
            const y = Math.floor(ageInMonth / 12);
            const m = ageInMonth % 12;
            return (y ? y + '歳' : '') + (m ? m + 'ヶ月' : '');
        }
    },
    mounted() {
        this.getChildrenList();
    }
};
</script>
