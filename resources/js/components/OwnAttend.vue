<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">ラテラル保育園</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="getResults(getPrevMonthDate())">
                      <i class="fa fa-left"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-primary" @click="getResults(this.currentDate)">
                      今月
                  </button>
                  <button type="button" class="btn btn-sm btn-primary" :hidden="isThisMonth()" @click="getResults(getNextMonthDate())">
                      <i class="fa fa-right"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>日付</th>
                      <th>曜日</th>
                      <th>出勤①</th>
                      <th>退勤①</th>
                      <th>遅刻</th>
                      <th>早退</th>
                      <th>出勤②</th>
                      <th>退勤②</th>
                      <th>遅刻</th>
                      <th>早退</th>
                      <th>申請</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="day in days" :key="day.getDate()">

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
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">申請</h5>
                    <h5 class="modal-title" v-show="editmode">再申請</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateRequest() : createRequest()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label v-for="item in this.$request_type" :key="item.id">
                                <input v-model="form.type" type="radio" name="type" :value="item.id">{{item.name}}
                            </label>
                            <has-error :form="form" field="type"></has-error>
                        </div>

                        <div class="form-group">
                            <label>申請日時</label>
                            <div>{{ currentTime() }}</div>
                        </div>
                        <div class="form-group">
                            <label>修正時間</label>
                            <input v-model="form.hour" type="number" name="hour"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('hour') }">
                            <has-error :form="form" field="hour"></has-error>
                            <input v-model="form.minute" type="number" name="minute"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('minute') }">
                            <has-error :form="form" field="minute"></has-error>
                            ⇒
                            <input v-model="form.new_hour" type="number" name="new_hour"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('new_hour') }">
                            <has-error :form="form" field="new_hour"></has-error>
                            <input v-model="form.new_minute" type="number" name="new_minute"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('new_minute') }">
                            <has-error :form="form" field="new_minute"></has-error>
                        </div>
                    
                        <div class="form-group">
                            <label>申請理由</label>
                            <input v-model="form.memo" type="text" name="memo"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('memo') }">
                            <has-error :form="form" field="memo"></has-error>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">再申請</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">申請</button>
                    </div>
                  </form>
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
            requestModal(date){
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
