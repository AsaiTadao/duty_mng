<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">事業所マスタ</h3>
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
                                v-if="offices.length > 0"
                                class="table table-bordered table-striped table-master table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-grey text-white">
                                        <th>
                                            事業所No
                                        </th>
                                        <th>
                                            事業所名
                                        </th>
                                        <th rowspan="2">
                                            所定労働日数
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <template v-for="office in offices">
                                        <tr :key="office.id">
                                            <td>
                                                {{ office.number }}
                                            </td>
                                            <td>
                                                {{ office.name }}
                                            </td>
                                            <td class="align-middle" rowspan="2">
                                                <a href="#" class="mx-2" @click="onScheduleEditClick(office.id)">
                                                    <i class="far fa-edit fa-lg"></i>
                                                </a>
                                            </td>
                                            <td class="align-middle" rowspan="2">
                                                <a href="#" class="mx-2" @click="onEditClicked(office.id)">
                                                    <i class="far fa-edit fa-lg"></i>
                                                </a>
                                                <a href="#" @click="onOfficeDeleteClick(office.id)">
                                                    <i class="far fa-trash-alt fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr :key="office.id + '_rest_type'">
                                            <td colspan="2">
                                            <!-- 休憩時間の控除：6時間以上の勤務で1時間を自動控除 -->
                                            {{ getRestDeductionLabel(office.restDeductionId) }}
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div class="" v-else>
                                {{ $t("No Offices") }}
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addNewSchedule" tabindex="-1" role="dialog" aria-labelledby="addNewSchedule" aria-hidden="true">
                            <div class="modal-dialog modal-huge" role="document">
                                <schedule-working-form
                                    :officeId="selectedScheduledWorkings.officeId"
                                    :current="selectedScheduledWorkings.current"
                                    :next="selectedScheduledWorkings.next" />
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="office-master-form" tabindex="-1" role="dialog" aria-labelledby="office-master-form" aria-hidden="true">
                            <div class="modal-dialog modal-huge" role="document">
                                <office-master-form :data="masterFormData" :show="masterFormShow" v-on:success="onOfficeSaved" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import OfficeMasterForm from './OfficeMaster/OfficeMasterForm.vue';
import api, { apiErrorHandler } from '../global/api';
import ScheduleWorkingForm from './OfficeMaster/ScheduleWorkingForm.vue';
import actionLoading from '../mixin/actionLoading';
import { showSuccess } from '../helpers/error';
import { mapState } from 'vuex';
export default {
    mixins: [actionLoading],
  components: { OfficeMasterForm, ScheduleWorkingForm },
        data() {
            return {
                editmode: false,
                currentDate: new Date(),
                days: [],
                nextDays: [],
                months:[],
                nextMonths: [],
                attends : [],
                requests : [],
                scheduleDates : [],
                nextScheduleDates: [],
                masterFormData: {},
                masterFormShow: false,
                offices: [],

                selectedScheduledWorkings: {
                    current: [],
                    next: [],
                    officeId: null
                }
            }
        },
        computed: {
            ... mapState({
                restDeductions: state =>  state.constants.restDeductions,
            }),
        },
        methods: {
            onEditClicked(officeId) {
                const office = this.offices.find(({id}) => officeId === id);
                if (!office) return;
                this.masterFormData = {...office};
                this.showMasterForm();
            },
            onOfficeSaved() {
                this.getOffices();
                $("#office-master-form").modal('hide');
            },
            onScheduleEditClick(officeId){
                if (this.actionLoading) return;
                    this.setActionLoading();
                    api.get('office-master/' + officeId + '/scheduled-working')
                        .then((response) => {
                            this.unsetActionLoading();
                            const {current, next} = response;
                            this.selectedScheduledWorkings = {current, next, officeId};
                            this.showScheduleForm();
                        })
                        .catch(e => {
                            apiErrorHandler(e);
                            this.unsetActionLoading();
                        })
            },
            onOfficeDeleteClick(officeId){
                if (this.actionLoading) return;
                if (!confirm(this.$t("Are you really delete this item"))) return;
                this.setActionLoading();
                api.delete('office-master/' + officeId)
                    .then(() => {
                        this.unsetActionLoading();
                        showSuccess(this.$t('Successfully deleted'));
                        this.unsetActionLoading();
                        this.getOffices();
                    })
                    .catch(e => {
                        apiErrorHandler(e);
                        this.unsetActionLoading();
                    });
            },
            onNewClick () {
                this.masterFormData = {};
                this.showMasterForm();
            },
            showMasterForm() {
                $("#office-master-form").modal('show');
            },
            showScheduleForm(){
                $("#addNewSchedule").modal("show");
            },
            getOffices() {
                if (this.actionLoading) return;
                this.setActionLoading();
                api.get('office-master')
                    .then(response => {
                        this.unsetActionLoading();
                        this.offices = response;
                    })
                    .catch(e => {
                        apiErrorHandler(e);
                        this.unsetActionLoading();
                    });
            },
            getRestDeductionLabel(restDeductionId) {
                const restDeduction = this.restDeductions.find(({id}) => id === restDeductionId);
                if (!restDeduction) return '';
                return restDeduction.name;
            }
        },
        mounted() {
            this.getOffices();
        },
    }
</script>
<style scoped>
.calendar-center {
    display: flex;
    justify-content: center;
    align-items: center;
}
.calendar-title {
    display: flex;
    align-items: center;
}
</style>
