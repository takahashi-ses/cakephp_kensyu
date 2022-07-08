<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\Table;

/**
 * Rosters Controller
 *
 * @property \App\Model\Table\RostersTable $Rosters
 *
 * @method \App\Model\Entity\Roster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RostersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        if ($this->request->session()->read("Auth.User.role") == 2)
        {
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $rosters = $this->paginate($this->Rosters
                ->find()
                ->DISTINCT("name"));


            $this->set(compact('rosters'));
        } else {
            return $this->redirect(["controller" => "users", "action" => "index"]);
        }
    }

    public function list($id = null)
    {

        if ($this->request->session()->read("Auth.User.role") == 2 || $this->request->session()->read("Auth.User.id") == $id)
        {
            $rosters = $this->paginate = [
                'contain' => ['Users'],
            ];

            $rosters = $this->paginate($this->Rosters
                ->find("all",
                    ["conditions" => ["users_id" => $id]]));


            $this->set(compact('rosters'));

        } else {
            return $this->redirect(["controller" => "Users","action" => "index"]);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Roster id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roster = $this->Rosters->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('roster', $roster);
    }


    //stmpメソッドがあるため未使用
    // /**
    //  * Add method
    //  *
    //  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {

    //     if ($this->request->session()->read("Auth.User.role") == 2)
    //     {
    //         $roster = $this->Rosters->newEntity();
    //         if ($this->request->is('post')) {
    //             $roster = $this->Rosters->patchEntity($roster, $this->request->getData());
    //             if ($this->Rosters->save($roster)) {
    //                 $this->Flash->success(__('The roster has been saved.'));

    //                 return $this->redirect(['action' => 'index']);
    //             }
    //             $this->Flash->error(__('The roster could not be saved. Please, try again.'));
    //         }
    //         $users = $this->Rosters->Users->find('list', ['limit' => 200]);
    //         $this->set(compact('roster', 'users'));
    //     } else {
    //         return $this->redirect(["controller" => "users", "action" => "index"]);
    //     }
    // }

    /**
     * Edit method
     *
     * @param string|null $id Roster id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->request->session()->read("Auth.User.role") == 2)
        {
        $roster = $this->Rosters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roster = $this->Rosters->patchEntity($roster, $this->request->getData());
            if ($this->Rosters->save($roster)) {
                $this->Flash->success(__('The roster has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The roster could not be saved. Please, try again.'));
        }
        $users = $this->Rosters->Users->find('list', ['limit' => 200]);
        $this->set(compact('roster', 'users'));

        } else {
            return $this->redirect(["controller" => "Users","action" => "index"]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Roster id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if ($this->request->session()->read("Auth.User.role") == 2)
        {
            $this->request->allowMethod(['post', 'delete']);
            $roster = $this->Rosters->get($id);
            if ($this->Rosters->delete($roster)) {
                $this->Flash->success(__('The roster has been deleted.'));
            } else {
                $this->Flash->error(__('The roster could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);

        } else {
            return $this->redirect(["controller" => "Users","action" => "index"]);
        }
    }

    /**
     * 打刻
     */
    public function stamp()
    {

        $account = $this->request->session()->read('Auth.User.account');
        $id = $this->request->session()->read("Auth.User.id");

        if ($this->request->is(['patch', 'post', 'put'])) {
            //送信データ取得
            $kubun = $this->request->getData('kubun');

            //accountからユーザーID取得
            $this->Users = $this->loadModel('Users');
            $user = $this->Users->find()->where(['account' => $account])->first();

            if (!$account) {
                $this->Flash->error('アカウント情報がありません');
                // var_dump($user);
                return;
            }

            // 当日のデータを取得
            $now = new FrozenTime();
            $roster = $this->Rosters->find()
                ->where(['users_id' => $user->id])
                ->where(['start_time >=' =>  $now->i18nFormat('yyyy-MM-dd') . ' 00:00:00'])
                ->where(['start_time <' =>  $now->addDay(1)->i18nFormat('yyyy-MM-dd') . ' 00:00:00'])
                ->order(['created' => 'desc'])
                ->first();

            // 出退勤済みの当日データが既にある場合は打刻しない
            if (isset($roster)) {
                if ($roster->start_time != NULL and $roster->end_time != NULL) {
                    $this->Flash->error('既に出退勤済みです。');
                    $rosters = $this->paginate($this->Rosters->find('all')->where(['users_id' => $id])->limit('5'));
                    $this->set(compact('rosters', 'id'));
                    return;
                }
            }

            // エンティティにpatchするための配列
            $tmpArr = array();
            $msg = '';

            //ユーザーIDをセット
            $tmpArr['users_id'] = $user->id;

            // 区分から出勤、退勤時刻を判断し日時を取得する
            if ($kubun === 'sta') {
                if (isset($roster)) {
                    $this->Flash->error('既に出勤しています。');
                    $rosters = $this->paginate($this->Rosters->find('all')->where(['users_id' => $id])->limit('5'));
                    $this->set(compact('rosters', 'id'));
                    return;
                } else {
                    $tmpArr['start_time'] = $now;
                    $msg = 'おはようございます。';
                    $roster = $this->Rosters->newEntity();
                }
            } elseif ($kubun === 'end') {
                if (isset($roster)) {
                    $tmpArr['end_time'] = $now;
                    $msg = 'お疲れさまでした。';
                } else {
                    $this->Flash->error('まだ出勤していません。');
                    $rosters = $this->paginate($this->Rosters->find('all')->where(['users_id' => $id])->limit('5'));
                    $this->set(compact('rosters', 'id'));
                    return;
                }
            }

            // エンティティに時刻をセットする
            $roster = $this->Rosters->patchEntity($roster, $tmpArr);
            if ($this->Rosters->save($roster)) {
                $this->Flash->success($msg);
            } else {
                $this->Flash->error('打刻でエラーが発生しました。');
            }

        }
        $rosters = $this->paginate($this->Rosters->find('all')->where(['users_id' => $id])->limit('5'));
        $this->set(compact('rosters', 'id'));
        // var_dump($rosters);
    }
}
