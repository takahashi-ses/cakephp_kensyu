<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chatwork $chatwork
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $chatwork->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chatwork->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Chatworks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chatworks form large-9 medium-8 columns content">
    <?= $this->Form->create($chatwork) ?>
    <fieldset>
        <legend><?= __('Edit Chatwork') ?></legend>
        <?php
            echo "報告者 : " . $users->name;
            echo $this->Form->hidden('user_id', ['value' => $users->id]);
            echo $this->Form->textarea('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
