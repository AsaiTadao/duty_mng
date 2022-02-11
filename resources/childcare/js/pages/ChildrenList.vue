<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="園児ID, 園児氏名, メールアドレス">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat">検索</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>託児計画作成</label>
                                <select>
                                    <option>全て</option>
                                    <option>未登録</option>
                                    <option>登録有</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-children table-hover mb-0"
                            >
                                <thead class="text-center">
                                    <tr class="dark-brown text-white">
                                        <th>
                                            園児ID
                                        </th>
                                        <th>
                                            園児氏名
                                        </th>
                                        <th>
                                            性別
                                        </th>
                                        <th>
                                            年齢
                                        </th>
                                        <th>
                                            クラス
                                        </th>
                                        <th>
                                            託児計画
                                        </th>
                                        <th>
                                            園児台帳
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            A123
                                        </td>
                                        <td>
                                            山田　太郎
                                        </td>
                                        <td>
                                            男
                                        </td>
                                        <td>
                                            0歳7ヶ月
                                        </td>
                                        <td>
                                            0歳児
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" @click="openEditPage">未登録</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" @click="openDetailPage">詳細</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            A123
                                        </td>
                                        <td>
                                            山田　太郎
                                        </td>
                                        <td>
                                            男
                                        </td>
                                        <td>
                                            0歳7ヶ月
                                        </td>
                                        <td>
                                            0歳児
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" @click="openEditPage">編集</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" @click="openDetailPage">詳細</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


export default {
    data() {
        return {
            retiredDisplay: false,
        }
    },
    methods: {
        childcarePlan() {
            this.$router.push('childcare-plan');
        },
        presentManagement() {
            this.$router.push('present-management');
        },
        openEditPage() {
            this.$router.push('children-registry');
        },
        openDetailPage() {
            this.$router.push('children-detail');
        }
    }
};
</script>
