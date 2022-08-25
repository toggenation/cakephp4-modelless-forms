<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CustomPrintFailForm;
use App\Form\CustomPrintSuccessForm;
use App\Form\DemoForm;
use Cake\Http\Cookie\Cookie;

/**
 * Print Controller
 *
 *
 * @method \App\Model\Entity\Print[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrintController extends AppController
{


    public function demo()
    {
        $data = $this->request->getData();

        $formNames = ['left', 'right'];

        $printers = [
            25 => "Factory Printer 1",
            34 => "End of Production Line Printer"
        ];

        $forms = [];

        foreach ($formNames as $form) {
            $maxCopies = ['left' => 3, 'right' => 5];

            $forms[$form] = new DemoForm(null, $maxCopies[$form]);

            if (isset($data['form']) && $data['form'] === $form) {
                $forms[$form]->setData($data);
            } else {
                $cookieValues = $this->request->getCookie($form, '');

                parse_str($cookieValues, $result);

                $forms[$form]->setData($result);
            }
        }

        if ($this->request->is("POST")) {
            if ($forms[$data['form']]->execute($data)) {
                $cookieData = http_build_query($data);

                $cookie = new Cookie($data['form'], $cookieData);

                $this->response = $this->getResponse()->withCookie($cookie);

                $this->Flash->success(__(
                    "Sending <strong>{0}</strong> copies to <strong>{1}</strong>",
                    $data['copies'],
                    $printers[$data['printer_id']]
                ), ['escape' => false]);
            } else {
                $this->Flash->error('Validation failed!');
            }
        }



        $this->set(compact('forms', 'printers'));
    }
}
