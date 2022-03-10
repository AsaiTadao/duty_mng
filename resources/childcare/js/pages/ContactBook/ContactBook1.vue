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
                                        <input type="text" class="form-control" style="max-width: 55%;" v-model="formData.pickUpPerson" :class="{'is-invalid': errors.pickUpPerson}" @change="dataChanged = true;errors.pickUpPerson = null;"/>
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
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealTime1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatMealStatus(formData.mealAmount1Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealMemo1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.mealTime2Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatMealStatus(formData.mealAmount2Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                    {{formData.mealMemo2Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.mealTime3Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatMealStatus(formData.mealAmount3Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.mealMemo3Home}}
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
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatMoodStatus(formData.mood1Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-l-border-2 py-2">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatMoodStatus(formData.mood2Home)}}
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
                                                    <div class="dark-blue text-center text-white white-lb-border-2 py-2 fixed-height-40">
                                                        前夜
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formatDefecationStatus(formData.defecation1Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.defecationCount1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-l-border-2 py-2 fixed-height-40">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatDefecationStatus(formData.defecation2Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.defecationCount2Home}}
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
                                                    {{formatSleepTime(formData.sleepStart1Home, formData.sleepEnd1Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                    {{formatSleepTime(formData.sleepStart2Home, formData.sleepEnd2Home)}}
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
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                    {{formatBathStatus(formData.bathingHome)}}
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
                                                        {{formData.temperatureTime1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime2Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime3Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature1Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature2Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature3Home)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature1Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime2Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature2Home)}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2 py-2 fixed-height-40">
                                                        {{formData.temperatureTime3Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formatTemperature(formData.temperature3Home)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="dark-blue text-center py-2 text-white">
                                                家庭での様子
                                            </div>
                                            <div class="light-blue p-4 mt-1" style="height: 300px;">
                                                {{formData.state0Home}}
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
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-bottom: 1px; padding-top: 1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.mealTime1School" :error="errors.mealTime1School" @input="dataChanged = true;errors.mealTime1School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="1" v-model="formData.mealAmount1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">完食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="2" v-model="formData.mealAmount1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">残食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="3" v-model="formData.mealAmount1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">おかわり</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="text" class="form-control" placeholder="メモ" v-model="formData.mealMemo1School" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-bottom: 1px; padding-top: 1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.mealTime2School" :error="errors.mealTime2School" @input="dataChanged = true;errors.mealTime2School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="1" v-model="formData.mealAmount2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">完食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="2" v-model="formData.mealAmount2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">残食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="3" v-model="formData.mealAmount2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">おかわり</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="text" class="form-control" placeholder="メモ" v-model="formData.mealMemo2School" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-bottom: 1px; padding-top: 1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.mealTime3School" :error="errors.mealTime3School" @input="dataChanged = true;errors.mealTime3School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="1" v-model="formData.mealAmount3School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">完食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="2" v-model="formData.mealAmount3School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">残食</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="3" v-model="formData.mealAmount3School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">おかわり</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="text" class="form-control" placeholder="メモ" v-model="formData.mealMemo3School" @change="dataChanged = true;"/>
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
                                                    <div class="dark-yellow text-center text-white white-lb-border-2 py-2">
                                                        午前
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="1" v-model="formData.mood1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="2" v-model="formData.mood1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">良い</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="3" v-model="formData.mood1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">悪い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-l-border-2 py-2">
                                                        午後
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="1" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="2" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">良い</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="3" v-model="formData.mood2School" @change="dataChanged = true;">
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
                                                    <div class="dark-yellow text-center text-white white-lb-border-2 py-2">
                                                        午前
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="1" v-model="formData.defecation1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="2" v-model="formData.defecation1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">軟</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="3" v-model="formData.defecation1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">固</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center px-2">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.defecationCount1School" :class="{'is-invalid' : errors.defecationCount1School}" @change="dataChanged = true; errors.defecationCount1School = null;">
                                                            <span v-if="errors.defecationCount1School" class="error invalid-feedback">
                                                                {{errors.defecationCount1School}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-l-border-2 py-2">
                                                        午後
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="1" v-model="formData.defecation2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="2" v-model="formData.defecation2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">軟</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="3" v-model="formData.defecation2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">固</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center px-2">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.defecationCount2School" :class="{'is-invalid' : errors.defecationCount2School}" @change="dataChanged = true; errors.defecationCount2School = null;">
                                                            <span v-if="errors.defecationCount2School" class="error invalid-feedback">
                                                                {{errors.defecationCount2School}}
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
                                                            <hour-minute-input v-model="formData.sleepStart1School" :error="errors.sleepStart1School" @input="dataChanged = true; errors.sleepStart1School = null;"/>
                                                            ~
                                                            <hour-minute-input v-model="formData.sleepEnd1School" :error="errors.sleepEnd1School" @input="dataChanged = true; errors.sleepEnd1School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.sleepStart2School" :error="errors.sleepStart2School" @input="dataChanged = true; errors.sleepStart2School = null;"/>
                                                            ~
                                                            <hour-minute-input v-model="formData.sleepEnd2School" :error="errors.sleepEnd2School" @input="dataChanged = true; errors.sleepEnd2School = null;"/>
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
                                                    沐浴
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2">
                                                        <div class="form-check text-center">
                                                            <input class="form-check-input" type="radio" name="radio8" :value="1" v-model="formData.bathingSchool" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-5">有り</label>
                                                            <input class="form-check-input" type="radio" name="radio8" :value="2" v-model="formData.bathingSchool" @change="dataChanged = true;">
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
                                                            <hour-minute-input v-model="formData.temperatureTime1School" :error="errors.temperatureTime1School" @input="dataChanged = true;errors.temperatureTime1School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime2School" :error="errors.temperatureTime2School" @input="dataChanged = true;errors.temperatureTime2School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime3School" :error="errors.temperatureTime3School" @input="dataChanged = true;errors.temperatureTime3School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.temperature1School}" v-model="formData.temperature1School" @change="dataChanged = true; errors.temperature1School = null;">
                                                            <span v-if="errors.temperature1School" class="error invalid-feedback">
                                                                {{errors.temperature1School}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0 is-invalid">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2 is-invalid" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.temperature2School}" v-model="formData.temperature2School" @change="dataChanged = true; errors.temperature2School = null;">
                                                            <span v-if="errors.temperature2School" class="error invalid-feedback">
                                                                {{errors.temperature2School}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0 is-invalid">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2 is-invalid" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.temperature3School}" v-model="formData.temperature3School" @change="dataChanged = true; errors.temperature3School = null;">
                                                            <span v-if="errors.temperature3School" class="error invalid-feedback">
                                                                {{errors.temperature3School}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0 is-invalid">℃</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime1School" :error="errors.temperatureTime1School" @input="dataChanged = true;errors.temperatureTime1School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.temperature1School}" v-model="formData.temperature1School" @change="dataChanged = true; errors.temperature1School = null;">
                                                            <span v-if="errors.temperature1School" class="error invalid-feedback">
                                                                {{errors.temperature1School}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0 is-invalid">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime2School" :error="errors.temperatureTime2School" @input="dataChanged = true;errors.temperatureTime2School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2 is-invalid" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.temperature2School}" v-model="formData.temperature2School" @change="dataChanged = true; errors.temperature2School = null;">
                                                            <span v-if="errors.temperature2School" class="error invalid-feedback">
                                                                {{errors.temperature2School}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0 is-invalid">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0 pr-1">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime3School" :error="errors.temperatureTime3School" @input="dataChanged = true;errors.temperatureTime3School = null;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2 is-invalid" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="60" :class="{'is-invalid' : errors.temperature3School}" v-model="formData.temperature3School" @change="dataChanged = true; errors.temperature3School = null;">
                                                            <span v-if="errors.temperature3School" class="error invalid-feedback">
                                                                {{errors.temperature3School}}
                                                            </span>
                                                        </div>
                                                        <label class="align-self-center mb-0 is-invalid">℃</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="dark-yellow text-center py-2 text-white">
                                                保育園での様子
                                            </div>
                                            <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                                <textarea class="form-control" style="height: 95%;" v-model="formData.state0School" @change="dataChanged = true;">

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
import { changeToHhMm, validateHhMm } from '../../helpers/datetime';
import LocalStorage from '../../helpers/localStorage';

const initialFormData = {
    date: new Date(),
    weather: '',
    mood: null,
    guardian: '',
    pickUpPerson: null,
    pickUpTime: null,
    mealTime1School: null,
    mealTime2School: null,
    mealTime3School: null,
    mealAmount1School: null,
    mealAmount2School: null,
    mealAmount3School: null,
    mealMemo1School: '',
    mealMemo2School: '',
    mealMemo3School: '',
    mood1School: null,
    mood2School: null,
    defecation1School: null,
    defecation2School: null,
    defecationCount1School: null,
    defecationCount2School: null,
    sleepStart1School: null,
    sleepEnd1School: null,
    sleepStart2School: null,
    sleepEnd2School: null,
    bathingSchool: null,
    temperatureTime1School: null,
    temperature1School: '',
    temperatureTime2School: null,
    temperature2School: '',
    temperatureTime3School: null,
    temperature3School: '',
    state0School: '',
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
            currentDate: new Date(),
            todayDate: "",
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

            if(this.formData.mealTime1School)
                requestData['meal_time_1_school'] = moment(this.formData.mealTime1School, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime2School)
                requestData['meal_time_2_school'] = moment(this.formData.mealTime2School, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime3School)
                requestData['meal_time_3_school'] = moment(this.formData.mealTime3School, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepStart1School)
                requestData['sleep_start_1_school'] = moment(this.formData.sleepStart1School, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepEnd1School)
                requestData['sleep_end_1_school'] = moment(this.formData.sleepEnd1School, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepStart2School)
                requestData['sleep_start_2_school'] = moment(this.formData.sleepStart2School, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepEnd2School)
                requestData['sleep_end_2_school'] = moment(this.formData.sleepEnd2School, 'h:mm:ss').format('HH:mm');

            if(this.formData.temperatureTime1School)
                requestData['temperature_time_1_school'] = moment(this.formData.temperatureTime1School, 'h:mm:ss').format('HH:mm');

            if(this.formData.temperatureTime2School)
                requestData['temperature_time_2_school'] = moment(this.formData.temperatureTime2School, 'h:mm:ss').format('HH:mm');

            if(this.formData.temperatureTime3School)
                requestData['temperature_time_3_school'] = moment(this.formData.temperatureTime3School, 'h:mm:ss').format('HH:mm');

            this.setActionLoading();
            api.post('contact-book/child/' + this.child.id + '/school/1', null, requestData)
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

            this.formData.pickUpTime = changeToHhMm(this.formData.pickUpTime);
            if(this.formData.pickUpTime && !validateHhMm(this.formData.pickUpTime)) {
                this.errors.pickUpTime = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.mealTime1School = changeToHhMm(this.formData.mealTime1School);
            if(this.formData.mealTime1School && !validateHhMm(this.formData.mealTime1School)) {
                this.errors.mealTime1School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.mealTime2School = changeToHhMm(this.formData.mealTime2School);
            if(this.formData.mealTime2School && !validateHhMm(this.formData.mealTime2School)) {
                this.errors.mealTime2School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.mealTime3School = changeToHhMm(this.formData.mealTime3School);
            if(this.formData.mealTime3School && !validateHhMm(this.formData.mealTime3School)) {
                this.errors.mealTime3School = this.$t('Invalid time format');
                valid = false;
            }
            console.log(this.formData.sleepStart1School);
            this.formData.sleepStart1School = changeToHhMm(this.formData.sleepStart1School);
            if(this.formData.sleepStart1School && !validateHhMm(this.formData.sleepStart1School)) {
                this.errors.sleepStart1School = this.$t('Invalid time format');
                valid = false;
            }
            // if(this.formData.sleepStart1School && this.formData.sleepEnd1School && this.formData.sleepStart1School > this.formData.sleepEnd1School) {
            //     this.errors.sleepStart1School = this.$t('start time must be earlier than end time');
            //     valid = false;
            // }
            // if(this.formData.sleepStart2School && this.formData.sleepEnd2School && this.formData.sleepStart2School > this.formData.sleepEnd2School) {
            //     this.errors.sleepStart2School = this.$t('start time must be earlier than end time');
            //     valid = false;
            // }
            this.formData.sleepEnd1School = changeToHhMm(this.formData.sleepEnd1School);
            if(this.formData.sleepEnd1School && !validateHhMm(this.formData.sleepEnd1School)) {
                this.errors.sleepEnd1School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.sleepStart2School = changeToHhMm(this.formData.sleepStart2School);
            if(this.formData.sleepStart2School && !validateHhMm(this.formData.sleepStart2School)) {
                this.errors.sleepStart2School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.sleepEnd2School = changeToHhMm(this.formData.sleepEnd2School);
            if(this.formData.sleepEnd2School && !validateHhMm(this.formData.sleepEnd2School)) {
                this.errors.sleepEnd2School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.temperatureTime1School = changeToHhMm(this.formData.temperatureTime1School);
            if(this.formData.temperatureTime1School && !validateHhMm(this.formData.temperatureTime1School)) {
                this.errors.temperatureTime1School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.temperatureTime2School = changeToHhMm(this.formData.temperatureTime2School);
            if(this.formData.temperatureTime2School && !validateHhMm(this.formData.temperatureTime2School)) {
                this.errors.temperatureTime2School = this.$t('Invalid time format');
                valid = false;
            }
            this.formData.temperatureTime3School = changeToHhMm(this.formData.temperatureTime3School);
            if(this.formData.temperatureTime3School && !validateHhMm(this.formData.temperatureTime3School)) {
                this.errors.temperatureTime3School = this.$t('Invalid time format');
                valid = false;
            }
            if(!this.formData.weather) {
                this.errors.weather = this.$t('Please input weather');
                valid = false;
            }
            if(this.formData.defecationCount1School && this.formData.defecationCount1School < 0) {
                this.errors.defecationCount1School =this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.defecationCount2School && this.formData.defecationCount2School < 0) {
                this.errors.defecationCount2School =this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.temperature1School && this.formData.temperature1School < 0) {
                this.errors.temperature1School = this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.temperature2School && this.formData.temperature2School < 0) {
                this.errors.temperature2School = this.$t('Please input positive number');
                valid = false;
            }
            if(this.formData.temperature3School && this.formData.temperature3School < 0) {
                this.errors.temperature3School = this.$t('Please input positive number');
                valid = false;
            }
            return valid;
        },
        initFormError() {
            this.errors = {
                pickUpTime: null,
                pickUpPerson: null,
                guardian: null,
                nurseName: null,
                mealTime1School: null,
                mealTime2School: null,
                mealTime3School: null,
                sleepStart1School: null,
                sleepEnd1School: null,
                sleepStart2School: null,
                sleepEnd2School: null,
                temperature1School: null,
                temperature2School: null,
                temperature3School: null,
                temperatureTime1School: null,
                temperatureTime2School: null,
                temperatureTime3School: null,
                weather: null,
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
        formatBathStatus(status) {
            if(status == 1) {
                return '有り';
            } else if(status == 2) {
                return '無し';
            } else {
                return '';
            }
        },
        formatStatus(status) {
            if(status == 1) {
                return '普通';
            } else if(status == 2) {
                return '少ない';
            } else if(status == 3) {
                return '多い';
            } else {
                return '';
            }
        },
        formatDefecationStatus(status) {
            if(status == 1) {
                return '普';
            } else if(status == 2) {
                return '軟';
            } else if(status == 3) {
                return '固';
            } else {
                return '';
            }
        },
        formatMoodStatus(status) {
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
        isMobile() {
            if(window.innerWidth < 768) {
                return true;
            } else {
                return false;
            }
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
