<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title"><i class="ti-receipt"></i> ประวัติการจัดการ</h3>
            <div class="card-body">
                
                <table class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>วันที่ลง</th>
                            <th>รหัส</th>
                            <th>ชื่อผู้ลง</th>
                            <th class="text-center" width="7%">รูป</th>
                            <th class="text-center" width="10%">ระยะเวลา</th>
                            <th class="text-center">สถานะ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assetFree as $index => $asset): ?>
                            <?php
                                $date = '';
                                if (!is_null($asset->startdate)) {
                                    $date = $asset->startdate->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }

                                $date_now = date_create(date("Y-m-d"));
                                $startdate = date_create(date_format($asset->startdate, "Y-m-d"));
                                $diff = date_diff($date_now, $startdate);
                            ?>
                            <tr>
                                <td><?= $index +1 ?></td>
                                <td><?= h($date) ?></td>
                                <td><?= h($asset->code) ?></td>
                                <td><?= h($asset->name) ?></td>
                                <td><img src="<?= $assetFreeImage[$index]->image->url ?>" class="rounded w-100"></td>
                                <td class="text-center"><?= h($diff->format('%R%a')) ?> <small>วัน</small></td>
                                <td class="text-center">
                                    <?php 
                                        if($diff->format('%R%a') <= 0){
                                            echo "<small class='badge bg-danger'>หมดอายุ</small>";
                                        }else{
                                            echo "<small class='badge bg-success'>กำลังเผยแพร่</small>";
                                        }
                                    ?></td>
                                <td class="text-center d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#verifyAssetAdsModal" 
                                            data-code="<?= $asset->code ?>" 
                                            data-topic="<?= $asset->topic ?>"
                                            data-name="<?= $asset->name ?>"
                                            data-lname="<?= $asset->lname ?>"
                                            data-startdate="<?= $date ?>"
                                            data-adtype="<?= $asset->type ?>"
                                            data-image="<?= $assetFreeImage[$index]->image->url ?>"
                                            data-order_code="<?= $asset->order_code ?>"
                                            data-price="<?= $asset->price ?>"
                                            data-discount="<?= $asset->discount ?>"
                                            data-rental="<?= $asset->rental ?>"
                                    >ตรวจสอบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($assetFree)): ?>
                            <tr><td colspan="7" class="text-center">ไม่มีรายการยกเลิกประกาศฟรี....</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>




<script>
    
</script>

<style scope>
    
</style>