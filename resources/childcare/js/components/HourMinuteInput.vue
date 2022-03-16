<template>
    <div class="home-minute-input-container">
        <div class="home-minute-input-wrapper">
            <div class="home-minute-input">
                <input :type="type" class="form-control" min="0" max="23" :value="hour"
                    :class="{'is-invalid' : error && !light, 'is-invalid-light': error && light}"
                    @input="inputHour" :disabled="disabled" />
            </div>
            :
            <div class="home-minute-input">
                <input :type="type" class="form-control" min="0" max="59" :value="minute"
                    :class="{'is-invalid' : error && !light, 'is-invalid-light': error && light}"
                    @input="inputMinute" :disabled="disabled" />
            </div>
        </div>
        <div v-if="error" class="home-minute-input-error">
            {{ error }}
        </div>
    </div>
</template>
<script>
export default {
    props: {
        value: String,
        error: String,
        type: {
            type: String,
            default: 'number'
        },
        disabled: {
            type: Boolean,
            default: false
        },
        light: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        hour() {
            if (!this.value) return '';
            let arr = this.value.split(':');
            return arr[0];
        },
        minute() {
            if (!this.value) return '';
            let arr = this.value.split(':');
            return arr[1];
        }
    },
    methods: {
        inputHour(e) {
            let hour = e.target.value;
            this.$emit('input', hour + ':' + this.minute);
        },
        inputMinute(e) {
            let minute = e.target.value;
            this.$emit('input', this.hour + ':' + minute);
        }
    }
}
</script>
<style scoped>
.home-minute-input-container {
    display: flex;
    flex-direction: column;
    column-gap: 5px;
}
.home-minute-input-wrapper {
    display: flex;
}
.home-minute-input {
    margin-right: 5px;
    margin-left: 5px;
}
.home-minute-input-error {
    margin-top: 5px;
    color: #f00;
}
</style>
