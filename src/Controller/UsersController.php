<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\network\Exception\NotFoundException;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        //@override
        parent::initialize();
        $this->Auth->allow(['logout', 'forget', 'msg', 'reset', 'resetok']);
    }


    public function isAuthorized($user) {


        // var_dump($user);
        $action = $this->request->getParam("action");
        if (in_array($action, ["login", "index"])) {
            return true;
        }


        $userid = (int)$this->request->getParam("pass.0");
        if (in_array($action, ["edit", "view"])) {
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
    public function list()
    {
            $users = $this->paginate($this->Users);

            $this->set(compact('users'));
    }

    public function index()
    {
        $bulletin_table = TableRegistry::get('bulletins');
        $bulletins = $this->paginate($bulletin_table->find('all'));

        $this->set(compact('bulletins'));
        

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Report'],
        ]);

            $users = $this->paginate($this->Users);

            $this->set(compact('users'));  

        $this->set('user', $user);

        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }



    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // var_dump($user);
            // exit();
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The user has been deleted.'));
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);

    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl("users/index"));
            }
            $this->Flash->error(__('ユーザー名またはパスワードが違います。'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function forget()
    {   
        
        if ($this->request->is('post')) {

            //usersTableから入力したemailと一致するものがあるか取得
            $email = $this->request->getData('email');
            $users_table = TableRegistry::get('Users');
            $users_table = $users_table->find()
                ->where(['email ' => $email])
                ->first();

            if ($users_table) {

                //成功した場合こちらも同様
                $password_resets_table = TableRegistry::get('passwordresets');
                $password_reset = $password_resets_table->find()
                    ->where(['email' => $email])
                    ->first();
                if ($password_reset){
                    // expireを更新するために、すでにテーブルに登録されていたら削除する
                    $password_resets_table->delete($password_reset);
                }
            } else {
                // 未登録のメールアドレスの場合は、なにもせずに結果画面を表示
                return $this->redirect('users/msg');
            }

            //成功した場合処理の続行
            $data['email'] = $email;
            //selectorは16進数化してる
            //トークンが２種類あるのはtokenがハッシュ化して渡すようで
            //selectorはDB検索用
            $data['selector'] = bin2hex(random_bytes(8));
            $data['token'] = random_bytes(32);
            //トークンの保持時間の関係でdateで入力
            $data['expire'] = date("Y-m-d H:i:s",strtotime("1 day"));
            //urlの生成    ？はgetで受け取るため
            $url = Router::url([
                'controller' => 'Users',
                'action' => 'reset',
                '?' => ['selector' => $data['selector'], 'token' =>bin2hex($data['token'])],
            ], true);

            $password_reset = $password_resets_table->newEntity($data);
            $password_resets_table->save($password_reset);


            //メールの内容
            $subject = 'パスワード再発行のお知らせ';
            $message ="パスワード再発行のリクエストを受け付けました。
下記リンクをクリックしていただき、パスワード再設定の登録をお願いいたします。
*リンクの有効期限は、24時間です。
$url
本メールにもしお心当たりのない場合、
恐れ入りますが破棄して頂けるようお願いいたします。";
            
            $from = 'sixlolo1238@yahoo.co.jp';                          

            if (mb_send_mail($email, $subject, $message, 'From: '. $from)) {

            } else {
                echo '送信失敗';
                exit();
            }

            return $this->redirect('users/msg');
        } 
    }

    public function msg()
    {

        //画面遷移だけなんでなんもせん
    }

    public function reset() {
        
        //getじゃない場合notfound
        if(!$this->request->isget()){
            echo "a";
            throw new NotFoundException();
        }
        
        //トークンがない場合notfound
        if (!$this->request->query('selector') || !$this->request->query('token')) {
            echo "i";
            throw new NotFoundException();
        }
        
        //tableから情報持ってくる
        $password_resets_table = TableRegistry::get('passwordresets');
        //トークンと一致する値があるか調べる
        //有効期限が切れていないかも調べる
        $password_reset = $password_resets_table->find()
            ->where([
                'selector' => $this->request->query('selector'),
                'expire >=' => date("Y-m-d H:i:s"),
             ])
            ->first();
        
        //無かった場合エラー
        if (!$password_reset) {
            echo "u";
            throw new NotFoundException();
        }
    
        //一致しなかった場合エラー
        //第一引数に値、第二引数にハッシュ値
        //getから送られてくる値は16進数化しているのでバイナリ文字列にデコードしてあげる
        if (!password_verify(hex2bin($this->request->query('token')), $password_reset->token)){

            throw new NotFoundException();
        }
        // var_dump($password_reset->email);
        $this->request->session()->write('email', $password_reset->email);
    }

    public function resetok() {
        //postだったら
        if ($this->request->ispost()) {
            //セッションの値を変数に格納しセッションを削除
            $email = $this->request->session()->read('email');
            $this->request->session()->destroy();
            //ない場合エラー
            if (!$email){
                echo "o";
               throw new NotFoundException();
            }
            
            //userの情報を持ってきてemailを照合する
            $users_table = TableRegistry::get('Users');
            $user = $users_table->find()
                ->where(['email' => $email])
                ->first();
            
            
            $users_table->patchEntity($user, $this->request->getData());
            if ($user->errors()) {
                return $this->redirect($this->referer());
            }
            $password_resets_table = TableRegistry::get('PassWordResets');
            $password_reset = $password_resets_table->find()
                ->where(['email' => $email])
                ->first();
            $password_resets_table->delete($password_reset);
    
            if ($users_table->save($user)) {
                $this->Flash->success(__('パスワードを変更しました。'));
                return $this->redirect(['action' => 'login']);
                exit();
            } else {
                $this->Flash->error(__('パスワードの変更に失敗しました。'));
                return $this->redirect(['action' => 'login']);
                exit();
            }
        } else {
            echo "ka";
            throw new NotFoundException();
        }
    }

}

