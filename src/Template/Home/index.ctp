<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><strong><i class="ti-dashboard"></i> สถิติ</strong></h4>
            <!-- <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="#">Minton</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php 
    $arr_year = []; 
    $nowYear = date('Y');
    for($i = 2018; $i <= $nowYear; $i++) {
        array_push($arr_year, $i);
    }
?>

<div id="dashboard" class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <div class="widget-chart text-center">
                <div class="row mb-2">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <select id="year" class="form-control" onChange="selectedYear()">
                            <option value="" disabled>เลือกปี ค.ศ.</option>
                            <?php foreach($arr_year as $year): ?>
                                <option value="<?=$year?>" <?php if($nowYear == $year) { ?> selected <?php } ?>><?=$year?></option>
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
                        <td class="text-center w-25"><?= h(json_decode($data_web['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_web['sum'])) ?></td>
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
                        <td class="text-center w-25"><?= h(json_decode($data_sale['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_sale['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="new_visitors" onClick="checkStatOnCharts();"><label for="new_visitors">ผู้เข้าชมอสังหาโครงการใหม่</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_new['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_new['sum'])) ?></td>
                    </tr>
                    <tr>
                        <td class="cls_stat_td w-50"><input type="checkbox" class="form-control cls_chk_size" id="twohand_visitors" onClick="checkStatOnCharts();"><label for="twohand_visitors">ผู้เข้าชมอสังหามือสอง</label></td>
                        <td class="text-center w-25"><?= h(json_decode($data_2hand['now'])) ?></td>
                        <td class="text-center w-25"><?= h(json_decode($data_2hand['sum'])) ?></td>
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

<!-- <footer class="footer">
    2016 - 2017 © Minton <span class="hide-phone">- Coderthemes.com</span>
</footer> -->

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
    const isDate = new Date();

    const isWebView = <?= $webview_json ?>;
    const isSaleView = <?= $saleview_json ?>;
    const isNewView = <?= $newview_json ?>;
    const isTwoHandView = <?= $twohand_json ?>;

    const isAds = <?= $ads_json ?>;
    const isFree = <?= $free_json ?>;
    const isUser = <?= $user_json ?>;
    const isBannerA = <?= $banner_a_json ?>;
    const isBannerB = <?= $banner_b_json ?>;
    const isArticle = <?= $article_json ?>;
    const isContact = <?= $contact_json ?>;
    const isMessage = <?= $message_json ?>;

    let webOnNow = getYearData(isWebView, isDate.getFullYear())
    let saleOnNow = getYearData(isSaleView, isDate.getFullYear())
    let newOnNow = getYearData(isNewView, isDate.getFullYear())
    let twohandOnNow = getYearData(isTwoHandView, isDate.getFullYear())

    let freeOnNow = getYearData(isFree, isDate.getFullYear())
    let adsOnNow = getYearData(isAds, isDate.getFullYear())
    let userOnNow = getYearData(isUser, isDate.getFullYear())
    let bannerA_onNow = getYearData(isBannerA, isDate.getFullYear())
    let bannerB_onNow = getYearData(isBannerB, isDate.getFullYear())
    let articleOnNow = getYearData(isArticle, isDate.getFullYear())
    let contactOnNow = getYearData(isContact, isDate.getFullYear())
    let messageOnNow = getYearData(isMessage, isDate.getFullYear())

    let showVisitors = false
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
                    text: 'ปี ค.ศ. ' + isDate.getFullYear()
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
                    data: webOnNow
                },
                {
                    name: 'จำนวนสมาชิก',
                    data: userOnNow
                },
                {
                    name: 'จำนวน Banner A',
                    data: bannerA_onNow
                },
                {
                    name: 'จำนวน Banner B',
                    data: bannerB_onNow
                },
                {
                    name: 'จำนวนประกาศ (AD)',
                    data: adsOnNow
                },
                {
                    name: 'จำนวนประกาศฟรี',
                    data: freeOnNow
                },
                { // Section 2 ------------------------------------------------------>>>>
                    name: 'จำนวนบทความ/ข่าว',
                    data: articleOnNow
                },
                {
                    name: 'จำนวนคำถาม',
                    data: contactOnNow
                },
                {
                    name: 'จำนวนรีวิว',
                    data: messageOnNow
                },
                {
                    name: 'ผู้เข้าชมอสังหาขายด่วน',
                    data: saleOnNow
                },
                {
                    name: 'ผู้เข้าชมอสังหาโครงการใหม่',
                    data: newOnNow
                },
                {
                    name: 'ผู้เข้าชมอสังหามือสอง',
                    data: twohandOnNow
                }
            ]
        }

    function selectedYear() {
        let thisYear = document.getElementById('year').value

        let webOnYear = getYearData(isWebView, thisYear)
        let saleOnYear = getYearData(isSaleView, thisYear)
        let newOnYear = getYearData(isNewView, thisYear)
        let twohandOnYear = getYearData(isTwoHandView, thisYear)
    
        let freeOnYear = getYearData(isFree, thisYear)
        let adsOnYear = getYearData(isAds, thisYear)
        let userOnYear = getYearData(isUser, thisYear)
        let bannerA_onYear = getYearData(isBannerA, thisYear)
        let bannerB_onYear = getYearData(isBannerB, thisYear)
        let articleOnYear = getYearData(isArticle, thisYear)
        let contactOnYear = getYearData(isContact, thisYear)
        let messageOnYear = getYearData(isMessage, thisYear)
        
        chart.updateOptions({
            xaxis: {
                title: {
                    text: 'ปี ค.ศ. ' + document.getElementById('year').value
                },
                categories: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
            },
            series: [
                {
                    name: 'จำนวนผู้เข้าชมเว็บ',
                    data: webOnYear
                },
                {
                    name: 'จำนวนสมาชิก',
                    data: userOnYear
                },
                {
                    name: 'จำนวน Banner A',
                    data: bannerA_onYear
                },
                {
                    name: 'จำนวน Banner B',
                    data: bannerB_onYear
                },
                {
                    name: 'จำนวนประกาศ (AD)',
                    data: adsOnYear
                },
                {
                    name: 'จำนวนประกาศฟรี',
                    data: freeOnYear
                },
                {
                    name: 'จำนวนบทความ/ข่าว',
                    data: articleOnYear
                },
                {
                    name: 'จำนวนคำถาม',
                    data: contactOnYear
                },
                {
                    name: 'จำนวนรีวิว',
                    data: messageOnYear
                },
                {
                    name: 'ผู้เข้าชมอสังหาขายด่วน',
                    data: saleOnYear
                },
                {
                    name: 'ผู้เข้าชมอสังหาโครงการใหม่',
                    data: newOnYear
                },
                {
                    name: 'ผู้เข้าชมอสังหามือสอง',
                    data: twohandOnYear
                }
            ]
        })
    }

    function getYearData(data, getYear) {
        let exYear = []
        data.forEach(item => {
            let year = item.as_date.split('-')
            if(year[0] == getYear) exYear.push(item)
        })
        return getMonthData(exYear)
    }

    function getMonthData(_exYear) {
        let perMonth = []
        for (let i = 1; i <= 12; i ++) {
            let monthCount = 0
            _exYear.forEach(item => {
                let month = item.as_date.split('-')
                if(i == month[1]) monthCount += item.count
            })
            perMonth.push(monthCount)
        }
        return perMonth
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

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>

<?='' //$this->Html->script('dashboard/main.js', ['type' => 'module']) ?>