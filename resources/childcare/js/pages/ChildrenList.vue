<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="園児ID, 園児氏名, メールアドレス" v-model="searchInput" v-on:keyup.enter = "getChildrenList">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat" @click="getChildrenList">検索</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="align-middle" :value="1" v-model="all" @click="changeAll">
                                    <div class="ml-1 mr-2">全て</div>
                                    <input type="checkbox" class="align-middle" :value="2" v-model="exited" @click="changeExited">
                                    <div class="ml-1 mr-2">退園児</div>
                                    <input type="checkbox" class="align-middle" :value="3" v-model="canceled" @click="changeCanceled">
                                    <div class="ml-1 mr-2">キャンセル</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>託児計画作成</label>
                                <select v-model="planRegistered" @change="getChildrenList">
                                    <option :value="-1">全て</option>
                                    <option :value="0">未登録</option>
                                    <option :value="1">登録有</option>
                                </select>
                            </div>
                            <div class="col-md-2">
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
                                        <td>{{getChildClass(child.classId)}}</td>
                                        <td v-if="child.planRegistered">
                                            <router-link
                                                :to="{name: 'childcare-plan', params: {childId: child.id}}">
                                                編集
                                            </router-link>
                                        </td>
                                        <td v-else>
                                            <router-link
                                                :to="{name: 'childcare-plan', params: {childId: child.id}}">
                                                未登録
                                            </router-link>
                                        </td>
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
            all: false,
            exited: false,
            canceled: false,
            childrenList: [],
            searchInput: '',
            planRegistered: -1,

            searchFilter: '',
        }
    },
    computed: {
        ...mapState({
            childrenClasses: state => state.constants.childrenClasses,
            childTypes: state => state.constants.childTypes
        }),
    },
    methods: {
        getChildrenList() {
            if (this.actionLoading) return;
            this.searchFilter = this.searchInput;
            this.setActionLoading();
            let query;
            if(this.planRegistered != -1)
                query = {query: this.searchFilter, plan_registered: this.planRegistered, all: this.all ? 1 : 0, exited: this.exited ? 1 : 0, canceled: this.canceled ? 1 : 0};
            else
                query = {query: this.searchFilter, all: this.all ? 1 : 0, exited: this.exited ? 1 : 0, canceled: this.canceled ? 1 : 0};
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
        },
        getChildClass(classId) {
            if(classId != null) {
                const result = this.childrenClasses.find(element => {
                return element.id == classId;
                });
                if(result)
                    return result.name;
                else
                    return null;
            } else {
                return null;
            }
        },
        changeAll() {
            this.all = !this.all;
            if(this.all) {
                this.exited = true;
                this.canceled = true;
            } else {
                this.exited = false;
                this.canceled = false;
            }
            this.getChildrenList();
        },
        changeExited() {
            this.exited = !this.exited;
            this.all = false;
            this.getChildrenList();
        },
        changeCanceled() {
            this.canceled = !this.canceled;
            this.all = false;
            this.getChildrenList();
        }
    },
    mounted() {
        this.getChildrenList();
    }
};
</script>
