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
        $formNames = [ 'left', 'right'];
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
        $formNames = [ 'left', 'right'];
        $forms = [];
        foreach ($formNames as $form) {
            $copies = $form === 'left' ? 20: 7;

            $forms[$form] = (new CustomPrintSuccessForm())
                ->setCopies($copies)
                ->setFormName($form);
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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $print = $this->paginate($this->Print);

        $this->set(compact('print'));
    }

    /**
     * View method
     *
     * @param string|null $id Print id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $print = $this->Print->get($id, [
            'contain' => [],
        ]);

        $this->set('print', $print);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $print = $this->Print->newEmptyEntity();
        if ($this->request->is('post')) {
            $print = $this->Print->patchEntity($print, $this->request->getData());
            if ($this->Print->save($print)) {
                $this->Flash->success(__('The print has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The print could not be saved. Please, try again.'));
        }
        $this->set(compact('print'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Print id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $print = $this->Print->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $print = $this->Print->patchEntity($print, $this->request->getData());
            if ($this->Print->save($print)) {
                $this->Flash->success(__('The print has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The print could not be saved. Please, try again.'));
        }
        $this->set(compact('print'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Print id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $print = $this->Print->get($id);
        if ($this->Print->delete($print)) {
            $this->Flash->success(__('The print has been deleted.'));
        } else {
            $this->Flash->error(__('The print could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}