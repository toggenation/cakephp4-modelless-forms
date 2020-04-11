<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * CustomPrint Form.
 */
class CustomPrintSuccessForm extends Form
{
    protected $formName = '';
    protected $copies = 12;

    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema->addFields(
            [
            $this->prependFormName('copies') => 'integer',
            $this->prependFormName('printer_id') => 'integer'
            ]
        );
    }

    public function setCopies($copies)
    {
        if (is_numeric($copies)) {
            $this->copies = $copies;
        }

        return $this;
    }

    public function setFormName($formName)
    {
        if (!empty($formName) && is_string($formName)) {
            $this->formName = $formName;
        }

        return $this;
    }

    public function prependFormName(string $fieldName) : string
    {
        if (!empty($this->formName) && !empty($fieldName) && is_string($fieldName)) {
            return $this->formName . '-' . $fieldName;
        }
        return $fieldName;
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        return $validator
        ->notBlank($this->prependFormName('printer_id'), "Please select a printer")
        ->notBlank($this->prependFormName('copies'), 'Please enter the number of copies you want to print')
        ->lessThan($this->prependFormName('copies'), $this->copies, sprintf('Copies must be less than %d', $this->copies));
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