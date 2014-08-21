<?php
App::uses('AppController', 'Controller');

/**
 * ProgrammingLanguages Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class ProgrammingLanguagesController extends AppController {

/**
 * プログラム言語検索画面
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->set('list', $this->ProgrammingLanguage->getList($this->request->data[$this->name]));
		}
	}

/**
 * プログラム言語登録画面
 */
	public function add() {
		if ($this->request->is('post')) {
			if (is_array($this->ProgrammingLanguage->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * プログラム言語照会画面
 * 
 * @param string $id プログラム言語マスタ.id
 */
	public function view($id) {
		$this->set('record', $this->ProgrammingLanguage->getRecord($id));
	}

/**
 * プログラム言語編集画面
 * 
 * @param string $id プログラム言語マスタ.id
 */
	public function edit($id) {
		if ($this->request->is('post')) {
			$this->ProgrammingLanguage->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->ProgrammingLanguage->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->ProgrammingLanguage->getRecord($id));
		}
	}

/**
 * プログラム言語削除画面
 * 
 * @param string $id プログラム言語マスタ.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->ProgrammingLanguage->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
