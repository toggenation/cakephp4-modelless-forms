<?php

use Cake\Utility\Inflector;
?>

<ul class="nav nav-pills">
    <?php
    $switcher = [
        'multiFormSuccess', 'multiFormFail'
    ];

    foreach ($switcher as $action) : ?>
    <li class="nav-item">
        <?php

            $active = ($action === $this->request->getParam('action')) ? 'active' : '';
            echo $this->Html->link(
                Inflector::humanize(Inflector::underscore($action)),
                [

                    'action' => $action
                ],
                [
                    'class' => 'nav-link ' . $active
                ]
            ); ?>
    </li>
    <?php endforeach; ?>

</ul>