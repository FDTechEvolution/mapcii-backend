<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">บทความ</h4>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addArticleModal"><i class="fa fa-plus-square"></i> เพิ่มบทความ/ข่าว</button>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">วันที่</th>
                        <th class="text-center">ผู้ประกาศ/แก้ไข</th>
                        <th>หัวข้อ</th>
                        <th class="text-center" width="7%">รูป</th>
                        <th class="text-center">สถานะ</th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $key => $article): ?>
                    <?php 
                        $date = '';
                        if (!is_null($article->created)) {
                            $date = $article->created->i18nFormat(DATE_FORMATE, null, TH_DATE);
                        }
                    ?>
                        <tr>
                            <td><?= ($key+1)?></td>
                            <td class="text-center"><?= h($date) ?></td>
                            <td class="text-center"><?= $article->user->firstname ?></td>
                            <td><?= h($article->title) ?></td>
                            <td class="text-center"><img src="<?= h($article->image->url) ?>" class="w-100"></td>
                            <td class="text-center"><small class='badge bg-success'>กำลังเผยแพร่</small></td>
                            <td class="actions">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#verifyArticleModal" 
                                    data-topic="<?= h($article->title) ?>"
                                    data-name="<?= h($article->user->firstname) ?>"
                                    data-content="<?= h($article->content) ?>"
                                    data-image="<?= h($article->image->url) ?>"
                                >ตรวจสอบ</button>
                                <button type="button" class="btn btn-sm btn-success mx-1" data-toggle="modal" data-target="#editArticleModal"
                                    data-id="<?= $article->id ?>"
                                    data-topic="<?= h($article->title) ?>"
                                    data-name="<?= h($article->user->firstname) ?>"
                                    data-content="<?= h($article->content) ?>"
                                    data-short="<?= h($article->short_content) ?>"
                                    data-image="<?= h($article->image->url) ?>"
                                >แก้ไข</button>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#unArticleModal" data-id="<?= h($article->id) ?>" data-topic="<?= h($article->title) ?>">ยกเลิก</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- VERIFY ARTICLE / NEWS -------------------------------------->
<div class="modal fade" id="verifyArticleModal" role="dialog">
    <div class="modal-dialog modal-article-verify">
        <div class="modal-content">
            <div class="modal-body">
                <strong><p id="articleTitle" class="mb-0"></p></strong>
                <p id="articleWrite"></p>
                <img src="" id="articleImage" class="w-100 mb-3">
                <span id="articleContent"></span>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>


<!-- DELETE ARTICLE / NEWS -------------------------------------->
<div class="modal fade" id="unArticleModal" role="dialog">
    <div class="modal-dialog modal-article-delete">
    <?= $this->Form->create('block', ['url'=>['controller'=>'Articles', 'action'=>'un-article'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_block']) ?>
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 id="articleConfirm"></h5>
                <input type="hidden" name="article_id" id="article_id">
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ยืนยัน'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>


<!-- ADD ARTICLE / NEWS -------------------------------------->
<div class="modal fade" id="addArticleModal" role="dialog">
    <div class="modal-dialog modal-article-add">
    <?= $this->Form->create('add', ['url'=>['controller'=>'Articles', 'action'=>'add'],'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4>เพิ่มบทความ</h4>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ปิด'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label" for="topic">ชื่อเรื่อง</label>
                    <?= $this->Form->control('topic', ['class' => 'form-control form-control-success', 'label' => false, 'id' => 'topic']) ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="short_content">เรื่องย่อ</label>
                            <textarea id="short_content" name="short_content" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="short_content">รูปหน้าปก</label>
                            <input type="file" name="image_file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea id="elm1" name="content"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> บันทึก'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>



<!-- EDIT ARTICLE / NEWS -------------------------------------->
<div class="modal fade" id="editArticleModal" role="dialog">
    <div class="modal-dialog modal-article-edit">
    <?= $this->Form->create('edit', ['url'=>['controller'=>'Articles', 'action'=>'edit'],'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_edit', 'enctype' => 'multipart/form-data']) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4>เพิ่มบทความ</h4>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ปิด'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label" for="topic">ชื่อเรื่อง</label>
                    <?= $this->Form->control('topic', ['class' => 'form-control form-control-success', 'label' => false, 'id' => 'topic']) ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="short_content">เรื่องย่อ</label>
                            <textarea id="short_content" name="short_content" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="short_content">รูปหน้าปก</label>
                            <img src="" id="article_image" class="w-50">
                            <input type="file" name="image_file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea id="elm1" name="content"></textarea>
                </div>
            </div>
            <input type="hidden" name="article_id" id="article_id">
            <div class="modal-footer">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> บันทึก'), ['class' => 'btn btn-primary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> ยกเลิก'), ['class' => 'btn btn-secondary btn-sm btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>



<style scope>
    span#articleContent p img {
        width: 100%;
    }
    .modal-dialog.modal-article-verify, 
    .modal-dialog.modal-article-add, 
    .modal-dialog.modal-article-edit {
        display: contents;
    }
    .modal-dialog.modal-article-verify .modal-content, 
    .modal-dialog.modal-article-add .modal-content, 
    .modal-dialog.modal-article-edit .modal-content {
        width: 60%;
        margin-left: 20%;
        margin-top: 3%;
        margin-bottom: 3%;
    }
</style>


<?= $this->Html->script('/assetdist/plugins/tinymce/tinymce.min.js') ?>
<script>
    $(document).ready(function () {
        $('#verifyArticleModal').on('show.bs.modal', function (e) {
            let Title = $(e.relatedTarget).data('topic');
            let Name = $(e.relatedTarget).data('name');
            let Content = $(e.relatedTarget).data('content');
            let Image = $(e.relatedTarget).data('image');
            
            document.getElementById("articleTitle").innerHTML = Title
            document.getElementById("articleWrite").innerHTML = 'โดย : ' + Name
            document.getElementById("articleImage").src = Image
            document.getElementById("articleContent").innerHTML = Content
        });

        $('#unArticleModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Title = $(e.relatedTarget).data('topic');
            
            document.getElementById("articleConfirm").innerHTML = 'ยืนยันการยกเลิกบทความ/ข่าว<br/> <span class="text-danger">' + Title + '</span> ?'
            $('#frm_block input[id="article_id"]').val(Id);
        });

        $('#addArticleModal').on('show.bs.modal', function (e) {

        });

        $('#editArticleModal').on('show.bs.modal', function (e) {
            let Id = $(e.relatedTarget).data('id');
            let Title = $(e.relatedTarget).data('topic');
            let Name = $(e.relatedTarget).data('name');
            let Content = $(e.relatedTarget).data('content');
            let Short = $(e.relatedTarget).data('short');
            let Image = $(e.relatedTarget).data('image');
            
            $('#frm_edit input[id="topic"]').val(Title);
            $('#frm_edit textarea[id="short_content"]').val(Short);
            tinymce.get("elm1").getBody().innerHTML = Content
            document.getElementById('article_image').src = Image
            $('#frm_edit input[id="article_id"]').val(Id);
        });
    });

    tinymce.init({
        selector: "textarea#elm1",
        theme: "modern",
        height: 400,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    });
</script>