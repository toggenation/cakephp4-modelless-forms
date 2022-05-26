<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CustomPrintFailForm;
use App\Form\CustomPrintSuccessForm;

/**
 * Print Controller
 *
 *
 * @method \App\Model\Entity\Print[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrintController extends AppController
{
    public function multiFormFail()
    {
        $formNames = ['left', 'right'];
        $forms = [];
        foreach ($formNames as $form) {
            $forms[$form] = new CustomPrintFailForm();
        }

        if ($this->request->is("POST")) {
            $data = $this->request->getData();
            $formName = $data['formName'];
            if ($forms[$formName]->validate($data)) {
                $this->Flash->success("It works");
                // do stuff
            } else {
                $this->Flash->error('Validation failed!');
            }
        }
        $printers = [
            25 => "Factory Printer 1",
            34 => "End of Production Line Printer"
        ];


        $this->set(compact('forms', 'printers'));
    }

    public function multiFormSuccess()
    {
        $formNames = ['left', 'right'];
        $forms = [];

        foreach ($formNames as $form) {
            $copies = $form === 'left' ? 20 : 7;

            $forms[$form] = new CustomPrintSuccessForm($form, $copies);
        }

        if ($this->request->is("POST")) {
            $data = $this->request->getData();

            /**
             * data looks like this with the formname
             * prepended to the form fields
             * [
             *      "left-copies" => 2 ,
             *      'left-printer_id'  => 25,
             *      'formName' => 'left
             * ]
             */

            $formName = $data['formName'];
            if ($forms[$formName]->validate($data)) {

                /**
                 * Once it is validated you can then strip out
                 * the form prefix if needed. to make it
                 * [
                 *      'copies' => 2,
                 *      'printer_id' => 25.
                 *      'formName' => 'left
                 * ]
                 */


                $data = $forms[$formName]->data($data);
                // do stuff with data

                $this->Flash->success("It works");
            } else {
                $this->Flash->error('Validation failed!');
            }
        }

        $printers = [
            25 => "Factory Printer 1",
            34 => "End of Production Line Printer"
        ];


        $this->set(compact('forms', 'printers'));
    }
}