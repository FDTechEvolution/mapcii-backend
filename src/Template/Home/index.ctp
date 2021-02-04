<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Welcome !</h4>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Minton</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php $arr_year = [2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025]; ?>

<div id="dashboard" class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <div class="widget-chart text-center">
                <div class="row mb-2">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <select id="year" class="form-control" onChange="selectedYear()">
                            <option value="" selected disabled>เลือกปี ค.ศ.</option>
                            <?php foreach($arr_year as $year): ?>
                                <option value="<?=$year?>"><?=$year?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div id="chart"></div>
            </div>

        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">สถิติ</th>
                        <th scope="col" class="text-center">จำนวนวันนี้</th>
                        <th scope="col" class="text-center">จำนวนรวม</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="visitors" onClick="checkStatOnCharts();"><label for="visitors">จำนวนผู้เข้าชมเว็บ</label></td>
                        <td class="text-center w-25"></td>
                        <td class="text-center w-25"></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="members" onClick="checkStatOnCharts();"><label for="members">จำนวนสมาชิก</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_user['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_user['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="banners_a" onClick="checkStatOnCharts();"><label for="banners_a">จำนวน Banner A</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_banner_a['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_banner_a['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="banners_b" onClick="checkStatOnCharts();"><label for="banners_b">จำนวน Banner B</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_banner_b['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_banner_b['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="announces_ad" onClick="checkStatOnCharts();"><label for="announces_ad">จำนวนประกาศ (AD)</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_ads['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_ads['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="announces_free" onClick="checkStatOnCharts();"><label for="announces_free">จำนวนประกาศฟรี</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_free['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_free['sum'])) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-box">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">สถิติ</th>
                        <th scope="col" class="text-center">จำนวนวันนี้</th>
                        <th scope="col" class="text-center">จำนวนรวม</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="news" onClick="checkStatOnCharts();"><label for="news">จำนวนบทความ/ข่าว</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_article['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_article['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="contacts" onClick="checkStatOnCharts();"><label for="contacts">จำนวนคำถาม</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_contact['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_contact['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="reviewer" onClick="checkStatOnCharts();"><label for="review">จำนวนรีวิว</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_message['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_message['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="sales_visitors" onClick="checkStatOnCharts();"><label for="sales_visitors">ผู้เข้าชมอสังหาขายด่วน</label></td>
                        <td class="text-center w-25"></td>
                        <td class="text-center w-25"></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="new_visitors" onClick="checkStatOnCharts();"><label for="new_visitors">ผู้เข้าชมอสังหาโครงการใหม่</label></td>
                        <td class="text-center w-25"></td>
                        <td class="text-center w-25"></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="twohand_visitors" onClick="checkStatOnCharts();"><label for="twohand_visitors">ผู้เข้าชมอสังหามือสอง</label></td>
                        <td class="text-center w-25"></td>
                        <td class="text-center w-25"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->


</div>
<!-- end container -->
</div>
<!-- end content -->

<footer class="footer">
    2016 - 2017 © Minton <span class="hide-phone">- Coderthemes.com</span>
</footer>

</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


<style scoped>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
  .cls_stat_td {
    display: -webkit-box;
    width: 100% !important;
  }
  .cls_chk_size {
      width: 10%;
      margin-top: 4px;
      margin-right: 5px;
  }
  .table th, .table tr td {
    padding: 0.3rem !important;
  }
  .table tr th {
    font-size: 13px;
  }
  .table tr td label {
      margin-bottom: 0px;
      font-size: 12px;
  }
  .apexcharts-inactive-legend {
      display: none !important;
  }
</style>

<script type="text/javascript">
    let showVisitors = false
    // let is_data = document.getElementById('is_data_1').textContent
    // console.log(is_data)
    var options = {
            chart: {
                height: 380,
                type: 'line',
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                }
            },
            stroke: {
                show: true,
                curve: 'straight',
                lineCap: 'butt',
                colors: undefined,
                width: 3,
                dashArray: 0,
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '7px',
                    fontFamily: 'Helvetica, Arial, sans-serif',
                    fontWeight: 'normal',
                    colors: undefined
                }
            },
            tooltip: {
                enabled: true,
                followCursor: false,
                style: {
                    fontSize: '12px',
                    fontFamily: undefined
                }
            },
            xaxis: {
                title: {
                    text: 'เลือกปี ค.ศ.'
                },
                categories: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
            },
            yaxis: {
                title: {
                    text: 'จำนวนคน'
                },
                min: 0,
                max: 140
            },
            legend: {
                horizontalAlign: 'center',
                showForNullSeries: false,
                showForZeroSeries: false,
                fontSize: '10px',
                fontFamily: 'Helvetica, Arial',
                fontWeight: 400,
                onItemClick: {
                    toggleDataSeries: false
                }
            },
            theme: {
                mode: 'light'
            },
            title: {
                text: 'จำนวนสถิติผู้เข้าชม',
                align: 'left'
            },
            series: [
                {
                    name: 'จำนวนผู้เข้าชมเว็บ',
                    data: [30,40,35,50,49,60,70,91,100]
                },{
                    name: 'จำนวนสมาชิก',
                    data: [20,30,55,40,29,40,60,71,96]
                },{
                    name: 'จำนวน Banner A',
                    data: [32,36,55,32,66,51,82,71,66]
                },{
                    name: 'จำนวน Banner B',
                    data: [22,56,45,44,46,67,62,90,82]
                },{
                    name: 'จำนวนประกาศ (AD)',
                    data: [40,48,62,70,77,68,62,53,105]
                },{
                    name: 'จำนวนประกาศฟรี',
                    data: [88,65,90,78,55,34,58,44,67]
                },{ // Section 2 ------------------------------------------------------>>>>
                    name: 'จำนวนบทความ/ข่าว',
                    data: [20,24,31,35,35,37,38,39,42]
                },{
                    name: 'จำนวนคำถาม',
                    data: [8,12,14,15,15,14,5,10,7]
                },{
                    name: 'จำนวนรีวิว',
                    data: [13,14,20,24,32,23,12,23,8]
                },{
                    name: 'ผู้เข้าชมอสังหาขายด่วน',
                    data: [45,67,98,44,108,120,35,54,69]
                },{
                    name: 'ผู้เข้าชมอสังหาโครงการใหม่',
                    data: [55,78,56,55,68,34,60,87,94]
                },{
                    name: 'ผู้เข้าชมอสังหามือสอง',
                    data: [108,111,105,124,97,55,79,100,80]
                }
            ]
        }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    function selectedYear() {
        chart.updateOptions({
            xaxis: {
                title: {
                    text: 'ค.ศ. ' + document.getElementById('year').value
                }
            }
        })
    }

    function checkStatOnCharts() {
        if(document.getElementById('visitors').checked) {
            chart.showSeries('จำนวนผู้เข้าชมเว็บ')
        }else{
            chart.hideSeries('จำนวนผู้เข้าชมเว็บ')
        }

        if(document.getElementById('members').checked) {
            chart.showSeries('จำนวนสมาชิก')
        }else{
            chart.hideSeries('จำนวนสมาชิก')
        }

        if(document.getElementById('banners_a').checked) {
            chart.showSeries('จำนวน Banner A')
        }else{
            chart.hideSeries('จำนวน Banner A')
        }

        if(document.getElementById('banners_b').checked) {
            chart.showSeries('จำนวน Banner B')
        }else{
            chart.hideSeries('จำนวน Banner B')
        }

        if(document.getElementById('announces_ad').checked) {
            chart.showSeries('จำนวนประกาศ (AD)')
        }else{
            chart.hideSeries('จำนวนประกาศ (AD)')
        }

        if(document.getElementById('announces_free').checked) {
            chart.showSeries('จำนวนประกาศฟรี')
        }else{
            chart.hideSeries('จำนวนประกาศฟรี')
        }

        // Section 2 -------------------------------------------->>>>>>

        if(document.getElementById('news').checked) {
            chart.showSeries('จำนวนบทความ/ข่าว')
        }else{
            chart.hideSeries('จำนวนบทความ/ข่าว')
        }

        if(document.getElementById('contacts').checked) {
            chart.showSeries('จำนวนคำถาม')
        }else{
            chart.hideSeries('จำนวนคำถาม')
        }

        if(document.getElementById('reviewer').checked) {
            chart.showSeries('จำนวนรีวิว')
        }else{
            chart.hideSeries('จำนวนรีวิว')
        }

        if(document.getElementById('sales_visitors').checked) {
            chart.showSeries('ผู้เข้าชมอสังหาขายด่วน')
        }else{
            chart.hideSeries('ผู้เข้าชมอสังหาขายด่วน')
        }

        if(document.getElementById('new_visitors').checked) {
            chart.showSeries('ผู้เข้าชมอสังหาโครงการใหม่')
        }else{
            chart.hideSeries('ผู้เข้าชมอสังหาโครงการใหม่')
        }

        if(document.getElementById('twohand_visitors').checked) {
            chart.showSeries('ผู้เข้าชมอสังหามือสอง')
        }else{
            chart.hideSeries('ผู้เข้าชมอสังหามือสอง')
        }
    }

    chart.render();
</script>

<?='' //$this->Html->script('dashboard/main.js', ['type' => 'module']) ?>