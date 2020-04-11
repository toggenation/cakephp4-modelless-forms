<ul class="nav nav-pills">
    <?php
$switcher = [
'multiFormSuccess', 'multiFormFail'
];

foreach ($switcher as $action): ?>
    <li class="nav-item">
        <?php

        $active = ($action === $this->request->getParam('action')) ? 'active' : '';
        echo $this->Html->link(
            $action,
            [

                'action' => $action
                ],
            [
        'class' => 'nav-link ' . $active
        ]
        ); ?>
    </li>
    <?php endforeach;?>

</ul>