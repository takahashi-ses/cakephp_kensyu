<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Report Controller
 *
 * @property \App\Model\Table\ReportTable $Report
 *
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportController extends AppController
{

    public function isAuthorized($user) {


        // var_dump($user);
        $action = $this->request->getParam("action");
        $userid = (int)$this->request->getParam("pass.0");
        if (in_array($action, ["index"])) {
            return true;
        }
        if (in_array($action, ["edit", "view", "delete", "add"])) {
            if ($userid == $user["id"]) {
                return true;
            }
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
        $id = $this->request->session()->read("Auth.User.id");

        $this->paginate = [
            'contain' => ['Users'],
        ];
        $reports = $this->paginate($this->Report);
        $myReports = $this->paginate($this->Report->find('all')->where(['user_id' => $id]));
        $account = $this->request->session()->read('Auth.User.account');
        $this->Users = $this->loadModel('Users');
        $user = $this->Users->find()->where(['account' => $account])->first();
        if ($this->request->session()->read("Auth.User.role") == 2) {
            $this->set(compact('reports', 'user'));
        } else {
            $this->set(compact('myReports', 'user'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Report->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('report', $report);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Report->newEntity();
        if ($this->request->is('post')) {
            $report = $this->Report->patchEntity($report, $this->request->getData());
            if ($this->Report->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }

        $account = $this->request->session()->read('Auth.User.account');
        $this->Users = $this->loadModel('Users');
        $user = $this->Users->find()->where(['account' => $account])->first();
        $this->set(compact('report', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Report->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Report->patchEntity($report, $this->request->getData());
            if ($this->Report->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        if ($this->request->session()->read("Auth.User.role") == 2) {
            $users = $this->Report->Users->find('list', ['limit' => 200]);
        } else {
            $account = $this->request->session()->read('Auth.User.account');
            $this->Users = $this->loadModel('Users');
            $users = $this->Users->find()->where(['account' => $account])->first();
        }
        $this->set(compact('report', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Report->get($id);
        if ($this->Report->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
