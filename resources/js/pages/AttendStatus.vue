<template>
    <attend-status-a v-if="this.session.roleId == 1"/>
</template>
<script>
import moment from 'moment';
import { mapState } from 'vuex';
import AttendStatusA from './AttendStatus/AttendStatusA.vue';
import AttendStatusB from './AttendStatus/AttendStatusB.vue';
import AttendStatusC from './AttendStatus/AttendStatusC.vue';

export default {
    components: { AttendStatusA, AttendStatusB, AttendStatusC },
    data () {
        return {
            editmode: false,
            currentDate: new Date(),
            displayDate: new Date(),
            days: [],
            attends : [],
            requests : [],
            form: {
                id : '',
                date: '',
                type : 0,
                hour: '',
                minute: '',
                new_hour: '',
                new_minute: '',
                memo: '',
            }
        }
    },
    computed: {
        ...mapState({
            applicationClasses: state => state.constants.applicationClasses,
            session: state =>  state.session.info
        }),
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
            this.loadAttends(month_date);
            this.loadRequests(month_date);
            this.updateTable(month_date);
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
            this.days = [];
            for(let day = firstDay; day <= lastDay; day++) {
                this.days.push(new Date(date.getFullYear(), date.getMonth(), day));
            }
        },

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
