<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Chatworks Controller
 *
 * @property \App\Model\Table\ChatworksTable $Chatworks
 *
 * @method \App\Model\Entity\Chatwork[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChatworksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];

        $chatwork = $this->Chatworks->newEntity();
        if ($this->request->is('post')) {
            $chatwork = $this->Chatworks->patchEntity($chatwork, $this->request->getData());
            if ($this->Chatworks->save($chatwork)) {
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chatwork could not be saved. Please, try again.'));
        }

        $chatworks = $this->paginate($this->Chatworks);

        $account = $this->request->session()->read('Auth.User.account');
        $this->Users = $this->loadModel('Users');
        $user = $this->Users->find()->where(['account' => $account])->first();
        $this->set(compact('chatworks', 'chatwork', 'user'));

    }

    /**
     * View method
     *
     * @param string|null $id Chatwork id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chatwork = $this->Chatworks->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('chatwork', $chatwork);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chatwork = $this->Chatworks->newEntity();
        if ($this->request->is('post')) {
            $chatwork = $this->Chatworks->patchEntity($chatwork, $this->request->getData());
            if ($this->Chatworks->save($chatwork)) {
                $this->Flash->success(__('The chatwork has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chatwork could not be saved. Please, try again.'));
        }
        $users = $this->Chatworks->Users->find('list', ['limit' => 200]);
        $this->set(compact('chatwork', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Chatwork id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chatwork = $this->Chatworks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chatwork = $this->Chatworks->patchEntity($chatwork, $this->request->getData());
            if ($this->Chatworks->save($chatwork)) {
                $this->Flash->success(__('The chatwork has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chatwork could not be saved. Please, try again.'));
        }
        $account = $this->request->session()->read('Auth.User.account');
        $this->Users = $this->loadModel('Users');
        $users = $this->Users->find()->where(['account' => $account])->first();
        $this->set(compact('chatwork', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Chatwork id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chatwork = $this->Chatworks->get($id);
        if ($this->Chatworks->delete($chatwork)) {
            $this->Flash->success(__('The chatwork has been deleted.'));
        } else {
            $this->Flash->error(__('The chatwork could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
