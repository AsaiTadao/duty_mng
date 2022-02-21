<template>
    <div class="home-minute-input-wrapper">
        <div class="home-minute-input">
            <input type="number" class="form-control" min="0" max="24" :value="hour" :class="{'is-invalid' : error}" @input="inputHour">
        </div>
        :
        <div class="home-minute-input">
            <input type="number" class="form-control" min="0" max="60" :value="minute" :class="{'is-invalid' : error}" @input="inputMinute">
        </div>
    </div>
</template>
<script>
export default {
    props: {
        value: String
    },
    computed: {
        hour() {
            if (!this.value) return '00';
            let arr = this.value.split(':');
            return arr[0];
        },
        minute() {
            if (!this.value) return '00';
            let arr = this.value.split(':');
            return arr[1];
        }
    },
    data() {
        return {
            error: false,
        }
    },
    methods: {
        inputHour(e) {
            let hour = e.target.value;
            if (!hour) {
                hour = '00';
            }
            this.$emit('input', hour + ':' + this.minute);
        },
        inputMinute(e) {
            let minute = e.target.value;
            if (!minute) {
                minute = '00';
            }
            this.$emit('input', this.hour + ':' + minute);
        }
    }
}
</script>
<style scoped>
.home-minute-input-wrapper {
    display: flex;
}
.home-minute-input {
    margin-right: 5px;
    margin-left: 5px;
}
</style>
