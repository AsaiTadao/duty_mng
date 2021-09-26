<template>
    <div id="calendar">
        <label v-if="label" :for="label">{{label}}</label>
        <div class="input-group date">
            <input
                class="form-control input-sm"
                type="text"
                ref="input"
                name="label"
                :value="value"
                @input="inputEventHandler($event)"
                @focus="focusEventHandler"
                @keyup="keyUpEventHandler"
                autocomplete="off"
            >
            <div class="input-group-btn">
                <button type="button" class="btn btn-sm btn-default"><i class="fa fa-calendar-alt"></i></button>
            </div>
        </div>
    </div>
</template>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

export default {
        name: 'DatePicker',
        props: {
            label: {
                type: String,
                default: ''
            },
            value: {
                default: ''
            },
            format: {
                type: String,
                default: 'dd/mm/yyyy'
            },
            erro: {
                type: Boolean,
                default: false
            },
            readonly: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
        },
        mounted: function () {
            this.initCalendar()
            this.readOnly()
            this.disable()
        },
        methods: {
            keyUpEventHandler(e){
                this.$emit('keyup', e);
            },
            inputEventHandler(e) {
                this.$emit('input', e.target.value)
            },
            focusEventHandler(e) {
                setTimeout(function () {
                    e.target.select()
                }, 0)
            },
            initCalendar(){
                let vm = this
                $(this.$el).children('.date').datepicker({
                    format: vm.format,
                    todayBtn: "linked",
                    language: "pt-BR",
                    autoclose: true,
                    todayHighlight: true,
                }).on('changeDate', function(e) {
                    vm.$emit('input', $(this).children('input').val())
                });
            },
            readOnly(){
                if (this.readonly) {
                    this.$refs.input.readOnly = this.readonly
                }
            },
            disable(){
                if (this.disabled) {
                    this.$refs.input.disabled  = this.disabled
                }
            },
            focus() {
                this.$refs.input.focus();
            }
        }
    };
</script>
