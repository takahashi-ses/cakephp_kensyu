<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bulletins Controller
 *
 * @property \App\Model\Table\BulletinsTable $Bulletins
 *
 * @method \App\Model\Entity\Bulletin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BulletinsController extends AppController
{

    public function isAuthorized($user) {


        // var_dump($user);
        $action = $this->request->getParam("action");
        if (in_array($action, ["view"])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $bulletins = $this->paginate($this->Bulletins);

        $this->set(compact('bulletins'));
    }

    /**
     * View method
     *
     * @param string|null $id Bulletin id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bulletin = $this->Bulletins->get($id, [
            'contain' => [],
        ]);

        $this->set('bulletin', $bulletin);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bulletin = $this->Bulletins->newEntity();
        if ($this->request->is('post')) {
            $bulletin = $this->Bulletins->patchEntity($bulletin, $this->request->getData());
            if ($this->Bulletins->save($bulletin)) {
                $this->Flash->success(__('The bulletin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulletin could not be saved. Please, try again.'));
        }
        $this->set(compact('bulletin'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bulletin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bulletin = $this->Bulletins->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bulletin = $this->Bulletins->patchEntity($bulletin, $this->request->getData());
            if ($this->Bulletins->save($bulletin)) {
                $this->Flash->success(__('The bulletin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulletin could not be saved. Please, try again.'));
        }
        $this->set(compact('bulletin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bulletin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bulletin = $this->Bulletins->get($id);
        if ($this->Bulletins->delete($bulletin)) {
            $this->Flash->success(__('The bulletin has been deleted.'));
        } else {
            $this->Flash->error(__('The bulletin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
