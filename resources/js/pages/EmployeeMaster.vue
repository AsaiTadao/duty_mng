<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <h3 class="card-title mb-0">社員マスタ</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary" @click="onNewClick()">
                                        新規登録
                                </button>
                            </div>
                            <div class="input-group w-auto">
                                <input type="search" class="form-control form-control-sm" placeholder="事業所名">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-master table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-grey text-white">
                                        <th>
                                            社員No
                                        </th>
                                        <th>
                                            氏　　名
                                        </th>
                                        <th>
                                            雇用形態
                                        </th>
                                        <th>
                                            在籍管理
                                        </th>
                                        <th rowspan="3"></th>
                                        <th rowspan="3"></th>
                                    </tr>
                                    <tr class="dark-grey text-white">
                                        <th>
                                            事業所
                                        </th>
                                        <th>
                                            エリア
                                        </th>
                                        <th>
                                            本社グループ
                                        </th>
                                        <th>
                                            勤務時間
                                        </th>
                                    </tr>
                                    <tr class="dark-grey text-white">
                                        <th colspan="2">
                                            メールアドレス
                                        </th>
                                        <th colspan="2">
                                            パスワード
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <template v-for="user in users">
                                    <tr :key="user.id">
                                        <td>{{user.number}}</td>
                                        <td>{{user.name}}</td>
                                        <td>{{employmentStatuses[user.employmentStatusId - 1].name}}</td>
                                        <td>在籍中</td>
                                        <td rowspan="3" class="align-middle"><i class="fas fa-qrcode fa-lg"></i></td>
                                        <td rowspan="3" class="align-middle">
                                            <a class="mx-2" @click="onEditClicked(user.id)">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a @click="onUserDeleteClick(user.id)">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr :key="user.id+'1'">
                                        <td>{{user.office? user.office.name: ''}}</td>
                                        <td>{{user.region? user.region.name: ''}}</td>
                                        <td>1</td>
                                        <td>8時間</td>
                                    </tr>
                                    <tr :key="user.id+'2'">
                                        <td colspan="2">{{user.email}}</td>
                                        <td colspan="2">*******</td>
                                    </tr>
                                    <tr :key="user.id+'3'" v-if="session.id != user.id">
                                        <td class="align-middle pl-4">権限タイプ</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <div class="d-flex align-items-center mr-3" @click="setRole(user.id, 1)">
                                                    <input class="mr-1" type="radio" :value="1" v-model="user.roleId"/>
                                                    <div class="mb-0">admin</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3" @click="setRole(user.id, 2)">
                                                    <input class="mr-1" type="radio" :value="2" v-model="user.roleId"/>
                                                    <div class="mb-0">エリアmgr</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3" @click="setRole(user.id, 3)">
                                                    <input class="mr-1" type="radio" :value="3" v-model="user.roleId"/>
                                                    <div class="mb-0">事業所管理者</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3" @click="setRole(user.id, 4)">
                                                    <input class="mr-1" type="radio" :value="4" v-model="user.roleId"/>
                                                    <div class="mb-0">一般A</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3" @click="setRole(user.id, 5)">
                                                    <input class="mr-1" type="radio" :value="5" v-model="user.roleId"/>
                                                    <div class="mb-0">一般B</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr :key="user.id+'4'">
                                        <td class="align-middle">残業手当</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <template v-for="overtimePayOption in overtimePayOptions">
                                                    <div class="d-flex align-items-center mr-3" :key="overtimePayOption.key" @click="setStatus(user.id, 'overtime_pay', overtimePayOption.key)">
                                                        <input class="mr-1" type="radio" :value="overtimePayOption.key" v-model="user.setting.overtimePay"/>
                                                        <div class="mb-0">{{overtimePayOption.value}}</div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr :key="user.id+'5'">
                                        <td class="align-middle">給与控除</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <template v-for="salaryDeductionOption in salaryDeductionOptions">
                                                    <div class="d-flex align-items-center mr-3" :key="salaryDeductionOption.key" @click="setStatus(user.id, 'salary_deduction', salaryDeductionOption.key)">
                                                        <input class="mr-1" type="radio" :value="salaryDeductionOption.key" v-model="user.setting.salaryDeduction"/>
                                                        <div class="mb-0">{{salaryDeductionOption.value}}</div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr :key="user.id+'6'">
                                        <td class="align-middle">申請期間</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <template v-for="applicationDeadlineOption in applicationDeadlineOptions">
                                                    <div class="d-flex align-items-center mr-3" :key="applicationDeadlineOption.key" @click="setStatus(user.id, 'application_deadline', applicationDeadlineOption.key)">
                                                        <input class="mr-1" type="radio" :value="applicationDeadlineOption.key" v-model="user.setting.applicationDeadline"/>
                                                        <div class="mb-0">{{applicationDeadlineOption.value}}</div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary float-right">CSV取込み</button>
                        <!-- Modal -->
                        <div class="modal fade" id="user-master-form" tabindex="-1" role="dialog" aria-labelledby="user-master-form" aria-hidden="true">
                            <div class="modal-dialog modal-huge" role="document">
                                <employee-master-form :formData="masterFormData" :regions="regions" v-on:success="onUserSaved" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import api, { apiErrorHandler } from '../global/api';
