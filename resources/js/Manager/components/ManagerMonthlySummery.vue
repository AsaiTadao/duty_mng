<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">ラテラル保育園</h3>
                            <div class="card-tools calendar-center flex-grow-1">
                                <button type="button" class="btn btn-sm btn-outline" @click="getResults(getPrevMonthDate())">
                                    <i class="fas fa-caret-left fa-2x"></i>
                                </button>
                                <div class="mx-2">2021年8月</div>
                                <button type="button" class="btn btn-sm btn-outline-primary mx-2" @click="getResults(this.currentDate)">
                                    今月
                                </button>
                                <button type="button" class="btn btn-sm btn-outline" :hidden="isThisMonth()" @click="getResults(getNextMonthDate())">
                                    <i class="fas fa-caret-right fa-2x"></i>
                                </button>
                                <div class="form-group mx-4 mb-0">
                                    <select class="form-control">
                                        <option>阿部　一子</option>
                                        <option>伊藤　二子</option>
                                        <option>上野　三子</option>
                                        <option>遠藤　四子</option>
                                        <option>小野　五子</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="float-right">
                            <label>一括承認する</label>
                            <input type="checkbox" class="align-middle">
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped table-kintai table-hover">
                                <thead class="text-center">
                                    <tr class="heavy-green">
                                        <th width="4%" rowspan="2" class="align-middle">日付</th>
                                        <th width="4%" rowspan="2" class="align-middle">曜日</th>
                                        <th width="4%" rowspan="2" class="align-middle">出勤①</th>
                                        <th width="4%" rowspan="2" class="align-middle">退勤①</th>
                                        <th width="4%" rowspan="2" class="align-middle">遅刻</th>
                                        <th width="4%" rowspan="2" class="align-middle">早退</th>
                                        <th width="4%" rowspan="2" class="align-middle">出勤②</th>
                                        <th width="4%" rowspan="2" class="align-middle">退勤②</th>
                                        <th width="4%" rowspan="2" class="align-middle">遅刻</th>
                                        <th width="4%" rowspan="2" class="align-middle">早退</th>
                                        <th width="4%" rowspan="2" class="align-middle">勤務時間</th>
                                        <th width="4%" rowspan="2" class="align-middle">休憩</th>
                                        <th width="4%" rowspan="2" class="align-middle">実働時間</th>
                                        <th width="4%" rowspan="2" class="align-middle">残業時間</th>
                                        <th width="4%" rowspan="2" class="align-middle">連勤</th>
                                        <th colspan="2">年次有休</th>
                                        <th colspan="2">特別休暇</th>
                                        <th rowspan="2" class="align-middle">休暇理由</th>
                                        <th rowspan="2" class="align-middle">備考</th>
                                        <th width="4%" rowspan="2" class="align-middle">編集</th>
                                        <th width="4%" rowspan="2" class="align-middle">承認</th>
                                    </tr>
                                    <tr class="heavy-green">
                                        <th width="4%">時間</th>
                                        <th width="4%">日</th>
                                        <th width="4%">有給</th>
                                        <th width="4%">無給</th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center">
                                        <!-- <tr v-for="day in days" :key="day.getDate()">
                                            <td>{{day.getDate()}}日</td>
                                            <td>{{day|formatWeek}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="#" @click="requestModal(row)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                            </td>
                                        </tr> -->
                                        <tr>
                                          <td>1日</td>
                                          <td>月</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td>2日</td>
                                          <td>火</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td>3日</td>
                                          <td>水</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td>4日</td>
                                          <td>木</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td>5日</td>
                                          <td>金</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td>6日</td>
                                          <td class="blue">土</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td>7日</td>
                                          <td class="red">日</td>
                                          <td>7:55</td>
                                          <td>18:00</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>-</td>
                                          <td>10:00</td>
                                          <td>1:00</td>
                                          <td>9:00</td>
                                          <td>-</td>
                                          <td></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td></td>
                                          <td><input type="checkbox"></td>
                                          <td>
                                              <select>
                                                  <option>育児休暇</option>
                                                  <option>育児休暇</option>
                                              </select>
                                          </td>
                                          <td>
                                              <input type="text">
                                          </td>
                                          <td>
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg blue"></i>
                                            </a>
                                          </td>
                                          <td><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped-row table-kintai table-hover">
                                <tbody class="text-center">
                                    <tr>
                                        <td class="heavy-green text-white">
                                            勤務①計
                                        </td>
                                        <td class="light-green">
                                            42.5時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            勤務②計
                                        </td>
                                        <td class="light-green">
                                            13時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            勤務合計
                                        </td>
                                        <td class="light-green">
                                            55.5時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            実働時間
                                        </td>
                                        <td class="light-green">
                                            52.5時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            残業時間
                                        </td>
                                        <td class="light-green">
                                            0.75時間
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="heavy-green text-white">
                                            遅刻
                                        </td>
                                        <td class="light-green">
                                            1回
                                        </td>
                                        <td class="light-green">
                                            0.25時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            早退
                                        </td>
                                        <td class="light-green">
                                            1回
                                        </td>
                                        <td class="light-green">
                                            0.5時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            連続勤務
                                        </td>
                                        <td class="light-green">
                                           1日
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="heavy-green text-white">
                                            年次有休
                                        </td>
                                        <td class="light-green">
                                            1日
                                        </td>
                                        <td class="light-green">
                                            4時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            特休-有給
                                        </td>
                                        <td class="light-green">
                                            5時間
                                        </td>
                                        <td class="heavy-green text-white">
                                            特休-無給
                                        </td>
                                        <td class="light-green">
                                           1日
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary float-right">承認済み</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">申請</h5>
                            <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label v-for="item in this.$request_type" :key="item.id" class="mr-2">
                                    <input v-model="form.type" type="radio" name="type" :value="item.id">
                                    <label class="ml-auto">{{item.name}}</label>
                                </label>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <i class="fas fa-square-full"></i>
                                <label>申請日時</label>
                                <div>{{ currentTime() }}</div>
                            </div>
                            <div class="form-group">
                                <i class="fas fa-square-full"></i>
                                <label>修正時間</label>
                                <div class="form-row align-items-center">
                                    <div class="col-md-2">
                                        <input v-model="form.hour" type="number" name="hour"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('hour') }">
                                        <has-error :form="form" field="hour"></has-error>
                                    </div>
                                    <div class="col-md-2">
                                        <input v-model="form.minute" type="number" name="minute"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('minute') }">
                                        <has-error :form="form" field="minute"></has-error>
                                    </div>
                                    <div class="form-control-label">⇒</div>
                                    <div class="col-md-2">
                                        <input v-model="form.new_hour" type="number" name="new_hour"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('new_hour') }">
                                        <has-error :form="form" field="new_hour"></has-error>
                                    </div>
                                    <div class="col-md-2">
                                        <input v-model="form.new_minute" type="number" name="new_minute"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('new_minute') }">
                                        <has-error :form="form" field="new_minute"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <i class="fas fa-square-full"></i>
                                <label>申請理由</label>
                                <input v-model="form.memo" type="text" name="memo"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('memo') }">
                                <has-error :form="form" field="memo"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary">申請</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data () {
            return {
                editmode: false,
                currentDate: new Date(),
                days: [],
                attends : [],
                requests : [],
                form: new Form({
                    id : '',
                    date: '',
                    type : 0,
                    hour: '',
                    minute: '',
                    new_hour: '',
                    new_minute: '',
                    memo: '',
                })
            }
        },
        methods: {
            isThisMonth() {
                const today = new Date();
                return this.currentDate.getFullYear() == today.getFullYear() && this.currentDate.getMonth() == today.getMonth();
            },
            getNextMonthDate() {
                const date = this.currentDate;
                return new Date(date.getFullYear(), date.getMonth() + 1, 1);
            },
            getPrevMonthDate() {
                const date = this.currentDate;
                return new Date(date.getFullYear(), date.getMonth() - 1, 1);
            },
            getResults(month_date) {
                this.$Progress.start();
                this.loadAttends(month_date);
                this.loadRequests(month_date);
                this.updateTable(month_date);
                this.$Progress.finish();
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
            requestModal(){
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
                console.log(this.days);

            },

        },
        mounted() {
            console.log('User Component mounted.')
        },
        created() {
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
