<?php
// debug ( $data );
// debug($stores);
// debug($property);
// debug($items);
// die;
?>
<div class="mainarea">
    <div class="error_mes clearfix" style="display:block;margin: 5px 0 20px;"><h4 style="top: 10px; font-weight: bold;">以下の内容を削除します。よろしければOKボタンを押してください。</h4></div><br>
    <table id="summaryField">
        <col width="10%" />
        <col width="15%" />
        <col width="10%" />
        <col width="15%" />
        <col width="10%" />
        <col width="15%" />
        <tr>
            <?php echo $this->Form->create('AuditManager', array('url' => array('controller' => 'AuditManager', 'action' => 'delete_confirm', $data['AuditManager']['audit_id']))); ?>
            <th>店番</th>
            <td>
                <?php
                if ($stores ['0'] ['Store'] ['store_id'] < 10) {
                    echo '000' . $stores ['0'] ['Store'] ['store_id'];
                } else if ($stores ['0'] ['Store'] ['store_id'] >= 10 && $stores ['0'] ['Store'] ['store_id'] < 100) {
                    echo '00' . $stores ['0'] ['Store'] ['store_id'];
                } else if ($stores ['0'] ['Store'] ['store_id'] >= 100 && $stores ['0'] ['Store'] ['store_id'] < 1000) {
                    echo '0' . $stores ['0'] ['Store'] ['store_id'];
                } else if ($stores ['0'] ['Store'] ['store_id'] >= 1000) {
                    echo $stores ['0'] ['Store'] ['store_id'];
                }

                echo $this->Form->hidden('store_no', array(
                    'label' => false,
                    'div' => false,
                    'value' => $stores ['0'] ['Store'] ['store_id']
                ));
                echo $this->Form->hidden('audit_id', array('value' => $data['AuditManager']['audit_id']));
                ?>
            </td>
            <th>店舗名</th>
            <td>
                <?php
                echo $stores ['0'] ['Store'] ['name'];
                echo $this->Form->hidden('store_name', array(
                    'label' => false,
                    'div' => false,
                    'value' => $stores ['0'] ['Store'] ['name']
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
                    'value' => $property ['0'] ['Property'] ['puroperty_id']
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
                    'value' => $items ['0'] ['Item'] ['item_id']
                ));
                ?>
            </td>
            <th>担当者</th>
            <td colspan="4">
                <?php
                echo $user_create['User']['user_name'];
                ?>
            </td>
        </tr>
        <tr>
            <th>状態</th>
            <td colspan="5">
                <?php echo $data_status; ?>
            </td>
        </tr>
        <tr>
            <th>監査予定日</th>
            <td colspan="5">
                <?php
                //debug($data);
                if (strlen($data['AuditManager']['audit_scheduled_date']) > 0) {
                    $date = $data['AuditManager']['audit_scheduled_date'];
                    $date = date('Y年n月j日', strtotime($date));
                } else
                    $date = '';
                echo $date;
                ?>
            </td>
        </tr>

    </table>

</div>
<div id="actionField" class="clearfix">
    <?php echo $this->Html->link('キャンセル', array('controller' => 'AuditManager', 'action' => 'index', $data['AuditManager']['audit_id']), array('class' => 'btnCanceller linkCanceller posLeft')); ?>
    <button class="btnStandard linkCanceller posright" type="submit">OK</button>
</div>
<?php echo $this->Form->end(); ?>
