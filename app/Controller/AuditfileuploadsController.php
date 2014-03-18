<?php

App::uses('AppController', 'Controller');
//App::uses('HtmlHelper', 'View/Helper');
/**
 * Fileuploads Controller
 *
 * @property Fileupload $Fileupload
 */
CakePlugin::load('FileUpload');

class AuditfileuploadsController extends AppController {

//public $helpers = array( 'Form','Html', 'FileUpload.FileUpload');
    public $components = array('RequestHandler'); //array('FileUpload.FileUpload');

//public function beforeFilter(){
//     $this->FileUpload->allowedTypes(array(
//         'jpg' => array('image/jpeg', 'image/pjpeg'),
//         'jpeg' => array('image/jpeg', 'image/pjpeg'),
//         'gif' => array('image/gif'),
//         'png' => array('image/png','image/x-png'),
//         'zip' => array('application/octet-stream')
//        )
//     );
//     //$this->FileUpload->fields(array('name'=> 'name', 'type' => 'type', 'size' => 'size')); //c�c field tuong ?ng trong csdl
//     $this->FileUpload->uploadDir('files'); //file upload ?nh, luu folder d� c� s?n
//     $this->FileUpload->fileModel('Audutfileupload');  //model c?a csdl
//     //$this->FileUpload->fileVar('url'); //name
//	 //$this->FileUpload->fileNameFunction('md5');
//	}

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Auditfileupload->recursive = 0;
        //debug($this->Auditfileupload);
        $this->set('fileuploads', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {

        $this->Auditfileupload->id = $id;
        if (!$this->Auditfileupload->exists()) {
            throw new NotFoundException(__('Invalid fileupload'));
        }
        $this->set('fileupload', $this->Auditfileupload->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($id = null, $store = null) {
        //$audit_detail = $this->Audit_detail->find('all', array('conditions' => array('Audit_detail.audit_id' => $temp1,'Audit_detail.document_id'=>$temp0)));
        //debug($this->Auditfileupload->find('all'));
        //debug($this->request);
        $this->layout = 'ajax';
        if ($this->request->is('post')) {
//			if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
            $this->Auditfileupload->create();
            $bibi_find = $this->Auditfileupload->find('first', array(
                'fields' => array('audit_file_id'),
                'order' => array(
                    'audit_file_id DESC')
            ));
            if ($bibi_find != NULL)
                $id_file = $bibi_find['Auditfileupload']['audit_file_id'];
            else
                $id_file = 0;
            $id_file++;
            $leng_id = strlen($id_file);
            $char_id = '';
            for ($i = 0; $i < 11 - $leng_id; $i++) {
                $char_id = $char_id . '0';
            }
            $char_id = $char_id . $id_file;
            $data = $this->request->data;
            $data['Auditfileupload']['audit_file_id'] = $id_file;
            $bibi_ext = strrchr($data['Auditfileupload']['file']['name'], ".");
            $data['Auditfileupload']['file']['size'] = 'audit_' . $store . '_' . $char_id;
            $data['Auditfileupload']['audit_file_path'] = $data['Auditfileupload']['file']['size'] . $bibi_ext;
            $data['Auditfileupload']['audit_file_name'] = $data['Auditfileupload']['file']['name'];
            $data['Auditfileupload']['register_datetime'] = date('Y-m-d H:i:s');
            $data['Auditfileupload']['audit_id'] = $id;
            $data['Auditfileupload']['register_user'] = '0';
            if ($this->Auditfileupload->save($data)) {
                // $this->Session->setFlash('Extension : ' . $data);
                $result = "<div id='status'>success</div>";
                $result .= "<div id='message'>Success uploa!</div>";
                //$this->Session->write($data);
            } else {
                //$this->Session->setFlash(__('The fileupload could not be saved. Please, try again.'));
                $result = "<div id='status'>error</div>";
                $result .= "<div id='message'>" . $this->Auditfileupload->validationErrors['file'] . "</div>";
            }
            echo $result;
            /*
              if($this->FileUpload->success){
              $this->set('photo', $this->FileUpload->finalFile);
              $this->Session->setFlash(__('Upload successfully', true));
              }else{
              $this->Session->setFlash($this->FileUpload->showErrors());
              } */
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function add_1($id = null) {
        //$audit_detail = $this->Audit_detail->find('all', array('conditions' => array('Audit_detail.audit_id' => $temp1,'Audit_detail.document_id'=>$temp0)));

        $this->layout = 'ajax';
        if ($this->request->is('post')) {
            if ($this->RequestHandler->isAjax()) {
                $this->autoRender = false;
                $this->Auditfileupload->create();
                $data = $this->request->data;
                $data['Fileupload']['audit_file_path'] = 'files/audit_details/';
                $data['Fileupload']['register_datetime'] = date('Y-m-d H:i:s');
                $data['Fileupload']['audit_id'] = $id;
                $data['Fileupload']['register_user'] = '0';
                if ($this->Auditfileupload->save($data)) {
                    $result = "<div id='status'>success</div>";
                    $result .= "<div id='message'>Succe upload!</div>";
                    //$this->Cookie->write($result)
                } else {
                    //$this->Session->setFlash(__('The fileupload could not be saved. Please, try again.'));
                    $result = "<div id='status'>error</div>";
                    $result .= "<div id='message'>" . $this->Auditfileupload->validationErrors['file'] . "</div>";
                }
                echo $result;
                /*
                  if($this->FileUpload->success){
                  $this->set('photo', $this->FileUpload->finalFile);
                  $this->Session->setFlash(__('Upload successfully', true));
                  }else{
                  $this->Session->setFlash($this->FileUpload->showErrors());
                  } */
            }
        }
    }

    public function edit($id = null) {
        $this->Auditfileupload->id = $id;
        if (!$this->Auditfileupload->exists()) {
            throw new NotFoundException(__('Invalid fileupload'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Auditfileupload->save($this->request->data)) {
                $this->Session->setFlash(__('The fileupload has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The fileupload could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Auditfileupload->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Auditfileupload->id = $id;
        if (!$this->Auditfileupload->exists()) {
            throw new NotFoundException(__('Invalid fileupload'));
        }
        if ($this->Auditfileupload->delete()) {
            $this->redirect(array('action' => 'index'));
        }
        $this->redirect(array('action' => 'index'));
    }

}
