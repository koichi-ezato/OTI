<?php
App::uses('AppController', 'Controller');

/**
 * Databases Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class DatabasesController extends AppController {

/**
 * データベース検索画面
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->set('list', $this->Database->getList($this->request->data[$this->name]));
		}
	}

/**
 * データベース登録画面
 */
	public function add() {
		if ($this->request->is('post')) {
			if (is_array($this->Database->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * データベース照会画面
 * 
 * @param string $id データベースマスタ.id
 */
	public function view($id) {
		$this->set('record', $this->Database->getRecord($id));
	}

/**
 * データベース編集画面
 * 
 * @param string $id データベースマスタ.id
 */
	public function edit($id) {
		if ($this->request->is('post')) {
			$this->Database->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->Database->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->Database->getRecord($id));
		}
	}

/**
 * データベース削除
 * 
 * @param string $id データベースマスタ.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->Database->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
