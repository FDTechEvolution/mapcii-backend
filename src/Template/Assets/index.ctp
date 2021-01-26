<?= $this->element('Lib/data_table') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20 card-body">
            <h3 class="m-t-0 gold-title card-header">รายการอสังหาริมทรัพย์ </h3>
            <div class="card-body">
                <table id="datatable" class="table table-responsive-lg " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อรายการ</th>
                            <th class="text-center" style="width: 10%;">ประเภท</th>
                            <th class="text-center">วันที่สร้าง</th>
                            <th class="text-center" style="width: 15%;">ผู้ที่สร้าง</th>
                            <th class="text-center">Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assets as $index => $asset): ?>
                            <tr>
                                <td><?= $asset->code ?></td>
                                <td><?= h($asset->name) ?></td>
                                <?php
                                $date = '';

                                if (!is_null($asset->created)) {
                                    $date = $asset->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                                }
                                ?>
                                <td class="text-center"><?= h($asset->asset_type->name) ?></td>
                                <td class="text-center"><?= h($date) ?></td>
                                <td class="text-center">
                                    <div class="row">
                                        <div class="col-6 px-0 text-right">
                                            <?= h($asset->user->firstname) ?> <br> <small>(<?= h($asset->user->phone) ?>)</small></div>
                                        <div class="col-6 text-left">
                                            <?php
                                                if($asset->user->islocked == 'N') { ?>
                                                    <?=$this->Html->link(__('<i class="fa fa-unlock"></i>'),['action'=>'block-user'],['class'=>'btn btn-sm btn-outline-success waves-effect waves-light', 'data-id' => $asset->user->id, 'data-toggle' => 'modal', 'data-target' => '#blockTime', 'escape' => false])?>
                                            <?php
                                                }else{ ?>
                                                    <?=$this->Html->link('<i class="fa fa-lock"></i>',['controller'=>'assets','action'=>'unblock-user',$asset->user->id],['class'=>'btn btn-sm btn-outline-danger waves-effect waves-light', 'escape' => false])?>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="checkbox">
                                        <?= $this->Form->checkbox('isactive', ['hiddenField' => 'N', 'id' => $asset->id, 'value' => 'Y', $asset->isactive == 'Y' ? 'checked' : ""]) ?>
                                        <label for="<?= $asset->id ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="blockTime" role="dialog">
    <div class="modal-dialog modal-banner">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Assets', 'action'=>'block-user'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block']) ?>
        <div class="modal-content">
            <div class="modal-body">
            ตั้งเวลาการบล๊อค : 
                <input type="date" name="block_time" class="from-control">
                <input type="hidden" name="user_id" id="user_id">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> Block'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>

<script>
    $(document).ready(function () {

        $("input[name = 'isactive']").change(function () {
            var id = $(this).attr('id');
            $.get(site_url + "assets/saveactive/", {id: id}).done(function (_data) {
                console.log(_data);
                 alert(_data);
            });
        });

        $('#blockTime').on('show.bs.modal', function (e) {
            var Id = $(e.relatedTarget).data('id');
            
            $('#frm_block input[id="user_id"]').val(Id);
        });
    });
</script>