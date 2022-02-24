<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">メール</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <div class="col-md-10">
                    {{mailContent}}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
    </div>
</template>
<script>
    export default {
        // mixins: [actionLoading],
        props: {
            mailContent: {}
        },
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>
