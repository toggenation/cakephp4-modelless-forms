<?php

use Cake\Utility\Inflector;

?>
<div class="row">
    <div class="col">
        <h3>Multiple Forms with Duplicate Field Names on a Page</h3>
    </div>
</div>
<div class="row">
    <?php foreach ($forms as $name => $form) : ?>
        <div class="col">
            <div class="card">
                <div class="card-body p-5">
                    <h4 class="card-title"><?= Inflector::humanize($name); ?></h4>
                    <?= $this->Form->create($form, [
                        'valueSources' => ['context']
                    ]); ?>
                    <?=
                    $this->Form->hidden(
                        'form',
                        [
                            'value' => $name
                        ]
                    ); ?>
                    <?= $this->Form->control(
                        'printer_id',
                        [
                            'label' => "Printer",
                            'empty' => '(select)',
                            'id' =>   $name  . '-printer_id',
                            'options' => $printers
                        ]
                    ); ?>
                    <?= $this->Form->control('copies', [
                        'id' => $name  . '-copies',
                        'label' => "Copies"
                    ]); ?>
                    <?= $this->Form->submit('Submit', ['class' => 'mt-3 mb-0']); ?>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>