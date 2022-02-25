<template>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h5 class="card-title mb-0 pr-5">{{ currentOfficeName }}</h5>
                                    <div class="mb-0 px-3">ー連絡帳ー</div>
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
                                    <div class="d-flex align-items-center px-3">
                                        <div for="weatherStauts" class="form-label mr-2">天気</div>
                                        <input type="text" class="form-control fixed-width-80 px-0" value="晴れ" id="weatherStauts" v-model="formData.weather" @change="dataChanged = true;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-4 col-sm-12 align-self-center">
                                    記入者 保護者様名：山田　三越
                                </div>
                                <div class="col-md-3 col-sm-10 align-items-center" style="display:flex;">
                                    <label for="mindername" style="min-width: 80px; margin-bottom:0px;">保育士名：</label>
                                    <div>{{formData.nurseName}}</div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:15px; padding-right:15px;">
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2 fixed-height-40">
                                        お迎え時間
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center py-2 fixed-height-40">
                                        {{formData.pickUpTime}}
                                    </div>
                                </div>
                                <div class="col-md-2 col-4" style="padding:1px;">
                                    <div class="dark-pink text-center text-white py-2 fixed-height-40">
                                        お迎えの方
                                    </div>
                                </div>
                                <div class="col-md-4 col-8" style="padding:1px;">
                                    <div class="light-pink text-center py-2 fixed-height-40">
                                        {{formData.pickUpPerson}}
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
                                                        {{formData.mealAmount1Home}}
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
                                                    {{formData.mealAmount2Home}}
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
                                                        {{formData.mealAmount3Home}}
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
                                                        {{formData.mood1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-blue text-center text-white white-l-border-2 py-2">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                    {{formData.mood2Home}}
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
                                                        {{formData.defecationCount1Home}}
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
                                                        {{formData.defecationCount2Home}}
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
                                                    <div class="light-brown text-center white-lb-border-2 py-2">
                                                    {{formData.sleepStart1Home}} ~ {{formData.sleepEnd1Home}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2">
                                                    {{formData.sleepStart2Home}} ~ {{formData.sleepEnd2Home}}
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
                                                    {{formData.bathingHome}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-1 col-2 pr-0">
                                            <div class="dark-brown h-100 text-center d-flex justify-content-center align-items-center">
                                                <label>
                                                    気温
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
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
                                                        {{formData.temperature1Home}}℃
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.temperature2Home}}℃
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2 py-2 fixed-height-40">
                                                        {{formData.temperature3Home}}℃
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
                                                {{formData.state1Home}}
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
                                                            <hour-minute-input v-model="formData.mealTime1School" :error="errors.mealTime1School" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="1" v-model="formData.mealAmount1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="2" v-model="formData.mealAmount1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio1" :value="3" v-model="formData.mealAmount1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
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
                                                            <hour-minute-input v-model="formData.mealTime2School" :error="errors.mealTime2School" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="1" v-model="formData.mealAmount2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="2" v-model="formData.mealAmount2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio2" :value="3" v-model="formData.mealAmount2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
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
                                                            <hour-minute-input v-model="formData.mealTime3School" :error="errors.mealTime3School" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="1" v-model="formData.mealAmount3School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="2" v-model="formData.mealAmount3School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio3" :value="3" v-model="formData.mealAmount3School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
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
                                                        前夜
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="1" v-model="formData.mood1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="2" v-model="formData.mood1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio4" :value="3" v-model="formData.mood1School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-l-border-2 py-2">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="1" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="2" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio5" :value="3" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
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
                                                        前夜
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="1" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="2" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio6" :value="3" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.defecationCount1School" @change="dataChanged = true;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 px-md-0 pl-0">
                                                    <div class="dark-yellow text-center text-white white-l-border-2 py-2">
                                                        今朝
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-l-border-2">
                                                        <div class="d-flex justify-content-center py-2">
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="1" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">普通</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="2" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">少ない</label>
                                                            <input class="mr-0 align-self-center" type="radio" name="radio7" :value="3" v-model="formData.mood2School" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-2">多い</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center px-2">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.defecationCount2School" @change="dataChanged = true;">
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
                                                            <hour-minute-input v-model="formData.sleepStart1School" :error="errors.sleepStart1School" @change="dataChanged = true;"/>
                                                            ~
                                                            <hour-minute-input v-model="formData.sleepEnd1School" :error="errors.sleepEnd1School" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 pl-0">
                                                    <div class="light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.sleepStart2School" :error="errors.sleepStart2School" @change="dataChanged = true;"/>
                                                            ~
                                                            <hour-minute-input v-model="formData.sleepEnd2School" :error="errors.sleepEnd2School" @change="dataChanged = true;"/>
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
                                                            <input class="form-check-input" type="radio" name="radio8" :value="1" v-model="formData.bathingSchool" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-5">普通</label>
                                                            <input class="form-check-input" type="radio" name="radio8" :value="2" v-model="formData.bathingSchool" @change="dataChanged = true;">
                                                            <label class="form-check-label mr-5">少ない</label>
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
                                                    気温
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-10">
                                            <div class="row">
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime1Home" :error="errors.temperatureTime1Home" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime2Home" :error="errors.temperatureTime2Home" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="light-brown text-center white-lb-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <hour-minute-input v-model="formData.temperatureTime3Home" :error="errors.temperatureTime3Home" @change="dataChanged = true;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.temperature1Home" @change="dataChanged = true;">
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 px-md-0 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.temperature2Home" @change="dataChanged = true;">
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 pl-0">
                                                    <div class="d-flex justify-content-center light-brown text-center white-l-border-2" style="padding-top:1px; padding-bottom:1px;">
                                                        <div class="text-center d-flex justify-content-center">
                                                            <input type="number" class="form-control" min="0" max="24" v-model="formData.temperature3Home" @change="dataChanged = true;">
                                                        </div>
                                                        <label class="align-self-center mb-0">℃</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="dark-yellow text-center py-2 text-white">
                                                <textarea class="form-control" style="height: 95%;" v-model="formData.state1Home" @change="dataChanged = true;">

                                                </textarea>
                                            </div>
                                            <div class="light-yellow p-4 mt-1" style="height: 300px;">
                                                保育園での様子
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right d-flex align-items-center mt-2">
                                        <button class="btn btn-primary float-right mr-2" @click="saveContact">登録</button>
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
import { validateHhMm } from '../../helpers/datetime';

const initialFormData = {
    date: new Date(),
    weather: '',
    mood: null,
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
            else
                requestData['pick_up_time'] = moment().format('HH:mm');

            if(this.formData.mealTime1Home)
                requestData['meal_time_1_home'] = moment(this.formData.mealTime1Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime2Home)
                requestData['meal_time_2_home'] = moment(this.formData.mealTime2Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.mealTime3Home)
                requestData['meal_time_3_home'] = moment(this.formData.mealTime3Home, 'h:mm:ss').format('HH:mm');

            if(this.formData.sleepStart1Home)
                requestData['sleep_start_1_home'] = moment(this.formData.pickUpTime, 'h:mm:ss').format('HH:mm');

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
            if(this.formData.mealTime1Home && !validateHhMm(this.formData.mealTime1Home)) {
                this.errors.mealTime1Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.mealTime2Home && !validateHhMm(this.formData.mealTime2Home)) {
                this.errors.mealTime2Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.mealTime3Home && !validateHhMm(this.formData.mealTime3Home)) {
                this.errors.mealTime3Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.sleepStart1Home && !validateHhMm(this.formData.sleepStart1Home)) {
                this.errors.sleepStart1Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.sleepEnd1Home && !validateHhMm(this.formData.sleepEnd1Home)) {
                this.errors.sleepEnd1Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.sleepStart2Home && !validateHhMm(this.formData.sleepStart2Home)) {
                this.errors.sleepStart2Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.sleepEnd2Home && !validateHhMm(this.formData.sleepEnd2Home)) {
                this.errors.sleepEnd2Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.temperatureTime1Home && !validateHhMm(this.formData.temperatureTime1Home)) {
                this.errors.temperatureTime1Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.temperatureTime2Home && !validateHhMm(this.formData.temperatureTime2Home)) {
                this.errors.temperatureTime2Home = this.$t('Invalid time format');
                valid = false;
            }
            if(this.formData.temperatureTime3Home && !validateHhMm(this.formData.temperatureTime3Home)) {
                this.errors.temperatureTime3Home = this.$t('Invalid time format');
                valid = false;
            }
            return valid;
        },
        initFormError() {
            this.errors = {
                mealTime1Home: null,
                mealTime2Home: null,
                mealTime3Home: null,
                sleepStart1Home: null,
                sleepEnd1Home: null,
                sleepStart2Home: null,
                sleepEnd2Home: null,
                temperatureTime1Home: null,
                temperatureTime2Home: null,
                temperatureTime3Home: null,
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
