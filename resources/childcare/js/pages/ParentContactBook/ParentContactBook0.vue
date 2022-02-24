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
                                    <input type="text" class="form-control fixed-width-80 px-0" id="weatherStauts" v-model="formData.weather" @change="dataChanged = true;"/>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-4 col-sm-12">
                                    記入者 保護者様名：山田　三越
                                </div>
                                <div class="col-md-3 col-sm-10" style="display:flex;">
                                    <label for="mindername" style="min-width: 80px;">保育士名：</label>
                                    <input type="text" class="form-control" id="mindername" style="width: calc(100% - 85px);" @change="dataChanged = true;"/>
                                </div>
                            </div>
                            <div class="row" style="padding-left:15px; padding-right:15px;">
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        機嫌
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink form-check text-center py-2">
                                        <input class="form-check-input" type="radio" name="radio1" v-model="formData.mood" :value="1" @change="dataChanged = true;">
                                        <label class="form-check-label mr-4">普通</label>
                                        <input class="form-check-input" type="radio" name="radio1" v-model="formData.mood" :value="2" @change="dataChanged = true;">
                                        <label class="form-check-label mr-4">良い</label>
                                        <input class="form-check-input" type="radio" name="radio1" v-model="formData.mood" :value="3" @change="dataChanged = true;">
                                        <label class="form-check-label mr-4">悪い</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        検温
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <hour-minute-input v-model="formData.pickUpTime" @change="dataChanged = true;"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <input type="text" class="form-control" style="max-width: 55%;" @change="dataChanged = true;"/>℃　
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:15px; padding-right:15px;">
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        お迎え時間
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                       <hour-minute-input v-model="formData.pickUpTime" @change="dataChanged = true;"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        お迎えの方
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center py-2">
                                        山田　光子
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive p-0" id="contactbook">
                                <table class="table table-bordered table-children">
                                    <thead class="text-center text-white">
                                        <tr class="dark-brown">
                                            <th class="contactbook-fix dark-brown">時間</th>
                                            <th>睡眠</th>
                                            <th>検温</th>
                                            <th>排便</th>
                                            <th>食事・その他</th>
                                        </tr>
                                    </thead>
                                        <tbody class="text-center contactbook-tr">
                                            <template v-for="hour in hours">
                                                <tr :key="hour.time+'hours'">
                                                    <td rowspan="2" class="align-middle contactbook-fix">{{hour.time}}時</td>
                                                    <td class="text-center contact-book-click" style="position:relative;" @click="setHour(hour.time, 1)">
                                                        <div v-if="formData[`sleep${('0' + hour.time).slice(-2) + '00'}School`]" style="background-color: #EBCB42; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                        <div v-else-if="formData[`sleep${('0' + hour.time).slice(-2) + '00'}Home`]" style="background-color: #8BB3FC; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                    </td>
                                                    <td rowspan="2" style="width: 120px;">
                                                        <div class="d-flex justify-content-center" style="width: fit-content; margin: auto;">
                                                            <input type="text" class="form-control" v-model="formData[`temperature${('0' + hour.time).slice(-2)}Home`]" @change="dataChanged = true;"/>
                                                            <label class="align-self-center m-0 ml-1">℃</label>
                                                        </div>
                                                    </td>
                                                    <td rowspan="2" class="contact-book-mood">
                                                        <select class="form-control" v-model="formData[`defecation${hour.time}Home`]" @change="dataChanged = true;">
                                                            <option :value="0">-</option>
                                                            <option :value="1">普通</option>
                                                            <option :value="2">軟い</option>
                                                            <option :value="3">固い</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="2">
                                                        <input type="text" class="form-control px-2" v-model="formData[`meal${hour.time}Home`]" @change="dataChanged = true;"/>
                                                    </td>
                                                </tr>
                                                <tr :key="hour.time+'30mins'">
                                                    <td class="text-center" style="position:relative;" @click="setHour(hour.time, 2)">
                                                        <div v-if="formData[`sleep${('0' + hour.time).slice(-2) + '30'}School`] == 1" style="background-color: #EBCB42; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                        <div v-else-if="formData[`sleep${('0' + hour.time).slice(-2) + '30'}Home`] == 1" style="background-color: #8BB3FC; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="dark-blue text-center py-2 text-white">
                                        家庭での様子
                                    </div>
                                    <div class="light-blue p-4 mt-1" style="height: 300px;">
                                        <textarea class="form-control" style="height: 95%;" v-model="formData.state0Home" @change="dataChanged = true;">

                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="dark-yellow text-center py-2 text-white">
                                        保育園での様子
                                    </div>
                                    <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                        {{formData.state0School}}
                                    </div>
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
    sleep0100Home: false,
    sleep0130Home: false,
    sleep0200Home: false,
    sleep0230Home: false,
    sleep0300Home: false,
    sleep0330Home: false,
    sleep0400Home: false,
    sleep0430Home: false,
    sleep0500Home: false,
    sleep0530Home: false,
    sleep0600Home: false,
    sleep0630Home: false,
    sleep0700Home: false,
    sleep0730Home: false,
    sleep0800Home: false,
    sleep0830Home: false,
    sleep0900Home: false,
    sleep0930Home: false,
    sleep1000Home: false,
    sleep1030Home: false,
    sleep1100Home: false,
    sleep1130Home: false,
    sleep1200Home: false,
    sleep1230Home: false,
    sleep1300Home: false,
    sleep1330Home: false,
    sleep1400Home: false,
    sleep1430Home: false,
    sleep1500Home: false,
    sleep1530Home: false,
    sleep1600Home: false,
    sleep1630Home: false,
    sleep1700Home: false,
    sleep1730Home: false,
    sleep1800Home: false,
    sleep1830Home: false,
    sleep1900Home: false,
    sleep1930Home: false,
    sleep2000Home: false,
    sleep2030Home: false,
    sleep2100Home: false,
    sleep2130Home: false,
    sleep2200Home: false,
    sleep2230Home: false,
    sleep2300Home: false,
    sleep2330Home: false,
    sleep2400Home: false,
    sleep2430Home: false,
    temperature01Home: null,
    temperature02Home: null,
    temperature03Home: null,
    temperature04Home: null,
    temperature05Home: null,
    temperature06Home: null,
    temperature07Home: null,
    temperature08Home: null,
    temperature09Home: null,
    temperature10Home: null,
    temperature11Home: null,
    temperature12Home: null,
    temperature13Home: null,
    temperature14Home: null,
    temperature15Home: null,
    temperature16Home: null,
    temperature17Home: null,
    temperature18Home: null,
    temperature19Home: null,
    temperature20Home: null,
    temperature21Home: null,
    temperature22Home: null,
    temperature23Home: null,
    temperature24Home: null,
    defecation1Home: null,
    defecation2Home: null,
    defecation3Home: null,
    defecation4Home: null,
    defecation5Home: null,
    defecation6Home: null,
    defecation7Home: null,
    defecation8Home: null,
    defecation9Home: null,
    defecation10Home: null,
    defecation11Home: null,
    defecation12Home: null,
    defecation13Home: null,
    defecation14Home: null,
    defecation15Home: null,
    defecation16Home: null,
    defecation17Home: null,
    defecation18Home: null,
    defecation19Home: null,
    defecation20Home: null,
    defecation21Home: null,
    defecation22Home: null,
    defecation23Home: null,
    defecation24Home: null,
    meal1Home: '',
    meal2Home: '',
    meal3Home: '',
    meal4Home: '',
    meal5Home: '',
    meal6Home: '',
    meal7Home: '',
    meal8Home: '',
    meal9Home: '',
    meal10Home: '',
    meal11Home: '',
    meal12Home: '',
    meal13Home: '',
    meal14Home: '',
    meal15Home: '',
    meal16Home: '',
    meal17Home: '',
    meal18Home: '',
    meal19Home: '',
    meal20Home: '',
    meal21Home: '',
    meal22Home: '',
    meal23Home: '',
    meal24Home: '',
    state0Home: '',
    contact0Home: '',
}
export default {
    components: {
        Datepicker,
        HourMinuteInput
    },
    mixins: [actionLoading],
    props: {
        contact: {},
        child: {},
        date: null,
    },
    computed: {
        ...mapState({
            currentOfficeName: state =>  {
                if (state.session.info.office) return state.session.info.office.name;
                return '';
            }
        })
    },
    data () {
        return {
            dataChanged: false,
            formData: {...initialFormData},
            currentDate: new Date(),
            todayDate: "",
            hours: [
                {
                    time:'18',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'19',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'20',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'21',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'22',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'23',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'24',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'1',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'2',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'3',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'4',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'5',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'6',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'7',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'8',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'9',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'10',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'11',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'12',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'13',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'14',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'15',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'16',
                    enabled1: true,
                    enabled2: true,
                },
                {
                    time:'17',
                    enabled1: true,
                    enabled2: true,
                }],
            selectedDate: new Date(),
            ja: ja,
        }
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
        initFormError() {
            this.errors = {

            }
        },
        setHour(hourIndex, number) {
            this.dataChanged = true;
            console.log(this.formData);
            if(number == 1) {
                console.log(this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}School`]);
                if(this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}School`] != 1) {
                    this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}Home`] = 1 - this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}Home`];
                }
            }
            else if(number == 2) {
                if(this.formData[`sleep${('0' + hourIndex).slice(-2) + '30'}School`] != 1) {
                    this.formData[`sleep${('0' + hourIndex).slice(-2) + '30'}Home`] = 1 - this.formData[`sleep${('0' + hourIndex).slice(-2) + '30'}Home`];
                }
            }
        },
        saveContact() {
            if(this.actionLoading) return;
            if (!this.validate()) return;
            const requestData = this.formData;
            requestData['date'] = moment(this.selectedDate).format('YYYY-MM-DD');
            if(this.formData.pickUpTime)
                requestData['pick_up_time'] = moment(this.formData.pickUpTime, 'h:mm:ss').format('HH:mm');
            this.setActionLoading();
            api.post('contact-book/child/' + this.child.id + '/home/0', null, requestData)
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
