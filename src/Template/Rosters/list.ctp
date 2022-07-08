<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Roster[]|\Cake\Collection\CollectionInterface $rosters
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Roster'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rosters index large-9 medium-8 columns content">
    
<?php foreach ($rosters as $roster): ?>
    <h3> <?= $roster->has('user') ? $roster->user->name : 'nanmonaiyo' ?></h3>
    <?php break; ?>
    <?php endforeach; ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!-- <th scope="col"><?= $this->Paginator->sort('users_id') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_time') ?></th>
                <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php endif;?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rosters as $roster): ?>
            <tr>
                <!-- <td><?= $roster->has('user') ? $this->Html->link($roster->user->name, ['controller' => 'Users', 'action' => 'view', $roster->user->id]) : 'nanmonaiyo' ?></td> -->
                <td><?= h($roster->start_time) ?></td>
                <td><?= h($roster->end_time) ?></td>
                <td class="actions">
                <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $roster->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roster->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roster->id)]) ?>
                <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
