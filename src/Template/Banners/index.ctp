
<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการ Banner </h3>
            <div class="card-body">
                <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ประเภท</th>
                            <th>ลูกค้า</th>
                            <th class="text-center">ตำแหน่ง</th>
                            <th>วันที่สร้าง</th>
                            <th class="text-center">รูปแบนเนอร์</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner_lines as $index => $banner_line): ?>
                            <tr>
                                <td><?= $banner_line->banner->type ?></td>
                                <td><?= h($banner_line->banner->user->firstname) ?> <?= h($banner_line->banner->user->lastname) ?></td>
                                <td class="text-center"><?= h($banner_line->banner->position->position) ?></td>
                                <?php
                                $date = '';

                                if (!is_null($banner_line->created)) {
                                    $date = $banner_line->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }
                                ?>
                                
                                <td><?= h($date) ?></td>
                                <td class="text-center"><button class="g-px-0 g-pt-0 g-pb-2 openImageDialog" type="button" data-toggle="modal" data-target="#modalBanner" data-id="<?= $banner_line->image->url ?>"><i class="fa fa-image g-font-size-20"></i></button></td>
                                <td>

                                    <div class="checkbox">

                                        <?= $this->Form->checkbox('isactive', ['hiddenField' => 'N', 'id' => $banner_line->id, 'value' => 'Y', $banner_line->isactive == 'Y' ? 'checked' : ""]) ?>
                                        <label for="<?= $banner_line->id ?>"></label>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalBanner" role="dialog">
                                <div class="modal-dialog">
                                
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close g-font-size-20 g-color-red"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <img id="bannerImage" class="img-fluid" src="">
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-dialog {
        max-width: 50%;
    }
    .img-fluid {
        width: 100%;
    }
</style>
<script>
    $(document).ready(function () {
        $("input[name = 'isactive']").change(function () {
            var id = $(this).attr('id');
            $.get(site_url + "banners/saveactive/", {id: id}).done(function (_data) {
                console.log(_data);
                 alert(_data);
            });
        });
    });

    $(document).on("click", ".openImageDialog", function () {
        var myImageId = $(this).data('id');
        $(".modal-body #bannerImage").attr("src", myImageId);
    });
</script>