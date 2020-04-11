<div class="row">
    <div class="col">
        <h1>Example of Successful Multiple Duplicate Forms on a Page Implementation</h1>
    </div>
</div>
<div class="row">
    <?php foreach ($forms as $formName => $form): ?>
    <div class="col">
        <?= $this->Form->create($form); ?>
        <?=
            $this->Form->hidden(
                'formName',
                [
                    'value' => $formName
                ]
            ); ?>
        <?=
        $this->Form->control(
            $formName  . '-printer_id',
            [
            'empty' => '(select)',
            'options' => $printers
            ]
        ); ?>
        <?= $this->Form->control($formName  . '-copies'); ?>
        <?= $this->Form->submit('Submit', ['class' => 'mt-3']); ?>
        <?= $this->Form->end(); ?>
    </div>
    <?php endforeach; ?>

</div>