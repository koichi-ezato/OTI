<?php
App::uses('AppController', 'Controller');

/**
 * Frameworks Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class FrameworksController extends AppController {

/**
 * フレームワーク検索画面
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->set('list', $this->Framework->getList($this->request->data[$this->name]));
		}
	}

/**
 * フレームワーク登録画面
 */
	public function add() {
		if ($this->request->is('post')) {
			if (is_array($this->Framework->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * フレームワーク照会画面
 * 
 * @param string $id フレームワークマスタ.id
 */
	public function view($id) {
		$this->set('record', $this->Framework->getRecord($id));
	}

/**
 * フレームワーク編集画面
 * 
 * @param string $id フレームワークマスタ.id
 */
	public function edit($id) {
		if ($this->request->is('post')) {
			$this->Framework->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->Framework->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->Framework->getRecord($id));
		}
	}

/**
 * フレームワーク削除画面
 * 
 * @param string $id フレームワーク.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->Framework->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
