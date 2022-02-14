<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header calendar-title">
                            <h3 class="card-title mb-0">テラル保育園</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div>テラル保育園</div>
                                    <h3>保育日誌</h3>
                                    <div>0歳児クラス</div>
                                </div>
                                <div class="col-md-4">
                                    <div>令和３年１０月１１日（月）</div>
                                    <div>天気：</div>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-bordered table-diary">
                                        <thead class="text-center">
                                            <tr class="light-green">
                                                <th>園長</th>
                                                <th>主任</th>
                                                <th>担任</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td class="p-0">
                                                    <div style="height: 50px;">

                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <div style="height: 50px;">

                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <div style="height: 50px;">

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <table class="table table-bordered table-diary">
                                        <thead class="text-center">
                                            <tr class="dark-blue">
                                                <th>在籍</th>
                                                <th>出席</th>
                                                <th>欠席</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td class="p-0 align-middle">
                                                    <div style="height: 60px;display:flex;align-items:center;justify-content:center;">
                                                        3
                                                    </div>
                                                </td>
                                                <td class="p-0 align-middle">
                                                    <div style="height: 60px;display:flex;align-items:center;justify-content:center;">
                                                        2
                                                    </div>
                                                </td>
                                                <td class="p-0 align-middle">
                                                    <div style="height: 60px;display:flex;align-items:center;justify-content:center;">
                                                        1
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-9">
                                    <table class="table table-bordered table-diary">
                                        <thead class="text-center">
                                            <tr class="dark-blue">
                                                <th>欠席児とその理由</th>
                                                <th>特記事項・行事等</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td class="p-0">
                                                    <textarea class="textarea-fit">

                                                    </textarea>
                                                </td>
                                                <td class="p-0">
                                                    <textarea class="textarea-fit">

                                                    </textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-diary">
                                        <tbody class="text-center">
                                            <tr>
                                                <td rowspan="2" class="align-middle dark-blue p-1">
                                                   日案
                                                </td>
                                                <td class="dark-yellow">
                                                    ねらい
                                                </td>
                                                <td class="dark-yellow">
                                                    活動内容
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <textarea class="textarea-fit">

                                                    </textarea>
                                                </td>
                                                <td class="p-0">
                                                    <textarea class="textarea-fit">

                                                    </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue p-1">
                                                    援助<br>配慮事項
                                                </td>
                                                <td colspan="2" class="p-0">
                                                    <textarea class="textarea-fit">

                                                    </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="dark-blue p-1">
                                                    保育の実際<br>評価・反省
                                                </td>
                                                <td colspan="2" class="p-0">
                                                    <textarea class="textarea-fit">

                                                    </textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-diary">
                                        <tbody class="text-center">
                                            <tr>
                                                <td class="align-middle dark-blue p-1">
                                                   健康状態・その他
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <textarea class="textarea-fit" style="height: 100px;">

                                                    </textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-diary">
                                        <tbody class="text-center">
                                            <tr>
                                                <td class="align-middle dark-blue p-1">
                                                   備　　　　　考
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <textarea class="textarea-fit" style="height: 100px;">

                                                    </textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="float-right d-flex align-items-center mt-2">
                                <button class="btn btn-primary float-right mr-2">Excel出力</button>
                                <button class="btn btn-primary float-right">登録</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>


export default {

};
</script>
