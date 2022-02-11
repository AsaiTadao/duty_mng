<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">仙台本社</h3>
                            <div class="mx-5">申請用帳票</div>
                            <div class="card-tools calendar-center flex-grow-1">
                                <button type="button" class="btn btn-sm btn-outline" @click="getResults(getPrevMonthDate())">
                                    <i class="fas fa-caret-left fa-2x"></i>
                                </button>
                                <div class="mx-2">{{displayDate}}</div>
                                <button type="button" class="btn btn-sm btn-outline-primary mx-2" @click="getResults(getThisMonthDate())">
                                    今月
                                </button>
                                <button type="button" class="btn btn-sm btn-outline" :hidden="isThisMonth()" @click="getResults(getNextMonthDate())">
                                    <i class="fas fa-caret-right fa-2x"></i>
                                </button>
                            </div>
                            <button type="button" class="btn btn-primary float-right" @click="printExcel()">
                                Excel出力
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="m-2">
                                    [{{displayDate}}]
                                </div>
                                <div class="m-2">
                                    ラテラル保育園
                                </div>
                                <div class="m-2">
                                    定員
                                </div>
                                <div class="m-2">
                                    定員
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <table class="table table-bordered table-diary text-center h-100">
                                        <tbody>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    0歳児
                                                </td>
                                                <td class="align-middle">
                                                    5名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    1歳児
                                                </td>
                                                <td class="align-middle">
                                                    5名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    2歳児
                                                </td>
                                                <td class="align-middle">
                                                    5名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    3歳児
                                                </td>
                                                <td class="align-middle">
                                                    5名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    4歳児
                                                </td>
                                                <td class="align-middle">
                                                    5名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    5歳児
                                                </td>
                                                <td class="align-middle">
                                                    5名
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-bordered table-diary text-center h-100">
                                        <tbody>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    従業員枠
                                                </td>
                                                <td class="align-middle">
                                                    11名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    地域枠
                                                </td>
                                                <td class="align-middle">
                                                    8名
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    従業員枠割合
                                                </td>
                                                <td class="align-middle">
                                                    58%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue align-middle">
                                                    地域枠割合
                                                </td>
                                                <td class="align-middle">
                                                    42%
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100 overflow-scroll-x">
                                        <table class="table table-bordered table-diary text-center w-2500-px">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="dark-blue header-fix-sub" style="width:10%; left: 0; z-index: 12 !important;outline: 1px;" colspan="3">
                                                        日付
                                                    </th>
                                                    <th v-for="day in days" :key="day.getDate()" class="align-middle light-blue" style="left: 77px;z-index: 13 !important;outline: 1px;">
                                                        {{day.getDate()}}
                                                    </th>
                                                    <th rowspan="2" class="align-middle">
                                                        合計
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="align-middle dark-blue header-fix-sub" colspan="3">曜日</th>
                                                    <th v-for="day in days" :key="day.getDate()" class="align-middle light-blue">
                                                        <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                        <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                        <div v-else>{{day|formatWeek}}</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td class="dark-blue align-middle header-fix-sub" rowspan="5">
                                                        延長時間
                                                    </td>
                                                    <td class="light-blue header-fix-sub-89">
                                                        通常開所時間
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        A
                                                    </td>
                                                    <td v-for="day in days" :key="day+'A'" class="align-middle">
                                                        1
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        18:31～19:00
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        B
                                                    </td>
                                                    <td v-for="day in days" :key="day+'B'" class="align-middle">
                                                        1
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        19:01～19:30
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        C
                                                    </td>
                                                    <td v-for="day in days" :key="day+'C'" class="align-middle">
                                                        1
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        19:31～20:00
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        D
                                                    </td>
                                                    <td v-for="day in days" :key="day+'D'" class="align-middle">
                                                        1
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="light-blue header-fix-sub-89">
                                                        それ以外
                                                    </td>
                                                    <td class="light-blue header-fix-sub-210">
                                                        E
                                                    </td>
                                                    <td v-for="day in days" :key="day+'E'" class="align-middle">
                                                        1
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table class="table table-bordered table-diary text-center w-3100-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            0歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                クラス
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle">支給認定証</td>
                                            <td rowspan="2" class="align-middle">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day.getDate()" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                1
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                2
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table class="table table-bordered table-diary text-center w-3100-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            1歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                クラス
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle">支給認定証</td>
                                            <td rowspan="2" class="align-middle">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day.getDate()" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                1
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                2
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table class="table table-bordered table-diary text-center w-3100-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            2歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                クラス
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle">支給認定証</td>
                                            <td rowspan="2" class="align-middle">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day.getDate()" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                1
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                2
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table class="table table-bordered table-diary text-center w-3100-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            3歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                クラス
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle">支給認定証</td>
                                            <td rowspan="2" class="align-middle">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day.getDate()" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                1
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                2
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table class="table table-bordered table-diary text-center w-3100-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            4歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                クラス
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle">支給認定証</td>
                                            <td rowspan="2" class="align-middle">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day.getDate()" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                1
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                2
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="w-100 overflow-scroll-x">
                                <table class="table table-bordered table-diary text-center w-3100-px">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr class="dark-yellow">
                                            <td rowspan="7" class="light-green header-fix-sub align-middle" style="width: 40px;">
                                            5歳児
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-40 dark-yellow align-middle" style="width:55px;">
                                                No.
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-95 dark-yellow align-middle" style="width:140px;">
                                                入園日
                                            </td>
                                            <td rowspan="2" class="header-fix-sub-235 dark-yellow align-middle" style="width:120px;">
                                                氏名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                生年月日
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                クラス
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                区分
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                従業員枠企業名
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                無償化
                                            </td>
                                            <td rowspan="2" class="align-middle">支給認定証</td>
                                            <td rowspan="2" class="align-middle">認定証有効期限</td>
                                            <td rowspan="2" class="align-middle">非課税世帯</td>
                                            <td v-for="day in days" :key="day+'0child'" class="align-middle">
                                                {{day.getDate()}}
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                登園日数
                                            </td>
                                            <td rowspan="2" class="align-middle">
                                                欠席日数
                                            </td>
                                            <td rowspan="2" class="align-middle">コロナ</td>
                                            <td rowspan="2" class="align-middle">都合</td>
                                            <td rowspan="2" class="align-middle">忌引</td>
                                            <td rowspan="2" class="align-middle">病欠</td>
                                            <td rowspan="2" class="align-middle">停止</td>
                                            <td rowspan="2" class="align-middle">休園</td>
                                            <td rowspan="2" class="align-middle">退園日</td>
                                            <td rowspan="2" class="align-middle">規定日数</td>
                                        </tr>
                                        <tr class="light-yellow">
                                            <td v-for="day in days" :key="day.getDate()" class="align-middle">
                                                <div v-if="getWeekEnd(day) === 1" class="blue">{{day|formatWeek}}</div>
                                                <div v-else-if="getWeekEnd(day) === 2" class="red">{{day|formatWeek}}</div>
                                                <div v-else>{{day|formatWeek}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                1
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td class="header-fix-sub-40 bg-white">
                                                2
                                            </td>
                                            <td class="header-fix-sub-95 bg-white">
                                                2021年10月1日
                                            </td>
                                            <td class="header-fix-sub-235 bg-white">
                                                山田　太郎
                                            </td>
                                            <td>
                                                2021年3月1日
                                            </td>
                                            <td>0歳7ヶ月</td>
                                            <td>従業員枠（他社）</td>
                                            <td>（株）仙台商事</td>
                                            <td>対象</td>
                                            <td>有り</td>
                                            <td>2022年1月1日</td>
                                            <td>〇</td>
                                            <td v-for="day in days" :key="day+'AB'" class="align-middle">
                                                B
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>〇</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import moment from 'moment';
import { mapState } from 'vuex';
import actionLoading from '../mixin/actionLoading';
import { showSuccess } from '../helpers/error';

export default {
    mixins: [actionLoading],
    data () {
        return {
            editmode: false,
            currentDate: new Date(),
            displayDate: new Date(),
            days: [],
            attendance: {},
            total: {},
            selectedMonth: '',
            month: new Date('YYYY-MM'),
            officeName: '',
            offices: [],
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
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('YYYY-MM');
            return new Date(date.getFullYear(), date.getMonth(), 1);
        },
        getNextMonthDate() {
            const date = this.currentDate;
            this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY年 M月');
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth() + 1, 1)).format('YYYY-MM');
            return new Date(date.getFullYear(), date.getMonth() + 1, 1);
        },
        getPrevMonthDate() {
            const date = this.currentDate;
            this.displayDate = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY年 M月');
            this.selectedMonth = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYYMM');
            this.month = moment(new Date(date.getFullYear(), date.getMonth() - 1, 1)).format('YYYY-MM');
            return new Date(date.getFullYear(), date.getMonth() - 1, 1);
        },
        getResults(month_date) {
            this.updateTable(month_date);
        },
        currentTime(){
            var today = new Date();
            var month = today.getMonth() + 1;
            var day = today.getDate();
            return month + "月" + day + "日 "
            + today.getHours() + ":"
            + today.getMinutes();
        },
        updateTable(date){
            this.currentDate = date;
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDate();
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
            this.days = [];
            for(let day = firstDay; day <= lastDay; day++) {
                this.days.push(new Date(date.getFullYear(), date.getMonth(), day));
            }
        },
    },
    created() {
        this.selectedMonth = moment(this.displayDate).format('YYYYMM');
        this.month = moment(this.displayDate).format('YYYY-MM');
        this.displayDate = moment(this.displayDate).format('YYYY年 M月');
        this.getResults(this.getThisMonthDate());
    },
    mounted() {

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
