<template>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="card-title mb-0 pr-5">{{ currentOfficeName }}</h5>
                                    <div class="mb-0 pl-4">{{child.name}}</div>
                                </div>
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <div class="d-flex align-items-center p-0">
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
                                    <div class="d-flex align-items-center px-3 is-invalid">
                                        <div for="weatherStauts" class="form-label mr-2">天気</div>
                                        <input type="text" class="form-control fixed-width-80 px-0" value="晴れ" id="weatherStauts" :class="{'is-invalid' : errors.weather}" v-model="formData.weather" @change="dataChanged = true; errors.weather = null;"/>
                                    </div>
                                    <span v-if="errors.weather" class="error invalid-feedback">
                                        {{errors.weather}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-5 col-12 align-items-center mb-2" style="display:flex;">
                                    <label for="parentname" style="min-width: 100px; margin-bottom:0px;">記入者 保護者様名：</label>
                                    <input type="text" class="form-control" id="parentname" style="width: calc(90% - 130px);" v-model="formData.guardian" :class="{'is-invalid': errors.guardian}" @change="dataChanged = true; errors.guardian = null;"/>
                                    <span v-if="errors.guardian" class="error invalid-feedback">
                                        {{errors.guardian}}
                                    </span>
                                </div>
                                <div class="col-md-5 col-12 align-items-center mb-2" style="display:flex;">
                                    <label for="mindername" style="min-width: 80px; margin-bottom:0px;">保育士名：</label>
                                    <input type="text" class="form-control" id="mindername" style="width: calc(90% - 80px);" v-model="formData.nurseName" :class="{'is-invalid': errors.nurseName}" @change="dataChanged = true; errors.nurseName = null;"/>
                                    <span v-if="errors.nurseName" class="error invalid-feedback">
                                        {{errors.nurseName}}
                                    </span>
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
                                        <hour-minute-input v-model="formData.temperatureTimeStd" :error="errors.temperatureTimeStd" @input="dataChanged = true; errors.temperatureTimeStd = null;"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <input type="number" min="0" max="60" class="form-control" style="max-width: 55%;"  :class="{'is-invalid': errors.temperatureStd}" v-model="formData.temperatureStd" @change="dataChanged = true; errors.temperatureStd = null;"/>℃　
                                        <span v-if="errors.temperatureStd"  class="error invalid-feedback">
                                            {{errors.temperatureStd}}
                                        </span>
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
                                       <hour-minute-input v-model="formData.pickUpTime" @input="dataChanged = true; errors.pickUpTime = null;" :error="errors.pickUpTime"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2">
                                        お迎えの方
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                        <input type="text" class="form-control" style="max-width: 55%;" v-model="formData.pickUpPerson" :class="{'is-invalid': errors.pickUpPerson}" @change="dataChanged = true;errors.pickUpPerson = null;"/>
                                        <span v-if="errors.pickUpPerson" class="error invalid-feedback">
                                            {{errors.pickUpPerson}}
                                        </span>
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
                                                        <div class="d-flex justify-content-center is-invalid" style="width: fit-content; margin: auto;">
                                                            <input type="number" class="form-control" v-if="formData[`temperature${('0' + hour.time).slice(-2)}School`]" :class="{'is-invalid': errors[`temperature${('0' + hour.time).slice(-2)}School`]}" v-model="formData[`temperature${('0' + hour.time).slice(-2)}School`]" @change="dataChanged = true; errors[`temperature${('0' + hour.time).slice(-2)}School`] = null;"/>
                                                            <input type="number" class="form-control" v-else-if="formData[`temperature${('0' + hour.time).slice(-2)}Home`]" :class="{'is-invalid': errors[`temperature${('0' + hour.time).slice(-2)}School`]}" v-model="formData[`temperature${('0' + hour.time).slice(-2)}Home`]" disabled @change="dataChanged = true; errors[`temperature${('0' + hour.time).slice(-2)}School`] = null;"/>
                                                            <input type="number" class="form-control" v-else v-model="formData[`temperature${('0' + hour.time).slice(-2)}School`]" :class="{'is-invalid': errors[`temperature${('0' + hour.time).slice(-2)}School`]}" @change="dataChanged = true; errors[`temperature${('0' + hour.time).slice(-2)}School`] = null;"/>
                                                            <label class="align-self-center m-0 ml-1">℃</label>
                                                        </div>
                                                        <span v-if="errors[`temperature${('0' + hour.time).slice(-2)}School`]" class="error invalid-feedback">
                                                            {{errors[`temperature${('0' + hour.time).slice(-2)}School`]}}
                                                        </span>
                                                    </td>
                                                    <td rowspan="2" style="width: 100px;">
                                                        <select class="form-control" v-if="formData[`defecation${hour.time}School`]" v-model="formData[`defecation${hour.time}School`]" @change="dataChanged = true;">
                                                            <option :value="0">-</option>
                                                            <option :value="1">普</option>
                                                            <option :value="2">軟</option>
                                                            <option :value="3">固</option>
                                                        </select>
                                                        <select class="form-control" v-else-if="formData[`defecation${hour.time}Home`]" v-model="formData[`defecation${hour.time}Home`]" disabled @change="dataChanged = true;">
                                                            <option :value="0">-</option>
                                                            <option :value="1">普</option>
                                                            <option :value="2">軟</option>
                                                            <option :value="3">固</option>
                                                        </select>
                                                        <select class="form-control" v-else v-model="formData[`defecation${hour.time}School`]" @change="dataChanged = true;">
                                                            <option :value="0">-</option>
                                                            <option :value="1">普</option>
                                                            <option :value="2">軟</option>
                                                            <option :value="3">固</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="2">
                                                        <input type="text" class="form-control px-2" v-if="formData[`meal${hour.time}School`]" v-model="formData[`meal${hour.time}School`]" :class="{'is-invalid': errors[`meal${hour.time}School`]}" @change="dataChanged = true; errors[`meal${hour.time}School`] = null;"/>
                                                        <input type="text" class="form-control px-2" v-else-if="formData[`meal${hour.time}Home`]" v-model="formData[`meal${hour.time}Home`]" :class="{'is-invalid': errors[`meal${hour.time}School`]}" disabled @change="dataChanged = true; errors[`meal${hour.time}School`] = null;"/>
                                                        <input type="text" class="form-control px-2" v-else v-model="formData[`meal${hour.time}School`]" :class="{'is-invalid': errors[`meal${hour.time}School`]}" @change="dataChanged = true;errors[`meal${hour.time}School`] = null;"/>
                                                        <span v-if="errors[`meal${hour.time}School`]" class="error invalid-feedback">
                                                            {{errors[`meal${hour.time}School`]}}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr :key="hour.time+'30mins'" style="background-color: #dcd5bc;">
                                                    <td class="text-center" style="position:relative;" @click="setHour(hour.time, 2)">
                                                        <div v-if="formData[`sleep${('0' + hour.time).slice(-2) + '30'}School`]" style="background-color: #EBCB42; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
                                                        <div v-else-if="formData[`sleep${('0' + hour.time).slice(-2) + '30'}Home`]" style="background-color: #8BB3FC; width:50%; height: 100%; position:absolute;left: 25%;top:0;"></div>
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
                                        {{formData.state0Home}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="dark-yellow text-center py-2 text-white">
                                        保育園での様子
                                    </div>
                                    <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                        <textarea class="form-control" style="height: 95%;" v-model="formData.state0School" @change="dataChanged = true;">

                                        </textarea>
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
                                        {{formData.contact0Home}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="dark-yellow text-center py-2 text-white">
                                        保育園からの連絡事項
                                    </div>
                                    <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                        <textarea class="form-control" style="height: 95%;" v-model="formData.contact0School" @change="dataChanged = true;">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right d-flex align-items-center mt-2">
                                <button class="btn btn-primary float-right mr-2" @click="saveContact">登録</button>
                                <button class="btn btn-primary float-right" @click="exportExcel">Excel出力</button>
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
import LocalStorage from '../../helpers/localStorage';
import { validateHhMm } from '../../helpers/datetime';

const initialFormData = {
    date: new Date(),
    weather: '',
    mood: null,
    guardian: '',
    nurseName: '',
    pickUpPerson: null,
    pickUpTime: null,
    temperatureStd: '',
    temperatureTimeStd: null,
    sleep0100School: false,
    sleep0130School: false,
    sleep0200School: false,
    sleep0230School: false,
    sleep0300School: false,
    sleep0330School: false,
    sleep0400School: false,
    sleep0430School: false,
    sleep0500School: false,
    sleep0530School: false,
    sleep0600School: false,
    sleep0630School: false,
    sleep0700School: false,
    sleep0730School: false,
    sleep0800School: false,
    sleep0830School: false,
    sleep0900School: false,
    sleep0930School: false,
    sleep1000School: false,
    sleep1030School: false,
    sleep1100School: false,
    sleep1130School: false,
    sleep1200School: false,
    sleep1230School: false,
    sleep1300School: false,
    sleep1330School: false,
    sleep1400School: false,
    sleep1430School: false,
    sleep1500School: false,
    sleep1530School: false,
    sleep1600School: false,
    sleep1630School: false,
    sleep1700School: false,
    sleep1730School: false,
    sleep1800School: false,
    sleep1830School: false,
    sleep1900School: false,
    sleep1930School: false,
    sleep2000School: false,
    sleep2030School: false,
    sleep2100School: false,
    sleep2130School: false,
    sleep2200School: false,
    sleep2230School: false,
    sleep2300School: false,
    sleep2330School: false,
    sleep2400School: false,
    sleep2430School: false,
    temperature01School: null,
    temperature02School: null,
    temperature03School: null,
    temperature04School: null,
    temperature05School: null,
    temperature06School: null,
    temperature07School: null,
    temperature08School: null,
    temperature09School: null,
    temperature10School: null,
    temperature11School: null,
    temperature12School: null,
    temperature13School: null,
    temperature14School: null,
    temperature15School: null,
    temperature16School: null,
    temperature17School: null,
    temperature18School: null,
    temperature19School: null,
    temperature20School: null,
    temperature21School: null,
    temperature22School: null,
    temperature23School: null,
    temperature24School: null,
    defecation1School: null,
    defecation2School: null,
    defecation3School: null,
    defecation4School: null,
    defecation5School: null,
    defecation6School: null,
    defecation7School: null,
    defecation8School: null,
    defecation9School: null,
    defecation10School: null,
    defecation11School: null,
    defecation12School: null,
    defecation13School: null,
    defecation14School: null,
    defecation15School: null,
    defecation16School: null,
    defecation17School: null,
    defecation18School: null,
    defecation19School: null,
    defecation20School: null,
    defecation21School: null,
    defecation22School: null,
    defecation23School: null,
    defecation24School: null,
    meal1School: '',
    meal2School: '',
    meal3School: '',
    meal4School: '',
    meal5School: '',
    meal6School: '',
    meal7School: '',
    meal8School: '',
    meal9School: '',
    meal10School: '',
    meal11School: '',
    meal12School: '',
    meal13School: '',
    meal14School: '',
    meal15School: '',
    meal16School: '',
    meal17School: '',
    meal18School: '',
    meal19School: '',
    meal20School: '',
    meal21School: '',
    meal22School: '',
    meal23School: '',
    meal24School: '',
    state0School: '',
    contact0School: '',
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
            errors: {
                weather: null,
            },
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
                weather: null,
                guardian: null,
                nurseName: null,
                temperatureTimeStd: null,
                temperatureStd: null,
                pickUpTime: null,
                pickUpPerson: null
            }
        },
        setHour(hourIndex, number) {
            this.dataChanged = true;
            if(number == 1) {
                if(this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}Home`] != 1) {
                    this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}School`] = 1 - this.formData[`sleep${('0' + hourIndex).slice(-2) + '00'}School`];
                }
            }
            else if(number == 2) {
                if(this.formData[`sleep${('0' + hourIndex).slice(-2) + '30'}Home`] != 1) {
                    this.formData[`sleep${('0' + hourIndex).slice(-2) + '30'}School`] = 1 - this.formData[`sleep${('0' + hourIndex).slice(-2) + '30'}School`];
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
            if(this.formData.temperatureTimeStd)
                requestData['temperature_time_std'] = moment(this.formData.temperatureTimeStd, 'h:mm:ss').format('HH:mm');
            this.setActionLoading();
            api.post('contact-book/child/' + this.child.id + '/school/0', null, requestData)
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
            if(!this.formData.weather) {
                this.errors.weather = this.$t('Please input weather');
                valid = false;
            }
            if(this.formData.temperatureStd && this.formData.temperatureStd < 0) {
                this.errors.temperatureStd = this.$t('Please input positive number');
                valid = false;
            }
            if(!this.formData.guardian) {
                this.errors.guardian = this.$t('Please input name');
                valid = false;
            }
            if(this.formData.guardian && this.formData.guardian.length > 20) {
                this.errors.guardian = this.$t('Please enter 20 characters or less');
                valid = false;
            }
            if(!this.formData.nurseName) {
                this.errors.nurseName = this.$t('Please input name');
                valid = false;
            }
            if(this.formData.nurseName && this.formData.nurseName.length > 20) {
                this.errors.nurseName = this.$t('Please enter 20 characters or less');
                valid = false;
            }
            if(!this.formData.pickUpPerson) {
                this.errors.pickUpPerson = this.$t('Please input name');
                valid = false;
            }
            if(this.formData.pickUpPerson && this.formData.pickUpPerson.length > 20) {
                this.errors.pickUpPerson = this.$t('Please enter 20 characters or less');
                valid = false;
            }
            if(this.formData.temperatureTimeStd && !validateHhMm(this.formData.temperatureTimeStd)) {
                this.errors.temperatureTimeStd = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.pickUpTime && !validateHhMm(this.formData.pickUpTime)) {
                this.errors.pickUpTime = this.$t('Invalid time format');
                valid = false;
            }
            this.hours.forEach(element => {
                if(this.formData[`temperature${('0' + element.time).slice(-2)}School`] && this.formData[`temperature${('0' + element.time).slice(-2)}School`] < 0) {
                    this.errors[`temperature${('0' + element.time).slice(-2)}School`] = this.$t('Please input positive number');
                    valid = false;
                }
            });
            this.hours.forEach(element => {
                if(this.formData[`meal${element.time}School`] && this.formData[`meal${element.time}School`].length > 50) {
                    this.errors[`meal${element.time}School`] = this.$t('Please enter 50 characters or less');
                    valid = false;
                }
            });
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
        },
        exportExcel() {
            const date = moment(this.selectedDate).format('YYYY-MM-DD');
            location.href = process.env.MIX_APP_BASE_URL + 'childcare-contact-book/excel/' + this.child.id + '/?date=' + date + '&token=' + LocalStorage.getToken();
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
