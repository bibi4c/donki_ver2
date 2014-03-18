<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('Sanitize', 'Utility');

/**
 * MasterAuth Controller
 *
 * @property CrammingSchool $CrammingSchool
 */
class LoginController extends AppController {

    var $uses = array('User');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Cookie->delete('searchForm');
        $this->Cookie->delete('userRegister');
        $this->Cookie->delete('storeRegister');
        $this->Cookie->delete('store_searchForm');
        $this->Cookie->delete('user_searchForm');
        $this->Cookie->delete('calendar_searchForm');
    }

    public function index() {
        return $this->redirect(array('controller' => 'login', 'action' => 'login'));
    }

    public function login() {
        if ($this->Auth->loggedIn()) {
            $aryUser = $this->Session->read('Auth.User');
            if (!empty($aryUser)) {
                $this->redirect(array('controller' => 'menu', 'action' => 'index'));
            }
        }
        if ($this->request->is('post')) {
            $data = $this->request->data;
            //debug($data);
            //debug(AuthComponent::password("password"));
            unset($this->User->validate['user_id']['unique']);
            unset($this->User->validate['password']['min']);
            unset($this->User->validate['password']['max']);
            unset($this->User->validate['user_name']);
            unset($this->User->validate['authority_id']);
            unset($this->User->validate['mail_address']);
            unset($this->User->validate['valid_flag']);
            $this->User->set($data);
            //if ($this->User->validates()) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller' => 'menu', 'action' => 'index'));
            } else {
                //$this->Session->setFlash(__('IDまたはパスワードが一致しません。'), 'error', array(), 'auth');
                $this->set('err_message', 'IDまたはパスワードが一致しません。');
            }
        }
        // }
        $this->set('title_for_layout', 'ログイン');
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function is_valid_email($email) {
        if (preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email) > 0)
            return true;
        else
            return false;
    }

}
