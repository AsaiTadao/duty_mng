<template>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="card-title mb-0 pr-5">{{ currentOfficeName }}</h5>
                                </div>
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <div class="d-flex align-items-center p-0">
                                        <datepicker
                                        :language="ja"
                                        :format="customFormatter"
                                        ref="programaticOpen"
                                        :placeholder="todayDate"
                                        @selected="getContact"
                                        v-model="selectedDate"
                                        :disabled-dates="disabledDates">
                                        </datepicker>
                                        <button type="button" class="btn btn-sm btn-outline mx-0" @click="openDatePicker()">
                                        <i class="fas fa-calendar-alt fa-2x"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex align-items-center px-3">
                                        <div for="weatherStauts" class="form-label mr-2">天気:</div>
                                        <input type="text" class="form-control fixed-width-80 px-0" value="晴れ" id="weatherStauts" :class="{'is-invalid' : errors.weather}" v-model="formData.weather" @change="dataChanged = true; errors.weather = null;inputError = false;"/>
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
                                    <input type="text" class="form-control" id="parentname" style="width: calc(90% - 130px);" v-model="formData.guardian" :class="{'is-invalid': errors.guardian}" @change="dataChanged = true; errors.guardian = null;inputError = false;"/>
                                    <span v-if="errors.guardian" class="error invalid-feedback">
                                        {{errors.guardian}}
                                    </span>
                                </div>
                                <div class="col-md-5 col-12 align-items-center mb-2" style="display:flex;">
                                    <label for="mindername" style="min-width: 80px; margin-bottom:0px;">保育士名：</label>
                                    <div>{{formData.nurseName}}</div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:15px; padding-right:15px;">
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2 fixed-height-40">
                                        お迎え予定
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center d-flex justify-content-center" style="padding-top:1px; padding-bottom:1px;">
                                       <hour-minute-input v-model="formData.pickUpTime" @input="dataChanged = true; errors.pickUpTime = null;" :error="errors.pickUpTime"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2 fixed-height-40">
                                        お迎えの方
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink d-flex justify-content-center fixed-height-40" style="padding-top:1px; padding-bottom:1px;">
                                        <input type="text" class="form-control" style="max-width: 55%;" v-model="formData.pickUpPerson" :class="{'is-invalid': errors.pickUpPerson}" @change="dataChanged = true;errors.pickUpPerson = null;inputError = false;"/>
                                        <span v-if="errors.pickUpPerson" class="error invalid-feedback">
                                            {{errors.pickUpPerson}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-6 col-12">
                                    <div class="dark-blue text-center py-2 text-white mb-1 fixed-height-40">
                                        家庭より
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    食事
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-5 col-12 pr-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-bottom: 1px; padding-top: 1px;">
                                                        <div class="text-center d-flex justify-content-center meal-time-input">
                                                            <hour-minute-input v-model="formData.mealTime1Home" :error="errors.mealTime1Home" @input="dataChanged = true; errors.mealTime1Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="1" v-model="formData.mealAmount1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">完食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="2" v-model="formData.mealAmount1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">残食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="3" v-model="formData.mealAmount1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">おかわり</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="text" class="form-control" placeholder="メモ" v-model="formData.mealMemo1Home" :class="{'is-invalid' : errors.mealMemo1Home}" @change="dataChanged = true; errors.mealMemo1Home = null;inputError = false;"/>
                                                            <span v-if="errors.mealMemo1Home" class="error invalid-feedback">
                                                                {{errors.mealMemo1Home}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12 pr-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-bottom: 1px; padding-top: 1px;">
                                                        <div class="text-center d-flex justify-content-center meal-time-input">
                                                            <hour-minute-input v-model="formData.mealTime2Home" :error="errors.mealTime2Home" @input="dataChanged = true; errors.mealTime2Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="1" v-model="formData.mealAmount2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">完食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="2" v-model="formData.mealAmount2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">残食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="3" v-model="formData.mealAmount2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">おかわり</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="text" class="form-control" placeholder="メモ" v-model="formData.mealMemo2Home" :class="{'is-invalid' : errors.mealMemo2Home}" @change="dataChanged = true; errors.mealMemo2Home = null;inputError = false;"/>
                                                            <span v-if="errors.mealMemo2Home" class="error invalid-feedback">
                                                                {{errors.mealMemo2Home}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12 pr-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-bottom: 1px; padding-top: 1px;">
                                                        <div class="text-center d-flex justify-content-center meal-time-input">
                                                            <hour-minute-input v-model="formData.mealTime3Home" :error="errors.mealTime3Home" @input="dataChanged = true; errors.mealTime3Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="1" v-model="formData.mealAmount3Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">完食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="2" v-model="formData.mealAmount3Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">残食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="3" v-model="formData.mealAmount3Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">おかわり</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="text" class="form-control" placeholder="メモ" v-model="formData.mealMemo3Home" :class="{'is-invalid' : errors.mealMemo3Home}" @change="dataChanged = true; errors.mealMemo3Home = null;inputError = false;"/>
                                                            <span v-if="errors.mealMemo3Home" class="error invalid-feedback">
                                                                {{errors.mealMemo3Home}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    機嫌
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-lb-border-2 py-2">
                                                        前夜
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="1" v-model="formData.mood1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="2" v-model="formData.mood1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">良い</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="3" v-model="formData.mood1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">悪い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-l-border-2 py-2">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="1" v-model="formData.mood2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="2" v-model="formData.mood2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">良い</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="3" v-model="formData.mood2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">悪い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    排便
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-lb-border-2 py-2">
                                                        前夜
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="1" v-model="formData.defecation1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="2" v-model="formData.defecation1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">軟い</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="3" v-model="formData.defecation1Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">固い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center px-2">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.defecationCount1Home" :class="{'is-invalid' : errors.defecationCount1Home}" @change="dataChanged = true; errors.defecationCount1Home = null;inputError = false;">
                                                            <span v-if="errors.defecationCount1Home" class="error invalid-feedback">
                                                                {{errors.defecationCount1Home}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-l-border-2 py-2">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="1" v-model="formData.defecation2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="2" v-model="formData.defecation2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">軟い</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="3" v-model="formData.defecation2Home" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">固い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center px-2">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.defecationCount2Home" :class="{'is-invalid' : errors.defecationCount2Home}" @change="dataChanged = true; errors.defecationCount2Home = null;">
                                                            <span v-if="errors.defecationCount2Home" class="error invalid-feedback">
                                                                {{errors.defecationCount2Home}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    睡眠
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.sleepStart1Home" :error="errors.sleepStart1Home" @input="dataChanged = true; errors.sleepStart1Home = null;inputError = false;"/>
                                                            ~
                                                            <hour-minute-input v-model="formData.sleepEnd1Home" :error="errors.sleepEnd1Home" @input="dataChanged = true; errors.sleepEnd1Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.sleepStart2Home" :error="errors.sleepStart2Home" @input="dataChanged = true; errors.sleepStart2Home = null;inputError = false;"/>
                                                            ~
                                                            <hour-minute-input v-model="formData.sleepEnd2Home" :error="errors.sleepEnd2Home" @input="dataChanged = true; errors.sleepEnd2Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center fixed-height-40">
                                                <label class="mb-0">
                                                    入浴
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2">
                                                        <div class="form-check text-center">
                                                            <input class="form-check-input" type="radio" name="radio8" :value="1" v-model="formData.bathingHome" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-5">有り</label>
                                                            <input class="form-check-input" type="radio" name="radio8" :value="2" v-model="formData.bathingHome" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-5">無し</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    検温
                                                </label>
                                            </div>
                                        </div>
                                        <div v-if="!isMobile()" class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime1Home" :error="errors.temperatureTime1Home" @input="dataChanged = true; errors.temperatureTime1Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime2Home" :error="errors.temperatureTime2Home" @input="dataChanged = true; errors.temperatureTime2Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime3Home" :error="errors.temperatureTime3Home" @input="dataChanged = true; errors.temperatureTime3Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="32" max="42" v-model="formData.temperature1Home" :class="{'is-invalid': errors.temperature1Home}" @change="dataChanged = true; errors.temperature1Home = null;inputError = false;">
                                                            <span v-if="errors.temperature1Home" class="error invalid-feedback">
                                                                {{errors.temperature1Home}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="32" max="42" v-model="formData.temperature2Home" :class="{'is-invalid': errors.temperature2Home}" @change="dataChanged = true; errors.temperature2Home = null;inputError = false;">
                                                            <span v-if="errors.temperature2Home" class="error invalid-feedback">
                                                                {{errors.temperature2Home}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="32" max="42" v-model="formData.temperature3Home" :class="{'is-invalid': errors.temperature3Home}" @change="dataChanged = true; errors.temperature3Home = null;inputError = false;">
                                                            <span v-if="errors.temperature3Home" class="error invalid-feedback">
                                                                {{errors.temperature3Home}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime1Home" :error="errors.temperatureTime1Home" @input="dataChanged = true; errors.temperatureTime1Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="32" max="42" v-model="formData.temperature1Home" :class="{'is-invalid': errors.temperature1Home}" @change="dataChanged = true; errors.temperature1Home = null;inputError = false;">
                                                            <span v-if="errors.temperature1Home" class="error invalid-feedback">
                                                                {{errors.temperature1Home}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime2Home" :error="errors.temperatureTime2Home" @input="dataChanged = true; errors.temperatureTime2Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="32" max="42" v-model="formData.temperature2Home" :class="{'is-invalid': errors.temperature2Home}" @change="dataChanged = true; errors.temperature2Home = null;inputError = false;">
                                                            <span v-if="errors.temperature2Home" class="error invalid-feedback">
                                                                {{errors.temperature2Home}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0 pr-1">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime3Home" :error="errors.temperatureTime3Home" @input="dataChanged = true; errors.temperatureTime3Home = null;inputError = false;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="32" max="42" v-model="formData.temperature3Home" :class="{'is-invalid': errors.temperature3Home}" @change="dataChanged = true; errors.temperature3Home = null;inputError = false;">
                                                            <span v-if="errors.temperature3Home" class="error invalid-feedback">
                                                                {{errors.temperature3Home}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="dark-blue text-center py-2 text-white">
                                                家庭での様子・連絡事項
                                            </div>
                                            <div class="light-blue p-4 mt-1" style="height: 300px;">
                                                <textarea class="form-control" style="height: 95%;" v-model="formData.state0Home" @change="dataChanged = true;">

                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="dark-yellow text-center py-2 text-white mb-1">
                                        保育園より
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    食事
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-7 col-12 pr-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealTime1School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatMealStatus(formData.mealAmount1School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealMemo1School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pr-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealTime2School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatMealStatus(formData.mealAmount2School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                    {{formData.mealMemo2School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pr-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealTime3School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatMealStatus(formData.mealAmount3School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.mealMemo3School}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    機嫌
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-lb-border-2 py-2">
                                                        午前
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatStatus(formData.mood1School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-l-border-2 py-2">
                                                        午後
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                    {{formatStatus(formData.mood2School)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    排便
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-lb-border-2 py-2 fixed-height-40">
                                                        午前
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatDefecationStatus(formData.defecation1School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.defecationCount1School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-l-border-2 py-2 fixed-height-40">
                                                        午後
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatDefecationStatus(formData.defecation2School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.defecationCount2School}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    睡眠
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatSleepTime(formData.sleepStart1School, formData.sleepEnd1School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatSleepTime(formData.sleepStart2School, formData.sleepEnd2School)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center fixed-height-40">
                                                <label class="mb-0">
                                                    沐浴
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                    {{formatBathStatus(formData.bathingSchool)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    検温
                                                </label>
                                            </div>
                                        </div>
                                        <div v-if="!isMobile()" class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime1School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime2School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime3School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature1School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature2School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature3School)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime1School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature1School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime2School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature2School)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0 pr-1">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime3School}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature3School)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="dark-yellow text-center py-2 text-white">
                                                保育園での様子・連絡事項
                                            </div>
                                            <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                                {{formData.state0School}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right d-flex align-items-center mt-2" :class="{'is-invalid': inputError}">
                                        <button class="btn btn-primary float-right mr-2" @click="saveContact">登録</button>
                                    </div>
                                    <div v-if="inputError" class="error invalid-feedback text-right" style="margin-top: 60px;">
                                        {{$t("Input error")}}
                                    </div>
                                </div>
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
import { validateHhMm, changeToHhMm } from '../../helpers/datetime';

const initialFormData = {
    date: new Date(),
    weather: '',
    mood: null,
    guardian: '',
    pickUpPerson: null,
    pickUpTime: null,
    mealTime1Home: null,
    mealTime2Home: null,
    mealTime3Home: null,
    mealAmount1Home: null,
    mealAmount2Home: null,
    mealAmount3Home: null,
    mealMemo1Home: '',
    mealMemo2Home: '',
    mealMemo3Home: '',
    mood1Home: null,
    mood2Home: null,
    defecation1Home: null,
    defecation2Home: null,
    defecationCount1Home: null,
    defecationCount2Home: null,
    sleepStart1Home: null,
    sleepEnd1Home: null,
    sleepStart2Home: null,
    sleepEnd2Home: null,
    bathingHome: null,
    temperatureTime1Home: null,
    temperature1Home: '',
    temperatureTime2Home: null,
    temperature2Home: '',
    temperatureTime3Home: null,
    temperature3Home: '',
    state0Home: '',
}

export default {
    components: {
        Datepicker,
        HourMinuteInput
    },
    mixins: [actionLoading],
    computed: {
        ...mapState({
            currentOfficeName: state =>  {
                if (state.session.info.office) return state.session.info.office.name;
                return '';
            }
        })
    },
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
            inputError: false,
            currentDate: new Date(),
            todayDate: "",
            disabledDates: {
                to: null,
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
        saveContact() {
            if(this.actionLoading) return;
            if (!this.validate()) return;
            const requestData = this.formData;
            requestData['date'] = moment(this.selectedDate).format('YYYY-MM-DD');
            if(this.formData.pickUpTime)
                requestData['pick_up_time'] = moment(this.formData.pickUpTime, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime1Home)
                requestData['meal_time_1_home'] = moment(this.formData.mealTime1Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime2Home)
                requestData['meal_time_2_home'] = moment(this.formData.mealTime2Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime3Home)
                requestData['meal_time_3_home'] = moment(this.formData.mealTime3Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepStart1Home)
                requestData['sleep_start_1_home'] = moment(this.formData.sleepStart1Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepEnd1Home)
                requestData['sleep_end_1_home'] = moment(this.formData.sleepEnd1Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepStart2Home)
                requestData['sleep_start_2_home'] = moment(this.formData.sleepStart2Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepEnd2Home)
                requestData['sleep_end_2_home'] = moment(this.formData.sleepEnd2Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.temperatureTime1Home)
                requestData['temperature_time_1_home'] = moment(this.formData.temperatureTime1Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.temperatureTime2Home)
                requestData['temperature_time_2_home'] = moment(this.formData.temperatureTime2Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.temperatureTime3Home)
                requestData['temperature_time_3_home'] = moment(this.formData.temperatureTime3Home, 'h:mm:ss').format('HH:mm');

            this.setActionLoading();
            api.post('contact-book/child/' + this.child.id + '/home/1', null, requestData)
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
            // if(!this.formData.weather) {
            //     this.errors.weather = this.$t('Please input weather');
            //     valid = false;
            // }
            if(this.formData.weather && this.formData.weather.length > 10) {
                this.errors.weather = this.$t('Please enter 10 characters or less');
                valid = false;
            }
            if(!this.formData.guardian) {
                this.errors.guardian = this.$t('Please input name');
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
            this.formData.pickUpTime = changeToHhMm(this.formData.pickUpTime);

            if(!this.formData.pickUpTime) {
                this.errors.pickUpTime = this.$t('Please input time');
                valid = false;
            }
            if(this.formData.pickUpTime && !validateHhMm(this.formData.pickUpTime)) {
                this.errors.pickUpTime = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.mealTime1Home = changeToHhMm(this.formData.mealTime1Home);
            if(this.formData.mealTime1Home && !validateHhMm(this.formData.mealTime1Home)) {
                this.errors.mealTime1Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.mealTime2Home = changeToHhMm(this.formData.mealTime2Home);
            if(this.formData.mealTime2Home && !validateHhMm(this.formData.mealTime2Home)) {
                this.errors.mealTime2Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.mealTime3Home = changeToHhMm(this.formData.mealTime3Home);
            if(this.formData.mealTime3Home && !validateHhMm(this.formData.mealTime3Home)) {
                this.errors.mealTime3Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.mealMemo1Home && this.formData.mealMemo1Home.length > 50) {
                this.errors.mealMemo1Home = this.$t("Please enter 50 characters or less");
                valid = false;
            }
            if(this.formData.mealMemo2Home && this.formData.mealMemo2Home.length > 50) {
                this.errors.mealMemo2Home = this.$t("Please enter 50 characters or less");
                valid = false;
            }
            if(this.formData.mealMemo3Home && this.formData.mealMemo3Home.length > 50) {
                this.errors.mealMemo3Home = this.$t("Please enter 50 characters or less");
                valid = false;
            }
            this.formData.sleepStart1Home = changeToHhMm(this.formData.sleepStart1Home);
            if(this.formData.sleepStart1Home && !validateHhMm(this.formData.sleepStart1Home)) {
                this.errors.sleepStart1Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.sleepEnd1Home = changeToHhMm(this.formData.sleepEnd1Home);
            if(this.formData.sleepEnd1Home && !validateHhMm(this.formData.sleepEnd1Home)) {
                this.errors.sleepEnd1Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.sleepStart2Home = changeToHhMm(this.formData.sleepStart2Home);
            if(this.formData.sleepStart2Home && !validateHhMm(this.formData.sleepStart2Home)) {
                this.errors.sleepStart2Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.sleepEnd2Home = changeToHhMm(this.formData.sleepEnd2Home);
            if(this.formData.sleepEnd2Home && !validateHhMm(this.formData.sleepEnd2Home)) {
                this.errors.sleepEnd2Home = this.$t('Invalid time format');
                valid = false;
            }
            // if(this.formData.sleepStart1Home && this.formData.sleepEnd1Home && this.formData.sleepStart1Home > this.formData.sleepEnd1Home) {
            //     this.errors.sleepStart1Home = this.$t('start time must be earlier than end time');
            //     valid = false;
            // }
            // if(this.formData.sleepStart2Home && this.formData.sleepEnd2Home && this.formData.sleepStart2Home > this.formData.sleepEnd2Home) {
            //     this.errors.sleepStart2Home = this.$t('start time must be earlier than end time');
            //     valid = false;
            // }
            this.formData.temperatureTime1Home = changeToHhMm(this.formData.temperatureTime1Home);
            if(this.formData.temperatureTime1Home && !validateHhMm(this.formData.temperatureTime1Home)) {
                this.errors.temperatureTime1Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.temperatureTime2Home = changeToHhMm(this.formData.temperatureTime2Home);
            if(this.formData.temperatureTime2Home && !validateHhMm(this.formData.temperatureTime2Home)) {
                this.errors.temperatureTime2Home = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.temperatureTime3Home = changeToHhMm(this.formData.temperatureTime3Home);
            if(this.formData.temperatureTime3Home && !validateHhMm(this.formData.temperatureTime3Home)) {
                this.errors.temperatureTime3Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.defecationCount1Home && this.formData.defecationCount1Home < 0) {
                this.errors.defecationCount1Home =this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.defecationCount2Home && this.formData.defecationCount2Home < 0) {
                this.errors.defecationCount2Home =this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.temperature1Home && this.formData.temperature1Home < 0) {
                this.errors.temperature1Home = this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.temperature2Home && this.formData.temperature2Home < 0) {
                this.errors.temperature2Home = this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.temperature3Home && this.formData.temperature3Home < 0) {
                this.errors.temperature3Home = this.$t('Please input positive number');
                valid = false;
            }
            this.inputError = !valid;
            return valid;
        },
        initFormError() {
            this.errors = {
                weather:null,
                pickUpPerson: null,
                pickUpTime: null,
                mealTime1Home: null,
                mealTime2Home: null,
                mealTime3Home: null,
                mealMemo1Home: null,
                mealMemo2Home: null,
                mealMemo3Home: null,
                sleepStart1Home: null,
                sleepEnd1Home: null,
                sleepStart2Home: null,
                sleepEnd2Home: null,
                temperature1Home: null,
                temperature2Home: null,
                temperature3Home: null,
                temperatureTime1Home: null,
                temperatureTime2Home: null,
                temperatureTime3Home: null,
                defecationCount1School: null,
                defecationCount2School: null
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
        loadAttends(date){
            //TODO: axios.get
            this.attends = [
                {
                    date: new Date('2021/09/01'),
                },
            ];
        },
        loadRequests(date){
            //TODO: axios.get
            this.requests = {

            };
        },
        updateTable(date){
            this.currentDate = date;
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDate();
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
            for(let day = firstDay; day <= lastDay; day++) {
                this.days.push(new Date(date.getFullYear(), date.getMonth(), day));
            }

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
        formatSleepTime(sleepTimeStart, sleepTimeEnd) {
            if(sleepTimeStart && sleepTimeEnd) {
                return sleepTimeStart + "~" + sleepTimeEnd;
            } else {
                return '';
            }
        },
        formatTemperature(temperature){
            if(temperature) {
                return temperature + "℃";
            } else {
                return '';
            }
        },
        formatStatus(status){
            if(status == 1) {
                return '普通';
            } else if(status == 2) {
                return '良い';
            } else if(status == 3) {
                return '悪い';
            } else {
                return '';
            }
        },
        formatMealStatus(status) {
            if(status == 1) {
                return '完食';
            } else if(status == 2) {
                return '残食';
            } else if(status == 3) {
                return 'おかわり';
            } else {
                return '';
            }
        },
        formatBathStatus(status) {
            if(status == 1) {
                return '有り';
            } else if(status == 2) {
                return '無し';
            } else {
                return '';
            }
        },
        formatDefecationStatus(status) {
            if(status == 1) {
                return '普い';
            } else if(status == 2) {
                return '軟い';
            } else if(status == 3) {
                return '固い';
            } else {
                return '';
            }
        },
        isMobile() {
            if(window.innerWidth < 768) {
                return true;
            } else {
                return false;
            }
        },
    },
    created() {

    },
    mounted() {
        this.todayDate = this.getCurrentDate().toString();
        this.selectedDate = this.date;
        this.convertToFormData();
        this.initFormError();
        if(this.child.admissionDate) {
            this.disabledDates = {to: moment(this.child.admissionDate).subtract(1, "days").toDate()};
        }
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
    .hour-minute-input > input {
        padding: 2px!important;
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
