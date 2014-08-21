<?php
App::uses('AppController', 'Controller');

/**
 * BusinessCategories Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class BusinessCategoriesController extends AppController {

/**
 * 業種検索画面
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->set('list', $this->BusinessCategory->getList($this->request->data[$this->name]));
		}
	}

/**
 * 業種登録画面
 */
	public function add() {
		if ($this->request->is('post')) {
			if (is_array($this->BusinessCategory->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * 業種照会画面
 * 
 * @param string $id 業種マスタ.id
 */
	public function view($id) {
		$this->set('record', $this->BusinessCategory->getRecord($id));
	}

/**
 * 業種編集画面
 * 
 * @param string $id 業種マスタ.id
 */
	public function edit($id) {
		if ($this->request->is('post')) {
			$this->BusinessCategory->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->BusinessCategory->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->BusinessCategory->getRecord($id));
		}
	}

/**
 * 業種削除画面
 * 
 * @param string $id 業種マスタ.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->BusinessCategory->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
