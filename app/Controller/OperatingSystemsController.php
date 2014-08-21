<?php
App::uses('AppController', 'Controller');

/**
 * OperatingSystems Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class OperatingSystemsController extends AppController {

/**
 * OS検索画面
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->set('list', $this->OperatingSystem->getList($this->request->data[$this->name]));
		}
	}

/**
 * OS登録画面
 */
	public function add() {
		if ($this->request->is('post')) {
			if (is_array($this->OperatingSystem->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * OS照会画面
 * 
 * @param string $id OSマスタ.id
 */
	public function view($id) {
		$this->set('record', $this->OperatingSystem->getRecord($id));
	}

/**
 * OS編集画面
 * 
 * @param string $id OSマスタ.id
 */
	public function edit($id) {
		if ($this->request->is('post')) {
			$this->OperatingSystem->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->OperatingSystem->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->OperatingSystem->getRecord($id));
		}
	}

/**
 * OS削除画面
 * 
 * @param string $id OSマスタ.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->OperatingSystem->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
