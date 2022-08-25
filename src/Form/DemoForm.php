<?php

declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Event\EventManager;
use Cake\Utility\Inflector;

/**
 * Demo Form.
 */
class DemoForm extends Form
{
    private int $maxCopies;
    private int $minCopies = 1;
    private array $printers;

    public function __construct(?EventManager $eventManager = null, int $maxCopies = 10, array $printers = [])
    {
        $this->maxCopies = $maxCopies;
        $this->printers = $printers;
    }

    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema->addFields([
            'printer_id' => ['type' => 'integer'],
            'copies' =>  ['type' => 'integer'],
        ]);
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $max = $this->maxCopies;
        $min = $this->minCopies;
        $printers = $this->printers;
        return $validator->integer('printer_id')->integer('copies')
            ->add('copies', 'between', [
                'rule' => function ($value, $context) use ($min, $max, $printers) {
                    if ($value >= $min && $value <= $max) {
                        return true;
                    };

                    return __(
                        "Copies for {2} must be between {0} and {1}",
                        $min,
                        $max,
                        Inflector::humanize($context['data']['form'])
                    );
                }
            ]);
    }

    /**
     * Defines what to execute once the Form is processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        return true;
    }
}
