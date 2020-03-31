
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการโฆษณาอสังหาริมทรัพย์ </h3>
            <div class="card-body">
                <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อ</th>
                            <th>ประเภท</th>
                            <th>วันที่สร้าง</th>
                            <th>หลักฐาน</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ads as $index => $ad): ?>
                            <tr>
                                <td><?= $ad->asset->code ?></td>
                                <td><?= h($ad->asset->name) ?></td>
                                <?php
                                $date = '';

                                if (!is_null($ad->asset->created)) {
                                    $date = $ad->asset->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }
                                ?>
                                <td><?= h($ad->asset->asset_type->name) ?></td>
                                <td><?= h($date) ?></td>
                                <td><button class="g-px-0 g-pt-0 g-pb-2 openImageDialog" type="button" data-toggle="modal" data-target="#modalSlip" data-id="<?= $paymentline[$index]->image->url ?>"><i class="fa fa-image g-font-size-20"></i></button></td>
                                <td>
                                    <?php if($paymentline[$index]->status == 'DR') { ?>
                                        <?=$this->Html->link('Approve',['controller'=>'assets','action'=>'adsapprove',$paymentline[$index]->id],['class'=>'btn btn-primary waves-effect waves-light'])?>
                                    <?php } else { ?>
                                        
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="modal fade" id="modalSlip" role="dialog">
                    <div class="modal-dialog">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close g-font-size-20 g-color-red"></i></button>
                        </div>
                        <div class="modal-body">
                            <img id="slipImage" class="img-fluid" src="">
                        </div>
                    </div>
                    
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".openImageDialog", function () {
        var myImageId = $(this).data('id');
        $(".modal-body #slipImage").attr("src", myImageId);
    });
</script>