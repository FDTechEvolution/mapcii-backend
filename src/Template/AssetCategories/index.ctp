<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <h3 class="m-t-0  card-header">หมวดหมู่อสังหาริมทรัพย์ </h3>
            <div class="card-body">
                <div class="col-12 bt-tool" style="text-align: right">
                    <?= $this->Html->link(BT_ADD, ['action' => 'add'], ['escape' => false]) ?> 
                </div>
                <table class="table table-hover" width="100%" id="cate_tb">
                    <thead>
                        <tr>
                             <th>หมวดหมู่</th>
                            <th width="150px" style="text-align: center"><?= __('เครื่องมือ') ?></th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assetCategories as $assetCategorie): ?>
                            <tr class="hand-cursor" data-id="<?= $assetCategorie->id ?>" >
                                
                                <td><?= h($assetCategorie->name) ?></td>
                                <td class="actions" style="text-align: center">
                                   
                                        <?= $this->Html->link(BT_EDIT, ['action' => 'edit', $assetCategorie->id], ['escape' => false, 'label' => false]) ?>
                                        <?= $this->Form->postLink(BT_DELETE, ['action' => 'delete', $assetCategorie->id], ['confirm' => __('ท่านต้องการลบข้อมูล ใช่ หรือ ไม่ '), 'escape' => false]) ?>
                                 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <ul class="nav nav-tabs">
                    <li class="nav-item" id='listock'>
                        <a href="#type" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            ประเภทของทรัพย์สิน
                        </a>
                    </li>
                   
                    

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="type" aria-expanded="true">
                        <iframe id="type_iframe" src="<?= SITE_URL . 'asset-types' ?>" frameborder="0" scrolling="yes" height="600px" width="100%"> </iframe>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   
    var asset_type_url = site_url+'asset-types/index/';
    
    
    $(document).ready(function () {

        $("#cate_tb").delegate('tr', 'click', function () {
            var id = $(this).attr("data-id");
       
            $('#type_iframe').attr('src', asset_type_url + id);
          
        });
    });

    $("#cate_tb > tbody tr").click(function () {
        var selected = $(this).hasClass("table-primary");
        $("#wh_tb > tbody tr").removeClass("table-primary");
        if (!selected) {
            //console.log($(this).attr('id'));
            $(this).addClass("table-primary");

        }

    });
</script>