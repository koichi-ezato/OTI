<?php
App::uses('AppController', 'Controller');

/**
 * TechnicalInformations Controller
 * 
 * @package			app.Controller
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class TechnicalInformationsController extends AppController {

/**
 * 使用するモデル
 * 
 * @var array
 */
	public $uses = array('TechnicalInformation', 'BusinessCategory', 'Database', 'Framework', 'OperatingSystem', 'ProgrammingLanguage');

/**
 * 初期処理
 */
	private function __init() {
		$this->set('business_categories', $this->BusinessCategory->getSelectboxValues());
		$this->set('databases', $this->Database->getSelectboxValues());
		$this->set('frameworks', $this->Framework->getSelectboxValues());
		$this->set('operating_systems', $this->OperatingSystem->getSelectboxValues());
		$this->set('programming_languages', $this->ProgrammingLanguage->getSelectboxValues());
	}

/**
 * 技術情報一覧画面
 */
	public function index() {
		$this->__init();
		if ($this->request->is('post')) {
			$this->set('list', $this->TechnicalInformation->getList($this->request->data[$this->name]));
		}
	}

/**
 * 技術情報照会画面
 * 
 * @param string $id 技術情報テーブル.id
 */
	public function view($id) {
		$this->__init();
		$this->set('record', $this->TechnicalInformation->getRecord($id));
	}

/**
 * 技術情報編集画面
 * 
 * @param string $id 技術情報テーブル.id
 */
	public function edit($id) {
		$this->__init();
		if ($this->request->is('post')) {
			$this->TechnicalInformation->id = $this->request->data[$this->modelClass]['id'];
			if (is_array($this->TechnicalInformation->save($this->request->data))) {
				$this->Session->setFlash(__('編集しました'));
				$url = array('controller' => $this->name, 'action' => 'index');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('編集に失敗しました'));
				$record[$this->modelClass] = $this->request->data[$this->modelClass];
				$this->set('record', $record);
			}
		} else {
			$this->set('record', $this->TechnicalInformation->getRecord($id));
		}
	}

/**
 * 技術情報登録画面
 */
	public function add() {
		$this->__init();
		if ($this->request->is('post')) {
			if (is_array($this->TechnicalInformation->save($this->request->data[$this->modelClass]))) {
				$this->Session->setFlash(__('登録しました'));
				$url = array('controller' => $this->name, 'action' => 'add');
				$this->redirect($url);
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}
	}

/**
 * 技術展開情報削除
 * 
 * @param string $id 技術情報.id
 */
	public function delete($id) {
		$this->autoRender = false;
		if ($this->TechnicalInformation->delete($id)) {
			$this->Session->setFlash(__('削除しました'));
			$url = array('controller' => $this->name, 'action' => 'index');
			$this->redirect($url);
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
		}
	}
}
