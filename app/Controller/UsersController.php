<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class UsersController extends AppController {

/**
 * ユーザ検索画面
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->set('list', $this->User->getList($this->request->data[$this->name]));
		}
	}

/**
 * ユーザ追加画面
 */
	public function add() {
		if ($this->request->is('post')) {
			if (is_array($this->User->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * ログイン画面
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('ログインに失敗しました'));
			}
		} else {
			$this->Auth->logout();
		}
	}

/**
 * ユーザ照会画面
 * 
 * @param string $id ユーザマスタ.id
 */
	public function view($id) {
		$this->set('record', $this->User->getRecord($id));
	}

/**
 * ユーザ編集画面
 * 
 * @param string $id ユーザマスタ.id
 */
	public function edit($id) {
		if ($this->request->is('post')) {
			$this->User->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->User->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->User->getRecord($id));
		}
	}

/**
 * ユーザ削除画面
 * 
 * @param string $id ユーザマスタ.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
