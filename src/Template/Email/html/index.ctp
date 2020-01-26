<div style="padding: 0% 10%;">
    <div >
        <h2 style="text-align: center">รายการรับจำนำใกล้ครบกำหนด</h2>
    </div>
    <div >
        <h3 style="text-align: center">รายการรับจำนำสิ้นอายุ วันที่ <?=$date ?></h3>
    </div>
    <div style="margin:0px auto;">
        <table style="width: 100%">
            <thead>
                <tr>


                    <th >เลขที่ใบจำนำ</th>
                    <th >ชื่อลูกค้า</th>
                    <th >จำนวนเงิน</th>
                    <th>วันที่ทำรายการ</th>
                    <th >วันสิ้นอายุ</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($pawns as $pawn): ?>
                    <tr>

                        <td ><?= h($pawn->docno) ?></td>
                        <td ><?= h($pawn->bpartner->name) ?></td>
                        <td ><?= h($pawn->totalmoney) ?></td>
                        <td ><?= h($pawn->docdate->i18nFormat(DATE_FORMATE, null, TH_DATE)) ?></td>
                        <td ><?= h($pawn->expiredate->i18nFormat(DATE_FORMATE, null, TH_DATE)) ?></td>



                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    table {
        margin-left: 25%;
        margin-top: 2%;
    }
    body {
        background-color: #ffffff;
    }
    th {

        border-bottom-style: groove;
    }
    td {

        border-bottom-style: double;
    }
    h1 {
        font-weight: 800 !important; margin: 20px 0 5px !important;
    }
    h2 {
        font-weight: 800 !important; margin: 20px 0 5px !important;
    }
    h3 {
        font-weight: 400 !important; margin: 20px 0 5px !important;
    }
    h4 {
        font-weight: 800 !important; margin: 20px 0 5px !important;
    }
    h1 {
        font-size: 22px !important;
    }
    h2 {
        font-size: 18px !important;
    }
    h3 {
        font-size: 16px !important;
    }
</style>