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
            <?=$this->Html->link(BT_ADD,['action'=>'add'],['escape'=>false])?>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Created</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $key => $article): ?>
                        <tr>
                            <td><?= ($key+1)?></td>
                            <td><?= h($article->title) ?></td>
                            <td><?= h($article->created) ?></td>
 
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>