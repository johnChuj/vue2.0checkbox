<!--
  *查询主界面
  *文件描述
  *Created on 2018/3/27 17:47
  *Created by John
  *
  -->
<style>
    /*.right_td{*/
    /*overflow-x: scroll;*/
    /*}*/
    select {
        width: 120px;
    }

    input {
        width: 120px;
    }

    .listcase {
        overflow: auto;
    }
</style>
<script type="text/javascript" src="/js/My97DatePicker/WdatePicker.js"></script>
<div id="pay_query">
    <div class="position"><img src="/img/rent/icon2.gif"/>您的当前位置：查询</div>
    <div class="right_main">
        <div id="flashMessage"
             style="border:0px solid #FACC4E; margin:0 auto; width:100%; text-align:center; color:red;"><?php echo $session->flash(); ?></div>
        <div class="searchcase">
            <div>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="35" width="267px;">
                            编号：<input name="contractNo" v-model="contractNo"/>

                            所属城市：<select v-model="searchCity" name="city" id="SchoolCityId" v-on:change="search();">
                                <option value='0'>选择城市</option>
                                <template v-for="obj in cities">
                                    <option :value="obj.id" v-text="obj.name"></option>
                                </template>
                            </select>

                            主体：<select name="company" v-model="company">
                                <option value='0'>选择主体</option>
                                <template v-for="obj in companies">
                                    <option :value="obj.code" v-text="obj.name"></option>
                                </template>
                            </select>

                            供应商：<input name="supplier" v-model="supplier"/>

                            付款时间：<input data-date="start" name="pay_start_date" id="pay_start_date" class="Wdate"
                                        onclick="WdatePicker({minDate:'%y-%M-{%d}', dateFmt:'yyyy-MM-dd', isShowClear: false, readOnly: true, onpicked: handelDatePicked})"
                                        type="text"/> 至
                            <input data-date="end" type="text" name="pay_end_date" id="pay_end_date" maxlength="16"
                                   class="Wdate"
                                   onclick="WdatePicker({minDate:'%y-%M-{%d}', dateFmt:'yyyy-MM-dd', isShowClear: false, readOnly: true, onpicked: handelDatePicked})"
                                   value=""/>
                            <input type="submit" class="inputBtn" value="查询" v-on:click="search"/>
                        </td>

                    </tr>
                    <tr>
                        <td height="35">
                            <!--                            付款时间：<input data-date="start" name="pay_start_date" id="pay_start_date" class="Wdate" onclick="WdatePicker({minDate:'%y-%M-{%d}', dateFmt:'yyyy-MM-dd', isShowClear: false, readOnly: true, onpicked: handelDatePicked})" type="text"/> 至
                                                       <input data-date="end" type="text" name="pay_end_date" id="pay_end_date" maxlength="16" class="Wdate" onclick="WdatePicker({minDate:'%y-%M-{%d}', dateFmt:'yyyy-MM-dd', isShowClear: false, readOnly: true, onpicked: handelDatePicked})" value=""/>
                                                        <input type="submit" class="inputBtn" value="查询" v-on:click="search"/>-->
                        </td>

                    </tr>
                    <tr>
                        <td height="35">
                            &nbsp; &nbsp;
                            <input type="submit" class="inputBtn" id="button" value="导出选中" v-on:click="exportSelect"/>
                            <input type="submit" class="inputBtn" id="button" value="导出全部" v-on:click="exportAll"/>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
        <!--列表开始-->
        <div class="listcase" id="input-select">
            <table style="width: 250%" border="1" cellspacing="0" cellpadding="0" class="tableClass" id="table">
                <tr>
                    <th>全选<input style="width: 52%;" type="checkbox" name="checkbox" v-model='checked'
                                 v-on:click="checkedAll"/></th>
                    <th style="width:8%;">分类</th>
                    <th style="width:4%">编号</th>
                    <th style="width:4%">无形大类</th>
                    <th style="width:4%">项目名称</th>
                    <th style="width:4%">类型</th>
                    <th style="width:4%">是否一次性</th>
                    <th style="width:4%">所属城市</th>
                    <th style="width:4%">法律主体</th>
                    <th style="width:4%">供应商</th>
                    <th style="width:4%">金额（￥）</th>
                    <th style="width:4%">金额</th>
                    <th style="width:4%">起止日</th>
                    <th style="width:4%">终止日</th>
                    <th style="width:4%">金额（人民币元）</th>
                    <th style="width:4%">申请人</th>
                    <th style="width:4%">申请时间</th>
                    <th style="width:4%">备注</th>
                    <th style="width:4%">审核人</th>
                    <th style="width:4%">审核时间</th>
                    <th style="width:4%">付款人</th>
                    <th style="width:4%">日期</th>
                    <th style="width:4%">是否获得发票</th>
                    <th style="width:4%">发票日期</th>
                    <th style="width:4%">状态</th>
                </tr>
                <tbody>
                <tr v-for="item in resData">
                    <td><input type="checkbox" class="inputClass" name="checkbox[]" id="checkbox[]"
                               v-model="checkedNames" :value="item.payment_records_id" style="width: 20px;"/></td>
                    <td v-text="constVal.contractTypeNames[item.contract_type]"></td>
                    <td v-text="item.contract_no"></td>
                    <td v-text="item.amortization_type_name"></td>
                    <td v-text="item.project_name"></td>
                    <td v-text="item.amortization_type_name"></td>
                    <td v-text="constVal.isOnceAmortizationType[item.amortization_type]"></td>
                    <td v-text="item.cities_name"></td>
                    <td v-text="item.companies_name"></td>
                    <td v-text="item.supplier_name"></td>
                    <td v-text="item.contract_amount"></td>
                    <td v-text="item.payment_amount"></td>
                    <td v-text="item.amortization_begin_date"></td>
                    <td v-text="item.amortization_end_date"></td>
                    <td v-text="item.payment_amount"></td>
                    <td v-text="item.admin_name"></td>
                    <td v-text="item.payment_created_time==null ? '':item.payment_created_time.substr(0,10)"></td>
                    <td v-text="item.payment_note"></td>
                    <td v-text="item.payment_audit_name"></td>
                    <td v-text="item.payment_audit_name"></td>
                    <td v-text="item.payment_name"></td>
                    <td v-text="item.payment_time ==null? '':item.payment_time.substr(0,10) "></td>
                    <td v-text="item.payment_invoice =='1'?'是':'否'"></td>
                    <td v-text="item.invoice_time==null? '':item.invoice_time.substr(0,10) "></td>
                    <td v-text="constVal.paymentStatus[item.payment_status]"></td>
                    <!--                    <td v-text="item.payment_status"></td>
                                        <td v-text="item.payment_status"></td>
                                        <td v-text="item.payment_status"></td>
                                        <td v-text="item.payment_status"></td>-->
                    <!-- <td><a href="/pages/pay_operate?mainMenu=tanxiao">付款操作</a></td>-->

                </tr>
                </tbody>
            </table>
            <!--分页开始-->
            <my-paginaton :default_page="1" :total="sum" :per_page="10"></my-paginaton>
            <!--分页结束-->
        </div>
        <!--列表结束-->
    </div>
