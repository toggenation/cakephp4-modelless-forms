<div class="row">
    <div class="col">

        <h1>Example of</h1>
        <h2>Failing multi-form implementation</h2>
        <?php echo $this->element('switcher'); ?>
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
            'printer_id',
            [
            'empty' => '(select)'
            ]
        ); ?>
        <?= $this->Form->control('copies'); ?>
        <?= $this->Form->submit('Submit', ['class' => 'mt-3']); ?>
        <?= $this->Form->end(); ?>
    </div>
    <?php endforeach; ?>

</div>