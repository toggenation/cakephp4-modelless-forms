<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\DecorateForm;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * CustomPrint Form.
 */
class CustomPrintSuccessForm extends Form
{
    protected string $formName;
    protected int $copies;

    public function __construct($name = null, $copies = 12)
    {
        $this->formName = $name;
        $this->copies = $copies;
    }

    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema): Schema
    {
        $schema = new DecorateForm($schema, $this->formName);

        $schema->addField('copies', 'integer')
            ->addField('printer_id', 'integer');

        return $schema->wrapped;
    }

    public function setCopies($copies)
    {
        if (is_numeric($copies)) {
            $this->copies = $copies;
        }

        return $this;
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator = new DecorateForm($validator, $this->formName);

        $validator
            ->notBlank('printer_id', "Please select a printer")
            ->allowEmptyString('copies', 'Please enter the number of copies you want to print')
            ->lessThan('copies', $this->copies, sprintf('Copies must be less than %d', $this->copies));

        return $validator->wrapped;
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

    public function data($data)
    {

        foreach ($data as $key => $value) {
            $newKey = str_replace($this->formName . '-', '', $key);
            $strippedData[$newKey] = $value;
        }

        return $strippedData;
    }
}