</div>


<?php include 'components/pagebar.ctp'; ?>

<script>
    var data = {
        test: '查询主界面',
        checkedNames: [],
        amortizationTypes: [],
        amortizationType: "0",
        search_city: "0",
        companies: [],
        company: "0",
        cities: [],
        time: {
            payment_time_start: "",
            payment_time_end: ""
        },
        contractNo: "",
        searchCity: "",
        company: "",
        supplier: "",
        resData: "",
        sum: 0,
        currentPage: 1,
        sumPage: 0,
        checked: false,
    };
    var vm = new Vue({
        // 选项
        el: "#pay_query",
        data: data,
        watch: {//深度 watcher
            'checkedNames': {
                handler: function (val, oldVal) {
                    if (this.checkedNames.length === this.resData.length) {
                        this.checked = true;
                    } else {
                        this.checked = false;
                    }
                },
                deep: true
            }
        },
        beforeMount: function () {

        },
        created: function () {
            var vm = this;
            //获取复所属城市分类列表获取
            getCitiesList(function (data) {
                vm.cities = data.data;
            });
            //获取列表获取
            getCompaniesList(function (data) {
                vm.companies = data.data;
            });
            this.getData(1);
        },
        methods: {
            getData: function (page) {
                //获取主页list信息
                var _self_ = this;
                var params = {
                    page: page,
                    contract_no: this.contractNo,
                    cities_id: this.searchCity,
                    companies_code: this.company,
                    supplier_name: this.supplier,
                    payment_time_start: this.time.payment_time_start,
                    payment_time_end: this.time.payment_time_end,
                };
                TX.fnRequestAjax(SERVER.api.geReportList, params, "get", function (response) {
                    if (response) {
                        _self_.resData = response.pay_manage_list;
                        _self_.sum = response.contract_sum;
                    }
                }, function (response) {
                });

            },
            search: function () {
                this.getData(1);
            },
            exportSelect: function () {
                // 导出所选Excel
                var ids = this.checkedNames.join(',');
                window.location.href = '/api/tx_report/pay_manage/export_pay_manage?payment_records_id=' + ids;
            },
            exportAll: function () {
                // 导出所有Excel
                window.location.href = '/api/tx_report/pay_manage/export_pay_manage';
            },
            selectCheck: function () {
                console.log("-----", this.checkedNames);
            },
            // 全选反选
            checkedAll: function () {
                var _this = this;
                if (this.checked) {//实现反选
                    _this.checkedNames = [];
                } else {//实现全选
                    _this.checkedNames = [];
                    _this.resData.forEach(function (item) {
                        _this.checkedNames.push(item.payment_records_id);
                    });
                }
            }
        },
    })

    /**
     * 处理选择的日期
     */
    function handelDatePicked(ev) {
        var element = ev.el || ev.srcEl
        var eleType = element.getAttribute('data-date') // eleType: start end
        if (eleType === 'start') {
            vm.time.payment_time_start = element.value
        } else if (eleType === 'end') {
            vm.time.payment_time_end = element.value
        }
    }
</script>
