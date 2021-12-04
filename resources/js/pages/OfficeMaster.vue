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
                                <button type="submit" class="btn btn-sm btn-primary" @click="showMasterForm()">
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
                                                <a href="#" class="mx-2" @click="addSchedule()">
                                                    <i class="far fa-edit fa-lg"></i>
                                                </a>
                                            </td>
                                            <td class="align-middle" rowspan="2">
                                                <a href="#" class="mx-2" @click="onEditClicked(office.id)">
                                                    <i class="far fa-edit fa-lg"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="far fa-trash-alt fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr :key="office.id + '_rest_type'">
                                            <td colspan="2">
                                            休憩時間の控除：6時間以上の勤務で1時間を自動控除
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
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"></h5>
                                        <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="this-year-tab" data-toggle="pill" href="#this-year-table" role="tab" aria-controls="this-year-table" aria-selected="true">本年度</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="next-year-tab" data-toggle="pill" href="#next-year-table" role="tab" aria-controls="next-year-table" aria-selected="false">来年度</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            <div class="tab-pane fade show active" id="this-year-table" role="tabpanel" aria-labelledby="this-year-tab">
                                                <div class="table-responsive p-0">
                                                    <table
                                                        class="table table-bordered table-striped table-master table-hover"
                                                    >
                                                        <thead class="text-center">
                                                            <tr class="dark-grey text-white">
                                                                <th>
                                                                    年月
                                                                </th>
                                                                <th>
                                                                    所定労働日数
                                                                </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                            <tr v-for="schedule in scheduleDates" :key="schedule['month']">
                                                                <td>{{schedule['month']}}</td>
                                                                <td>
                                                                    {{schedule['days']}}日
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="mx-2">
                                                                        <i class="far fa-edit fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="next-year-table" role="tabpanel" aria-labelledby="next-year-tab">
                                                <div class="table-responsive p-0">
                                                    <table
                                                        class="table table-bordered table-striped table-master table-hover"
                                                    >
                                                        <thead class="text-center">
                                                            <tr class="dark-grey text-white">
                                                                <th>
                                                                    年月
                                                                </th>
                                                                <th>
                                                                    所定労働日数
                                                                </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                            <tr v-for="nextSchedule in nextScheduleDates" :key="nextSchedule['month']">
                                                                <td>{{nextSchedule['month']}}</td>
                                                                <td>
                                                                    {{nextSchedule['days']}}日
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="mx-2">
                                                                        <i class="far fa-edit fa-lg"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">登録</button>
                                    </div>
                                </div>
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
    import moment from 'moment';
import OfficeMasterForm from './OfficeMaster/OfficeMasterForm.vue';
import api, { apiErrorHandler } from '../global/api';
    export default {
  components: { OfficeMasterForm },
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
            }
        },
        methods: {
            getOffices() {
                api.get('office-master')
                    .then(response => {
                        this.offices = response;
                    })
                    .catch(e => apiErrorHandler(e));
            },
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
            showMasterForm() {
                $("#office-master-form").modal('show');

            },
            addSchedule(){
                $("#addNewSchedule").modal("show");
            },
            getThisYearMonths() {
                const date = this.currentDate;
                this.months = [];
                for(let month = 1; month <= 12; month++) {
                    this.months.push(moment(new Date(date.getFullYear(), 3+month, 0)).format('YYYY年 M月'));
                    this.days.push(new Date(date.getFullYear(), 3+month, 0).getDate());
                    this.scheduleDates.push({days: new Date(date.getFullYear(), 3+month, 0).getDate(), month: moment(new Date(date.getFullYear(), 3+month, 0)).format('YYYY年 M月')});
                }
            },
            getNextYearMonths() {
                const date = this.currentDate;
                // var firstMonth = new Date(date.getFullYear(), 4, 0);
                // var lastMonth = new Date(date.getFullYear() + 1, 3, 0);
                this.nextMonths = [];
                for(let month = 1; month <= 12; month++) {
                    this.nextMonths.push(moment(new Date(date.getFullYear() +1, 3+month, 0)).format('YYYY年 M月'));
                    this.nextDays.push(new Date(date.getFullYear() +1, 3+month, 0).getDate());
                    this.nextScheduleDates.push({days: new Date(date.getFullYear()+1, 3+month, 0).getDate(), month: moment(new Date(date.getFullYear()+1, 3+month, 0)).format('YYYY年 M月')});
                }
            },
        },
        mounted() {
            this.getOffices();
        },
        created() {
            this.getThisYearMonths();
            this.getNextYearMonths();
        }
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
