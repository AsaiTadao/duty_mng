<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header calendar-title row">
                        <div class="col-md-6 col-12 row">
                            <h5 class="card-title col-4 mb-0 px-0">{{ currentOfficeName }}</h5>
                            <div class="col-4 mb-0 px-0">ー連絡帳ー</div>
                            <div class="col-4 mb-0 px-0">{{child.name}}</div>
                        </div>
                        <div class="col-md-6 col-12 row d-flex align-items-center">
                            <div class="col-7 d-flex align-items-center p-0">
                                <datepicker
                                :language="ja"
                                :format="customFormatter"
                                ref="programaticOpen"
                                :placeholder="todayDate"
                                @selected="getContact"
                                v-model="selectedDate">
                                </datepicker>
                                <button type="button" class="btn btn-sm btn-outline mx-0" @click="openDatePicker()">
                                <i class="fas fa-calendar-alt fa-2x"></i>
                                </button>
                            </div>
                            <div class="col-5 d-flex align-items-center px-0">
                                <div for="weatherStauts" class="col-form-label mr-2">天気</div>
                                <input type="text" class="form-control fixed-width-80 px-0" value="晴れ" id="weatherStauts" v-model="formData.weather" @change="dataChanged = true;"/>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4 col-12 mb-1">
                                記入者 保護者様名：山田　三越
                            </div>
                            <div class="col-md-3 col-10" style="display:flex;">
                                <label for="mindername" style="min-width: 80px;">保育士名：</label>
                                <div>山田　三越</div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="dark-blue text-center py-2 text-white">
                                    家庭からの連絡事項
                                </div>
                                <div class="light-blue p-4 mt-1" style="height: 300px;">
                                    <textarea class="form-control" style="height: 95%;" v-model="formData.contact0Home" @change="dataChanged = true;">

                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="dark-yellow text-center py-2 text-white">
                                    保育園からの連絡事項
                                </div>
                                <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                    {{formData.contact0School}}
                                </div>
                            </div>
                        </div>
                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right mr-2" @click="saveContact">登録</button>
                            <button class="btn btn-primary float-right">Excel出力</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Datepicker from "vuejs-datepicker";
import { ja } from 'vuejs-datepicker/dist/locale';
import moment from 'moment-timezone';
import { mapState } from 'vuex';
import actionLoading from '../../mixin/actionLoading';
import api, { apiErrorHandler } from '../../global/api';
import HourMinuteInput from '../../components/HourMinuteInput.vue';
import { showSuccess } from '../../helpers/error';

const initialFormData = {
    date: new Date(),
    weather: '',
    mood: null,
    pickUpPerson: null,
    pickUpTime: null,
    contact0Home: '',
}

export default {
    components: {
        Datepicker
    },
    mixins: [actionLoading],
    props: {
        contact: {},
        child: {},
        date: null,
    },
    data () {
        return {
            dataChanged: false,
            formData: {...initialFormData},
            errors: {},
            currentDate: new Date(),
            todayDate: "",
            selectedDate: new Date(),
            ja: ja,
        }
    },
    computed: {
        ...mapState({
            currentOfficeName: state =>  {
                if (state.session.info.office) return state.session.info.office.name;
                return '';
            }
        })
    },
    methods: {
        convertToFormData() {
            //this.initializeFormData();
            if (this.contact) {
                this.formData = {...this.contact};
            }
        },
        initializeFormData() {
            this.formData = {

            };
        },
        getCurrentDate(){
            return moment().format('YYYY年 M月 D日 (ddd)');
        },
        currentTime(){
            var today = new Date();
            var month = today.getMonth() + 1;
            var day = today.getDate();
            return month + "月" + day + "日 "
            + today.getHours() + ":"
            + today.getMinutes();
        },
        customFormatter(date) {
            return moment(date).format('YYYY年 M月 D日 (ddd)');
        },
        saveContact() {
            if(this.actionLoading) return;
            if (!this.validate()) return;
            const requestData = this.formData;
            requestData['date'] = moment(this.selectedDate).format('YYYY-MM-DD');
            if(this.formData.pickUpTime)
                requestData['pick_up_time'] = moment(this.formData.pickUpTime, 'h:mm:ss').format('HH:mm');
            this.setActionLoading();
            api.post('contact-book/child/' + this.child.id + '/home/2', null, requestData)
            .then(() => {
                this.unsetActionLoading();
                showSuccess(this.$t('Successfully saved'));
                this.dataChanged = false;
            })
            .catch(e => {
                this.dataChanged = false;
                apiErrorHandler(e);
                this.unsetActionLoading();
            });
        },
        validate() {
            let valid = true;
            return valid;
        },
        initFormError() {
            this.errors = {
            }
        },
        getContact(date) {
            if(this.actionLoading) return;
            this.setActionLoading();
            if(date){
                this.selectedDate = date;
            } else {
                this.selectedDate = new Date();
            }
            this.selectedDate = moment(this.selectedDate).format('YYYY-MM-DD');
            api.get('contact-book/child/' + this.child.id, null, {date: this.selectedDate})
                .then(response => {
                    this.unsetActionLoading();
                    this.dataChanged = false;
                    if (response.contactBook) {
                        this.formData = response.contactBook;
                    } else {
                        this.formData = {...initialFormData};
                    }
                })
                .catch(e => {
                    this.dataChanged = false;
                    this.unsetActionLoading();
                    apiErrorHandler(e);
                });
        },
        changeTimeFormat(date) {
            if(date) {
                return moment(date).tz('Asia/Tokyo').format('HH:mm');
            } else {
                return "-";
            }
        },
        openDatePicker(){
            if(this.dataChanged) {
                if(!confirm(this.$t('Are you sure moving to other date without saving data?'))) return;
            }
            this.$refs.programaticOpen.showCalendar();
        }
    },
    created() {

    },
    mounted() {
        this.todayDate = this.getCurrentDate().toString();
        this.selectedDate = this.date;
        this.convertToFormData();
        this.initFormError();
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
    @media (max-width: 500px) {
       h5.card-title {
           font-size: 13px!important;
       }
    }
</style>
<style>
div.vdp-datepicker input{
    width: 145px;
}
@media (max-width: 500px) {

    div.vdp-datepicker input{
        font-size: 10px;
        width: 100px;
    }
}
</style>
