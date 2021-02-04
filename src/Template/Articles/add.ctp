<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">เพิ่มบทความ</h4>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><?= $this->Html->link('บทความ', ['action' => 'article-index']) ?></li>
                <li class="breadcrumb-item active">เพิ่มบทความ</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <?= $this->Form->create($article, ['class' => 'form-horizontal']) ?>

            <div class="form-group">
                <label class="form-control-label" for="title">ชื่อเรื่อง</label>
                <?= $this->Form->control('title', ['class' => 'form-control form-control-success', 'label' => false, 'id' => 'title']) ?>
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
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <textarea id="elm1" name="content"></textarea>
            </div>
            <div class="form-group">
                <?= BT_SAVE ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->script('/assetdist/plugins/tinymce/tinymce.min.js') ?>
<script type="text/javascript">
    $(document).ready(function () {
        if ($("#elm1").length > 0) {
            tinymce.init({
                selector: "textarea#elm1",
                theme: "modern",
                height: 600,
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
        }
    });
</script>