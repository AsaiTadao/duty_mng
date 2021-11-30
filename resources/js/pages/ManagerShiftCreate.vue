<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">ラテラル保育園</h3>
                            <div>
                                <table class="table table-bordered table-black-bordered mb-0 ml-5">
                                    <thead class="text-center">
                                        <tr>
                                            <th colspan="2" class="padding-1px">所定労働</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td class="padding-1px">日数</td>
                                            <td class="padding-1px">20日</td>
                                        </tr>
                                        <tr>
                                            <td class="padding-1px">時間</td>
                                            <td class="padding-1px">160時間</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-tools calendar-center flex-grow-1">
                                <button type="button" class="btn btn-sm btn-outline" @click="getResults(getPrevMonthDate())">
                                    <i class="fas fa-caret-left fa-2x"></i>
                                </button>
                                <div class="mx-2">{{displayDate}}</div>
                                <button type="button" class="btn btn-sm btn-outline-primary mx-2" @click="getResults(getThisMonthDate())">
                                    今月
                                </button>
                                <button type="button" class="btn btn-sm btn-outline" @click="getResults(getNextMonthDate())">
                                    <i class="fas fa-caret-right fa-2x"></i>
                                </button>
                                <div class="form-group mx-4 mb-0">
                                    <select class="form-control">
                                        <option>ラテラル保育園</option>
                                        <option>ラテラルキッズ本社</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary float-right mt-2">コピーして作成</button>
                        </div>
                        <div class="card-body">
                        <div class="p-0 overflow-scroll-x">
                            <table class="table table-bordered shifttable-bordered table-hover w-2500-px">
                                <thead class="text-center">
                                    <tr class="light-green">
                                        <th width="4%" class="align-middle shift-th-x">日付</th>
                                        <th v-for="day in days" :key="day.getDate()" class="align-middle">
                                            <a href="#" @click="openDayCalendar()">
                                                {{day.getDate()}}日
                                            </a>
                                        </th>
                                        <th v-if="days.length === 30">
                                            <a href="#" @click="openDayCalendar()">
                                                31日
                                            </a>
                                        </th>
                                        <th class="align-middle heavy-green" rowspan="2">勤務予定<br>日数</th>
                                        <th class="align-middle heavy-green" rowspan="2">実働予定<br>時間</th>
                                    </tr>
                                    <tr class="light-green">
                                        <th class="align-middle shift-th-x">曜日</th>
                                        <th v-for="day in days" :key="day.getDate()" class="align-middle">
                                            <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                            <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                            <div v-else>{{day|formatWeek}}</div>
                                        </th>
                                        <th v-if="days.length === 30">
                                            <div>月</div>
                                        </th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center">
                                        <tr>
                                          <td class="shift-fix-x">阿部　一子</td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            18
                                          </td>
                                          <td>
                                            148
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="shift-fix-x">伊藤　二子</td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            16
                                          </td>
                                          <td>
                                            128
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="shift-fix-x">上野　三子</td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                休
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                正-A
                                            </a>
                                          </td>
                                          <td>
                                            20
                                          </td>
                                          <td>
                                            160
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="shift-fix-x">遠藤　四子</td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                <i class="fa fa-edit black"></i>
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                短-A
                                            </a>
                                          </td>
                                          <td>
                                            12
                                          </td>
                                          <td>
                                            90
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="shift-fix-x">小野　五子</td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                <i class="fa fa-edit black"></i>
                                            </a>
                                          </td>
                                          <td>
                                            <div>
                                                <a href="#" @click="openShiftPopup()">
                                                    パ-A
                                                </a>
                                            </div>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-C
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            -
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-B
                                            </a>
                                          </td>
                                          <td>
                                            <a href="#" @click="openShiftPopup()">
                                                パ-A
                                            </a>
                                          </td>
                                          <td>
                                            15
                                          </td>
                                          <td>
                                            110
                                          </td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary float-right mt-2">Excel出力</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true" style="z-index: 10000;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title">申請</h5> -->
                            <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-0">
                                <label v-for="item in this.$shift_type" :key="item.id" class="mr-2">
                                    <input type="radio" name="type" :value="item.id">
                                    <label class="ml-auto">{{item.name}}</label>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>出勤①</label>
                                <select class="form-control">
                                    <option>正-A 8:00 ~ 18:00</option>
                                    <option>正-B 8:00 ~ 18:00</option>
                                    <option>正-C 8:00 ~ 18:00</option>
                                    <option>正-D 8:00 ~ 18:00</option>
                                </select>
                                <div class="form-row align-items-center mt-3">
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_hour1" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_minute1" class="form-control">
                                    </div>
                                    <div class="form-control-label">⇒</div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_new_hour" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_new_minute" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>休憩</label>
                                <div class="form-row align-items-center">
                                    <div class="col-md-2">
                                        <input type="number" name="hour" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="minute" class="form-control">
                                    </div>
                                    <div class="form-control-label">⇒</div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_new_hour1" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_new_minute1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <label>出勤②</label>
                            <div class="form-group">
                                <select class="form-control">
                                    <option>正-A 8:00 ~ 18:00</option>
                                    <option>正-B 8:00 ~ 18:00</option>
                                    <option>正-C 8:00 ~ 18:00</option>
                                    <option>正-D 8:00 ~ 18:00</option>
                                </select>
                                <div class="form-row align-items-center mt-3">
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_hour2"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_minute2"
                                            class="form-control">
                                    </div>
                                    <div class="form-control-label">⇒</div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_new_hour2" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="work_start_new_minute2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>休憩</label>
                                <div class="form-row align-items-center">
                                    <div class="col-md-2">
                                        <input type="number" name="hour" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="minute"
                                            class="form-control">
                                    </div>
                                    <div class="form-control-label">⇒</div>
                                    <div class="col-md-2">
                                        <input type="number" name="new_hour" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="new_minute" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label v-for="item in this.$rest_type" :key="item.id" class="mr-2">
                                    <input type="radio" name="type" :value="item.id">
                                    <label class="ml-auto">{{item.name}}</label>
                                </label>
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
            <div class="modal fade" id="dayCalendar" tabindex="-1" role="dialog" aria-labelledby="dayCalendar" aria-hidden="true">
                <div class="modal-dialog modal-huge" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">2021年9月27日（月）</h5>
                            <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive p-0" style="width:100%">
                                <table class="table table-bordered shifttable-bordered shift-time-table">
                                    <thead class="text-center">
                                        <tr class="light-green">
                                            <th width="20%" colspan="2" class="p-0 align-middle">タイムテーブル</th>
                                            <th class="p-0 align-middle">勤務時間</th>
                                            <th class="p-0 align-middle">休憩時間</th>
                                            <th colspan="2" class="one-digit-time">7</th>
                                            <th colspan="2" class="one-digit-time">8</th>
                                            <th colspan="2" class="one-digit-time">9</th>
                                            <th colspan="2">10</th>
                                            <th colspan="2">11</th>
                                            <th colspan="2">12</th>
                                            <th colspan="2">13</th>
                                            <th colspan="2">14</th>
                                            <th colspan="2">15</th>
                                            <th colspan="2">16</th>
                                            <th colspan="2">17</th>
                                            <th colspan="2">18</th>
                                            <th colspan="2">19</th>
                                            <th colspan="2">20</th>
                                            <th colspan="2">21</th>
                                        </tr>
                                    </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>
                                                   阿部
                                                </td>
                                                <td>
                                                   正-A
                                                </td>
                                                <td class="fixed-width-40">
                                                   9.5
                                                </td>
                                                <td class="fixed-width-40">
                                                   1.0
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange ">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                   伊藤
                                                </td>
                                                <td>
                                                   正-B
                                                </td>
                                                <td class="fixed-width-40">
                                                   10.0
                                                </td>
                                                <td class="fixed-width-40">
                                                   1.0
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td class="background-orange ">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                   上野
                                                </td>
                                                <td>
                                                    <div class="mb-0">
                                                        <input type="radio" name="vacation_type" value="1">
                                                        <label class="ml-auto font-weight-normal mb-0">有休休暇</label>
                                                    </div>
                                                    <div class="mb-0">
                                                        <input type="radio" name="vacation_type" value="2">
                                                        <label class="ml-auto font-weight-normal mb-0">特別休暇</label>
                                                    </div>
                                                </td>
                                                <td class="fixed-width-40">
                                                   -
                                                </td>
                                                <td class="fixed-width-40">
                                                   -
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                   小野
                                                </td>
                                                <td>
                                                   短-A
                                                </td>
                                                <td class="fixed-width-40">
                                                   7.0
                                                </td>
                                                <td class="fixed-width-40">
                                                   1.0
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-grey">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td class="background-orange">
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                   遠藤
                                                </td>
                                                <td>
                                                    <a href="#" @click="openShiftPopup()">
                                                        <i class="fa fa-edit black"></i>
                                                    </a>
                                                </td>
                                                <td class="fixed-width-40">
                                                </td>
                                                <td class="fixed-width-40">
                                                   1.0
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>
<script>
    import moment from 'moment';
    export default {
        data () {
            return {
                editmode: false,
                currentDate: new Date(),
                displayDate: new Date(),
                days: [],
                attends : [],
                requests : [],
                // form: new Form({
                //     id : '',
                //     date: '',
                //     type : 0,
                //     hour: '',
                //     minute: '',
                //     new_hour: '',
                //     new_minute: '',
                //     memo: '',
                // })
            }
        },
        methods: {
            getWeekEnd(day) {
                const weekDay = moment(day).format("ddd");;
                if (weekDay === '土'){
                    return 1;
                } else if(weekDay === '日'){
                    return 2;
                } else {
                    return 0;
                }
            },
            isThisMonth() {
                const today = new Date();
                return this.currentDate.getFullYear() == today.getFullYear() && this.currentDate.getMonth() == today.getMonth();
            },
            getThisMonthDate() {
                const date = new Date();
                this.displayDate = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('YYYY年 M月');
                return new Date(date.getFullYear(), date.getMonth(), 1);
            },
            getNextMonthDate() {
                const date = this.currentDate;
                this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY年 M月');
                return new Date(date.getFullYear(), date.getMonth() + 1, 1);
            },
            getPrevMonthDate() {
                const date = this.currentDate;
                this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY年 M月');
                return new Date(date.getFullYear(), date.getMonth() - 1, 1);
            },
            getResults(month_date) {
                //this.$Progress.start();
                this.loadAttends(month_date);
                this.loadRequests(month_date);
                this.updateTable(month_date);
                //this.$Progress.finish();
            },
            createRequest(){
                $('#addNew').modal('hide');
                //TODO: this.form.post
                this.loadRequests();
            },
            updateRequest(){
                $('#addNew').modal('hide');
                //TODO: this.form.post
                this.loadRequests();
            },
            openShiftPopup(){
                this.editmode = true;
                this.firstdate = this.enddate;
                // if(row = this.requests.find(request => request.date.getTime() == date.getTime())) {
                //     this.editmode = true;
                //     this.form.fill(row);
                // } else {
                //     this.editmode = false;
                //     this.form.reset();
                // }
                $('#addNew').modal('show');
            },
            openDayCalendar(){
                $('#dayCalendar').modal('show');
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
                this.days = [];
                for(let day = firstDay; day <= lastDay; day++) {
                    this.days.push(new Date(date.getFullYear(), date.getMonth(), day));
                }
                console.log(this.days.length);

            },

        },
        mounted() {
            console.log('User Component mounted.')
        },
        created() {
            this.displayDate = moment(this.displayDate).format('YYYY年 M月');
            this.getResults(this.currentDate);
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