import actionLoading from '../mixin/actionLoading';
import { showSuccess } from '../helpers/error';
import { mapState } from 'vuex';
import EmployeeMasterForm from './EmployeeMaster/EmployeeMasterForm.vue';

    export default {
  components: { EmployeeMasterForm },
        mixins: [actionLoading],
        data() {
            return {
                users: [],
                masterFormData: {
                    regionId: 1,
                    officeGroupId: 1,
                },
                offices: [],
                regions: [],
            }
        },
        computed: {
        ...mapState({
            session: state =>  state.session.info,
            employmentStatuses: state => state.constants.employmentStatuses,
            overtimePayOptions: state => state.constants.overtimePayOptions,
            salaryDeductionOptions: state => state.constants.salaryDeductionOptions,
            applicationDeadlineOptions: state=> state.constants.applicationDeadlineOptions
         }),
        },
        methods: {
            onEditClicked(userId) {
                const user = this.users.find(({id}) => userId === id);
                if (!user) return;
                this.masterFormData = {
                    regionId: user.region ? user.region.id: null,
                    officeGroupId: user.officeGroup ? user.officeGroup.id : null,
                    ...user
                    };
                this.showMasterForm();
            },
            onUserSaved() {
                this.getUsers();
                $("#user-master-form").modal('hide');
            },
            getOffices() {
                api.get('office-master')
                    .then(response => {
                        this.offices = response;
                    })
                    .catch(e => apiErrorHandler(e));
            },
            getRegions() {
                api.get('region')
                    .then(response => {
                        this.regions = response;
                    })
                    .catch(e => apiErrorHandler(e));
            },
            onUserDeleteClick(hourlyId){
                if (this.actionLoading) return;
                if (!confirm(this.$t("Are you really delete this item"))) return;
                this.setActionLoading();
                api.delete('users/' + hourlyId)
                    .then(() => {
                        showSuccess(this.$t('Successfully deleted'));
                        this.getUsers();
                    })
                    .catch(e => apiErrorHandler(e))
                    .finally(() => {
                        this.unsetActionLoading();
                    })
            },
            onNewClick() {
                this.masterFormData = {
                    regionId: 1,
                    officeGroupId: 1,
                };
                this.showMasterForm();
            },
            showMasterForm() {
                $("#user-master-form").modal('show');
            },
            getUsers() {
                api.get('users', null, {page: 1, size: 100})
                    .then(response => {
                        console.log(response);
                        this.users = response;
                    })
                    .catch(e => apiErrorHandler(e));
            },
            setStatus(userId, statusKind, value) {
                if (this.actionLoading) return;
                this.setActionLoading();
                api.put('users/' + userId + '/setting', null, {[statusKind]: value})
                    .then(() => {
                        showSuccess(this.$t("Successfully saved"));
                        this.getUsers();
                    })
                    .catch(e => apiErrorHandler(e))
                    .finally(() => {
                        this.unsetActionLoading();
                    })
            },
            setRole(userId, value) {
                if (this.actionLoading) return;
                this.setActionLoading();
                api.put('users/' + userId + '/role', null, {'role_id': value})
                    .then(() => {
                        showSuccess(this.$t("Successfully saved"));
                        this.getUsers();
                    })
                    .catch(e => apiErrorHandler(e))
                    .finally(() => {
                        this.unsetActionLoading();
                    })
            }
        },
        mounted() {
            this.getUsers();
            this.getOffices();
            this.getRegions();
        }
    }
</script>
