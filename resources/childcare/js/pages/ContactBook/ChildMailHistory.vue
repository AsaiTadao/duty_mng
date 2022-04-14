<template>
    <div class="mail-history-table">
        <table class="table table-bordered table-striped table-children table-head-fixed table-hover">
            <tbody>
                <tr v-for="mailHistory in mailHistories" :key="mailHistory.id">
                    <td class="thead">日時</td>
                    <td>{{ mailHistory.createdAt }}</td>
                    <td class="thead">件名</td>
                    <td>{{ mailHistory.subject }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from 'moment';
import api, { apiErrorHandler } from '../../global/api';

export default {
    props: {
        childId: Number | String
    },
    data() {
        return {
            mailHistories: []
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            api.get(`child/${this.childId}/mail-history`)
            .then(response => {
                this.mailHistories = response
                this.mailHistories.forEach(item => {
                    if (item.createdAt)
                    {
                        item.createdAt = moment(item.createdAt).format('YYYY-MM-DD HH:mm:ss')
                    }
                })
            })
            .catch(apiErrorHandler)
        }
    }
}
</script>

<style scoped>
.mail-history-table {
    margin-top: 20px;
}
.thead {
    background: #a89557;
}
</style>
