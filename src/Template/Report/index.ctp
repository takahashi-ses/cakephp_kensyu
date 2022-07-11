<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report[]|\Cake\Collection\CollectionInterface $report
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('HOME'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="report index large-9 medium-8 columns content">
    <h3><?= __('Report') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <?php endif; ?>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?= $this->Number->format($report->id) ?></td>
                    <td><?= $report->has('user') ? $this->Html->link($report->user->name, ['controller' => 'Users', 'action' => 'view', $report->user->id]) : '' ?></td>
                    <td><?= h($report->comment) ?></td>
                    <td><?= h($report->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $report->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $report->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $report->id],    ['confirm' => __('Are you sure you want to delete # {0}?', $report->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($myReports as $myReport): ?>
                    <tr>
                        <td><?= h($myReport->comment) ?></td>
                        <td><?= h($myReport->created) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view',  $myReport->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $myReport->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' =>    'delete', $myReport->id],    ['confirm' => __('Are you sureyou want to delete # {0}?', $myReport->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
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
