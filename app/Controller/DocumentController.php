<?php

class DocumentController extends AppController {

    var $uses = array('Document', 'Item', 'Category');
    public $layout = null;
    public $components = array('RequestHandler', 'Cookie');
    public $helpers = array(
        'Html', 'Form',
        'Session', 'Paginator', 'Js',
    );
    var $paginate = array();

    public function beforeFilter() {
        parent::beforeFilter();
        $aryUser = $this->Session->read('Auth.User');
        $this->Cookie->delete('userRegister');
        $this->Cookie->delete('store_searchForm');
        $this->Cookie->delete('user_searchForm');
        $this->Cookie->delete('calendar_searchForm');
        if (!empty($aryUser)) {
            $this->layout = 'user';
        }
    }

    public function itemsearch() {
        $this->layout = 'ajax';

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $item_id = $data['curr'];
            $arrCategory = array('Category' => array('0' => ''));
            if ($item_id == '0') {
                $arrCategory += $this->Category->find('all');
            } else {
                $arrCategory += $this->Category->find('all', array(
                    'conditions' => array(
                        'Category.item_id' => $item_id,
                    )
                ));
            }
        }
        $this->set('arrCategory', $arrCategory);
    }

    public function itemsearch1() {
        $this->layout = 'ajax';

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $item_id = $data['curr'];
            $arrCategory = $this->Category->find('all', array(
                'conditions' => array(
                    'Category.item_id' => $item_id,
                )
            ));
        }
        $this->set('arrCategory', $arrCategory);
    }

    public function search() {
        $this->layout = 'user';
        $page_tittle = "書類項目一覧";
        $this->set("page_tittle", $page_tittle);
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($data['searchForm']['category'] == '') {
                $data['searchForm']['category'] = '0';
            }
            //debug($data);die;
            $this->Cookie->write("searchForm", $data);
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function index() {
        $this->layout = 'user';
        $page_tittle = "書類項目一覧";
        $this->set("page_tittle", $page_tittle);

        $condition = array();
        $search = $this->Cookie->read('searchForm');
        //debug($search);
        $start_f = 0;
        $err_mmmm = 0;
        $date_check = str_replace('年', '-', $search['searchForm']['start_date1']);
        $date_check = str_replace('月', '-', $date_check);
        $date_check = str_replace('日', '', $date_check);
        $start_date1 = $date_check;
        $date_check = str_replace('年', '-', $search['searchForm']['start_date2']);
        $date_check = str_replace('月', '-', $date_check);
        $date_check = str_replace('日', '', $date_check);
        $start_date2 = $date_check;
        $date_check = str_replace('年', '-', $search['searchForm']['end_date1']);
        $date_check = str_replace('月', '-', $date_check);
        $date_check = str_replace('日', '', $date_check);
        $end_date1 = $date_check;
        $date_check = str_replace('年', '-', $search['searchForm']['end_date2']);
        $date_check = str_replace('月', '-', $date_check);
        $date_check = str_replace('日', '', $date_check);
        $end_date2 = $date_check;
        if (isset($search)) {
            if ($search['searchForm']['item'] != '0')
                $condition += array('Document.item_id' => $search['searchForm']['item']);
            if ($search['searchForm']['category'] != '0')
                $condition += array('Document.category_id' => $search['searchForm']['category']);
            if (strlen($search['searchForm']['start_date1']) > 0)
                $condition += array('Document.start_date >=' => $start_date1);
            if (strlen($search['searchForm']['start_date2']) > 0)
                $condition += array('Document.start_date <=' => $start_date2);
            if (strlen($search['searchForm']['end_date1']) > 0)
                $condition += array('Document.end_date >=' => $end_date1);
            if (strlen($search['searchForm']['end_date2']) > 0)
                $condition += array('Document.end_date <=' => $end_date2);
            if ($search['searchForm']['end_date1'] > $search['searchForm']['end_date2'])
                $err_mmmm = 2;
            if ($search['searchForm']['start_date1'] > $search['searchForm']['start_date2'])
                $err_mmmm = 1;
        }
        else {
            $search['searchForm']['item'] = '0';
            $search['searchForm']['category'] = '';
            $search['searchForm']['start_date1'] = '';
            $search['searchForm']['start_date2'] = '';
            $search['searchForm']['end_date1'] = '';
            $search['searchForm']['end_date2'] = '';
            $start_f = 1;
        }

        $this->paginate = array(
            'limit' => '10',
            'conditions' => $condition,
            'order' => array(
                'Document.category_id' => 'asc',
                'Document.document_no' => 'asc',
            )
        );

        $this->set('search', $search);
        $items = $this->Item->find('all');
        $this->set('items', $items);
        $categories = $this->Category->find('all');
        $document_all = $this->Document->find('all', array('conditions' => $condition));
        $this->set('data_all_document', $document_all);
        //debug($categories);
        $this->set('categories', $categories);
        $data = $this->paginate('Document');
        $this->set('documents', $data);
        if ($err_mmmm == 0)
            $text = "検索結果はありません。再検索してください。<br>";
        else
        if ($err_mmmm == 1)
            $text = "[有効開始日]日付が逆転しました。<br>";
        else
            $text = "[有効終了日]日付が逆転しました。<br>";
        if (count($data) == 0 && $start_f == 0)
            $this->set('e_message', $text);
        if (count($data) == 0 || $start_f == 1)
            $this->set('paging_show', '1');
    }

    public function register() {
        $this->layout = 'ajax';
        $this->layout = 'user';
        $page_tittle = "書類項目登録";
        $this->set("page_tittle", $page_tittle);

        $data_document = array();
        $data_document['Document']['item_id'] = '1';
        $data_document['Document']['category_id'] = '1';
        $data_document['Document']['contents'] = '';
        $data_document['Document']['transfer_flag'] = '1';
        $data_document['Document']['start_date'] = '';
        $data_document['Document']['end_date'] = '';

        if ($this->request->is('post')) {
            $data = $this->request->data;
            // debug($data);
            $this->Document->set($data);
            $this->Cookie->write("documentRegister", $data);
            if ($this->Document->validates()) {
                return $this->redirect(array('controller' => 'Document', 'action' => 'register_confirm'));
            }
        }

        $aryDocumentRegister = $this->Cookie->read('documentRegister');
        if (isset($aryDocumentRegister)) {
            //debug($aryDocumentRegister);
            $data_document['Document']['item_id'] = $aryDocumentRegister['Document']['item'];
            $data_document['Document']['category_id'] = $aryDocumentRegister['Document']['category'];
            $data_document['Document']['contents'] = $aryDocumentRegister['Document']['contents'];
            $data_document['Document']['transfer_flag'] = $aryDocumentRegister['Document']['transfer_flag'];
            $data_document['Document']['start_date'] = $aryDocumentRegister['Document']['start_date'];
            $data_document['Document']['end_date'] = $aryDocumentRegister['Document']['end_date'];
            $this->Cookie->delete('documentRegister');
        }
        $data_item = $this->Item->find('all');
        $this->set('data_item', $data_item);

        $data_catagory = $this->Category->find('all', array(
            'conditions' => array(
                'Category.item_id' => $data_document['Document']['item_id'],
            )
        ));
        $this->set('data_category', $data_catagory);

        $this->set('data', $data_document);
    }

    public function register_confirm() {
        $this->layout = 'user';
        $page_tittle = "書類項目入力確認";
        $this->set("page_tittle", $page_tittle);

        $aryDocumentRegister = $this->Cookie->read('documentRegister');
        if (isset($aryDocumentRegister)) {
            //debug($aryDocumentRegister);
            $this->set('document_data', $aryDocumentRegister);
            $data_item = $this->Item->find('all', array('conditions' => array('Item.item_id' => $aryDocumentRegister['Document']['item'])));
            $this->set('items', $data_item);
            $data_category = $this->Category->find('all', array('conditions' => array('Category.category_id' => $aryDocumentRegister['Document']['category'])));
            $this->set('category', $data_category);
        } else {
            return $this->redirect(array('action' => 'register'));
        }

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $aryUser = $this->Session->read('Auth.User');
            $data_doc = $this->Document->find('all', array(
                'conditions' => array(
                    'Document.item_id' => $data['Document']['item'],
                    'Document.category_id' => $data['Document']['category']
                ),
                'order' => array(
                    'Document.document_no' => 'asc',
                )
            ));
            //debug($data_doc);
            $count = count($data_doc);
            if ($count > 0)
                $tt = $data_doc[$count - 1]['Document']['document_no'] + 1;
            else
                $tt = 1;
            $temp = array();
            $temp['Document']['item_id'] = $data['Document']['item'];
            $temp['Document']['category_id'] = $data['Document']['category'];
            $temp['Document']['document_no'] = $tt;
            $temp['Document']['contents'] = $data['Document']['contents'];
            $temp['Document']['transfer_flag'] = $data['Document']['transfer_flag'];
            $date_check = str_replace('年', '-', $data['Document']['start_date']);
            $date_check = str_replace('月', '-', $date_check);
            $date_check = str_replace('日', '', $date_check);
            $temp['Document']['start_date'] = $date_check;
            $date_check = str_replace('年', '-', $data['Document']['end_date']);
            $date_check = str_replace('月', '-', $date_check);
            $date_check = str_replace('日', '', $date_check);
            $temp['Document']['end_date'] = $date_check;
            $temp['Document']['register_datetime'] = date('Y-m-d H:i:s');
            $temp['Document']['register_user'] = $aryUser['user_id'];
            $this->Cookie->delete('documentRegister');
            if ($this->Document->save($temp)) {
                $this->redirect(array('controller' => 'Document', 'action' => 'success_register'));
            }
        }
    }

    public function success_register() {
        $this->layout = 'user';
        $page_tittle = "書類項目登録完了";
        $this->set("page_tittle", $page_tittle);
    }

    public function view() {
        $this->layout = 'user';
        $page_tittle = "書類項目編集";
        $this->set("page_tittle", $page_tittle);

        $document_id = $this->request->pass['0'];
        $someone = $this->Document->find('first', array(
            'conditions' => array('document_id' => $document_id)
        ));

        $this->set('data', $someone);
        //debug($someone);
        $pp = $someone['Document']['item_id'];
        $data_item = $this->Item->find('all');
        $this->set('data_item', $data_item);


        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['Document'] += array('document_id' => $someone['Document']['document_id']);
            $this->Document->set($data);
            //debug($data);
            $this->Cookie->write("documentRegister", $data);
            if ($this->Document->validates()) {
                return $this->redirect(array('action' => 'change_confirm'));
            }
        }

        $aryDocumentRegister = $this->Cookie->read('documentRegister');
        if (isset($aryDocumentRegister)) {
            //debug($aryDocumentRegister);
            $aryDocumentRegister['Document']['category_id'] = $aryDocumentRegister['Document']['category'];
            $this->set("data", $aryDocumentRegister);

            $this->Cookie->delete('documentRegister');
            $pp = $aryDocumentRegister['Document']['item_id'];
        }

        $data_catagory = $this->Category->find('all', array(
            'conditions' => array(
                'Category.item_id' => $pp,
            )
        ));
        $this->set('data_category', $data_catagory);
    }

    public function change_confirm() {
        $this->layout = 'user';
        $page_tittle = "書類項目入力確認";
        $this->set("page_tittle", $page_tittle);

        $aryDocumentRegister = $this->Cookie->read('documentRegister');
        //debug($aryDocumentRegister);
        if (isset($aryDocumentRegister)) {
            $this->set('document_data', $aryDocumentRegister);
            $data_item = $this->Item->find('all', array('conditions' => array('Item.item_id' => $aryDocumentRegister['Document']['item_id'])));
            $this->set('items', $data_item);
            $data_category = $this->Category->find('all', array('conditions' => array('Category.category_id' => $aryDocumentRegister['Document']['category'])));
            $this->set('category', $data_category);
        } else {
            return $this->redirect(array('action' => 'register'));
        }

        if ($this->request->is('post')) {
            $data = $this->request->data;
            //debug($data);die();
            $aryUser = $this->Session->read('Auth.User');
            $data_doc = $this->Document->find('all', array(
                'conditions' => array(
                    'Document.item_id' => $data['Document']['item_id'],
                    'Document.category_id' => $data['Document']['category']
                ),
                'order' => array(
                    'Document.document_no' => 'asc',
                )
            ));
            $someone = $this->Document->find('first', array(
                'conditions' => array('document_id' => $aryDocumentRegister['Document']['document_id'])
            ));

            $count = count($data_doc);
            if ($count > 0)
                $documnet_no = $data_doc[$count - 1]['Document']['document_no'] + 1;
            else
                $documnet_no = 1;
            $item_change = $data['Document']['item_id'];
            $category_change = $data['Document']['category'];
            $transfer_flag_change = $data['Document']['transfer_flag'];
            $contents_change = $data['Document']['contents'];
            $date_check = str_replace('年', '-', $data['Document']['start_date']);
            $date_check = str_replace('月', '-', $date_check);
            $date_check = str_replace('日', '', $date_check);
            $start_date_change = $date_check;
            $date_check = str_replace('年', '-', $data['Document']['end_date']);
            $date_check = str_replace('月', '-', $date_check);
            $date_check = str_replace('日', '', $date_check);
            $end_date_change = $date_check;
            $register_datetime_change = date('Y-m-d H:i:s');
            $register_user = $aryUser['user_id'];
            if ($someone['Document']['item_id'] == $item_change && $category_change == $someone['Document']['category_id']) {
                $documnet_no = $someone['Document']['document_no'];
            }
            // debug($someone);	
            if ($this->Document->updateAll(array(
                        'document_no' => "'$documnet_no'",
                        'contents' => "'$contents_change'",
                        'transfer_flag' => "'$transfer_flag_change'",
                        'start_date' => "'$start_date_change'",
                        'end_date' => empty($end_date_change) ? NULL : "'$end_date_change'",
                        'register_datetime' => "'$register_datetime_change'",
                        'register_user' => "'$register_user'"), array('document_id' => $aryDocumentRegister['Document']['document_id']))) {
                $this->Cookie->delete('documentRegister');
                $this->redirect(array('controller' => 'Document', 'action' => 'success_change'));
            }
        }
    }

    public function change_info() {
        $page_tittle = "ユーザ編集";
        $this->set("page_tittle", $page_tittle);
    }

    public function success_change() {
        $this->layout = 'user';
        $page_tittle = "書類項目編集完了";
        $this->set("page_tittle", $page_tittle);
    }

}

?>
