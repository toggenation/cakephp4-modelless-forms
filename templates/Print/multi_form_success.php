<div class="row">
    <div class="col">
        <h1>Example of</h1>
        <h2>Successful Multiple Duplicate Forms on a Page Implementation</h2>
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
        <?= $this->Form->control(
                $formName  . '-printer_id',
                [
                    'label' => "Printer",
                    'empty' => '(select)',
                    'options' => $printers
                ]
            ); ?>
        <?= $this->Form->control($formName  . '-copies', [ 'label' => "Copies"]); ?>
        <?= $this->Form->submit('Submit', ['class' => 'mt-3']); ?>
        <?= $this->Form->end(); ?>
    </div>
    <?php endforeach; ?>

</div>