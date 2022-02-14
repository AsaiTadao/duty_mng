<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title mb-0">保育システム</h3>
                            </div>
                            <div class="col-md-3">
                                山田　光子
                            </div>
                            <div class="col-md-3">
                                <select class="form-control">
                                    <option>2021年10月</option>
                                    <option>2021年11月</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-striped table-calendar table-head-fixed table-hover mb-0"
                            >
                                <!-- <thead class="text-center">
                                    <tr class="dark-yellow text-white">
                                        <th>
                                            日付
                                        </th>
                                        <th>
                                            従業員枠企業名
                                        </th>
                                    </tr>
                                </thead> -->
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            1日[月]
                                        </td>
                                        <td width="13%">
                                            2日[火]
                                        </td>
                                        <td width="13%">
                                            3日[火]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            ４日[木]
                                        </td>
                                        <td width="13%">
                                            5日[金]
                                        </td>
                                        <td width="13%">
                                            6日[土]
                                        </td>
                                        <td width="13%" class="red">
                                            7日[日]
                                        </td>
                                        <td width="13%">
                                            8日[月]
                                        </td>
                                        <td width="13%">
                                            9日[火]
                                        </td>
                                        <td width="13%">
                                            10日[水]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            11日[木]
                                        </td>
                                        <td width="13%">
                                            12日[金]
                                        </td>
                                        <td width="13%">
                                            13日[土]
                                        </td>
                                        <td width="13%" class="red">
                                            14日[日]
                                        </td>
                                        <td width="13%">
                                            15日[月]
                                        </td>
                                        <td width="13%">
                                            16日[火]
                                        </td>
                                        <td width="13%">
                                            17日[水]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            18日[木]
                                        </td>
                                        <td width="13%">
                                            19日[金]
                                        </td>
                                        <td width="13%">
                                            20日[土]
                                        </td>
                                        <td width="13%" class="red">
                                            21日[日]
                                        </td>
                                        <td width="13%">
                                            22日[月]
                                        </td>
                                        <td width="13%">
                                            23日[火]
                                        </td>
                                        <td width="13%">
                                            24日[水]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            25日[木]
                                        </td>
                                        <td width="13%">
                                            26日[金]
                                        </td>
                                        <td width="13%">
                                            27日[土]
                                        </td>
                                        <td width="13%" class="red">
                                            28日[日]
                                        </td>
                                        <td width="13%">
                                            29日[月]
                                        </td>
                                        <td width="13%">
                                            30日[火]
                                        </td>
                                        <td width="13%">
                                            31日[水]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right">登録</button>
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
            errors: [],
        }
    },
    methods: {
        childcarePlan() {
            this.$router.push('childcare-plan');
        }
    }
};
</script>
