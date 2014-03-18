
<div class="mainarea">
    <div class="error_mes clearfix" style="display:block;margin: 5px 0 20px;"><h4 style="top: 10px; font-weight: bold;">以下の内容を登録します。よろしければOKボタンを押してください。</h4></div><br>
    <table id="summaryField">
        <col width="10%" />
        <col width="15%" />
        <col width="10%" />
        <col width="15%" />
        <col width="10%" />
        <col width="15%" />
        <?php echo $this->Form->create('AuditManager', array('type' => 'post', 'url' => array('controller' => 'AuditManager', 'action' => 'change_confirm', $audit_id))); ?>
        <tr>
            <th>店番</th>
            <td>
                <?php
                echo $data['AuditManager'] ['store_no'];

                echo $this->Form->hidden('store_no', array(
                    'label' => false,
                    'div' => false,
                    'value' => $data['AuditManager'] ['store_no']
                ));
                echo $this->Form->hidden('audit_id', array('label' => false, 'value' => $audit_id))
                ?>
            </td>
            <th>店舗名</th>
            <td>
                <?php
                echo $data['AuditManager'] ['store_name'];
                echo $this->Form->hidden('store_name', array(
                    'label' => false,
                    'div' => false,
                    'value' => $data['AuditManager'] ['store_name']
                ));
                ?>
            </td>
            <th>属性</th>
            <td>
                <?php
                echo $property ['0'] ['Property'] ['name'];
                echo $this->Form->hidden('property_id', array(
                    'label' => false,
                    'div' => false,
                    'value' => $data['AuditManager'] ['property_id']
                ));
                ?>
            </td>
        </tr>
        <tr>
            <th>ジャンル</th>
            <td colspan="1">
                <?php
                echo $items ['0'] ['Item'] ['name'];
                echo $this->Form->hidden('item_id', array(
                    'label' => false,
                    'div' => false,
                    'value' => $data['AuditManager'] ['item_id']
                ));
                ?>
            </td>
            <th>担当者</th>
            <td colspan="3">
                <?php
                echo $user_create['User']['user_name'];
                ?>
            </td>
        </tr>
        <tr>
            <th>状態</th>
            <td colspan="5">
                <?php
                echo $data_status;
                echo $this->Form->hidden('status', array(
                    'label' => false,
                    'div' => false,
                    'value' => $data['AuditManager'] ['status']
                ));
                ?>
            </td>

        </tr>
        <tr>
            <th>是正通知日</th>
            <td colspan="5">
                <?php
                if (strlen($data ['AuditManager'] ['correct_information_date']) > 0) {
                    $date = $data ['AuditManager'] ['correct_information_date'];
                    $date = date('Y年n月j日', strtotime($date));
                } else
                    $date = '';
                echo $date;

                echo $this->Form->hidden('correct_information_date', array('type' => 'text', 'value' => $data['AuditManager']['correct_information_date'], 'label' => false));
                ?>
            </td>
        </tr>
        <tr>
            <th>是正完了予定日</th>
            <td colspan="5">
                <?php
                if (strlen($data ['AuditManager'] ['correct_end_scheduled_date']) > 0) {
                    $date = $data ['AuditManager'] ['correct_end_scheduled_date'];
                    $date = date('Y年n月j日', strtotime($date));
                } else
                    $date = '';
                echo $date;
                echo $this->Form->hidden('correct_end_scheduled_date', array('type' => 'text', 'value' => $data['AuditManager']['correct_end_scheduled_date'], 'label' => false));
                ?>
            </td>
        </tr>
    </table>

    <table class="summaryObject">
        <caption>コメント</caption>
        <tr>
            <td>
                <?php
                $text = $data ['AuditManager'] ['comment'];
                echo nl2br(h($text));
                echo $this->Form->hidden('comment', array('type' => 'text', 'label' => false, 'value' => $data['AuditManager']['comment']));
                ?>
            </td>
        </tr>
    </table>

    <table class="summaryObject">
        <caption>是正勧告書</caption>
        <tr>
            <td>
                <?php
                //debug($data_audit_file);
                if (count($data_audit_file) > 0) {
                    foreach ($data_audit_file as $audit_file) {
                        echo $audit_file['Audit_file']['audit_file_name'] . '<br>';
                    }
                } else
                    echo '添付ファイルがありません';
                ?>
            </td>
        </tr>
    </table>
    <div id="actionField" class="clearfix">
<?php echo $this->Html->link('キャンセル', array('controller' => 'AuditManager', 'action' => 'view', $data['AuditManager']['audit_id']), array('class' => 'btnCanceller linkCanceller posLeft')); ?>
        <button class="btnStandard linkCanceller posright" type="submit">OK</button>
    </div>
</div>
<?php echo $this->Form->end(); ?>