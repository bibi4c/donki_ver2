<?php
// 	debug($data);
// 	die;
//debug($data_audit_detail_file);
if (isset($this->request->pass['2'])) {
    $var1 = $this->request->pass['2'];
    $var2 = $this->request->pass['3'];
} else {
    $var1 = 0;
    $var2 = 0;
}
?>

<div class="mainarea">
    <div class="error_mes clearfix" style="display:block;margin: 5px 0 20px;"><h4 style="top: 10px; font-weight: bold;">以下の内容を登録します。よろしければOKボタンを押してください。</h4></div><br>
    <table class="TB040_table1">
        <?php echo $this->Form->create('Category', array('type' => 'post', 'url' => array('controller' => 'Category', 'action' => 'change_confirm', $data['Category']['category_id'], $data['Category']['audit_id'], $var1, $var2))); ?>
        <tr>
            <td id="TB040_table1_column1">検査カテゴリ</td>
            <td id="TB040_table1_column2">
                <?php
                echo $data['Category']['category_name'];
                echo $this->Form->hidden('category_name', array('label' => false, 'value' => $data['Category']['category_name']));
                echo $this->Form->hidden('category_id', array('label' => false, 'value' => $data['Category']['category_id']));
                echo $this->Form->hidden('audit_id', array('label' => false, 'value' => $data['Category']['audit_id']));
                ?>
            </td>
            <th id="TB040_table1_column3">評価有無</th>
            <td id="TB040_table1_column4">
                <h3>
                    <?php
                    echo $valid_flag;
                    echo $this->Form->hidden('valid_flag', array('label' => false, 'value' => $data['Category']['valid_flag']))
                    ?>
                </h3>
            </td>
        </tr>
    </table>


    <table class="TB040_table2">
        <tr>
            <th class="TB040_table2_column1"></th>
            <th class="TB040_table2_column2">評価</th>
            <th class="TB040_table2_column3">ファイル</th>
        </tr>
        <?php foreach ($document_all as $document) { ?>
            <tr>
                <?php //debug($data);die;
                ?>
                <td class="TB040_table2_column1"><h3>
                        <?php
                        echo $document['Document']['contents'];
                        echo $this->Form->hidden($document['Document']['document_id'], array('label' => false, 'value' => $document['Document']['document_id']));
                        ?>
                    </h3></td>
                <td class="TB040_table2_column2">
                    <h3><?php
                    if ($data['Category']['valid_flag'] == 1) {
                        if ($data['Category']['judgment_' . $document['Document']['document_id']] == 1) {
                            $judgment = '良';
                        } else if ($data['Category']['judgment_' . $document['Document']['document_id']] == 2) {
                            $judgment = '可';
                        } else if ($data['Category']['judgment_' . $document['Document']['document_id']] == 3) {
                            $judgment = '不可';
                        } else if ($data['Category']['judgment_' . $document['Document']['document_id']] == 4) {
                            $judgment = '該当なし';
                        } else {
                            $judgment = '';
                        }
                        echo $judgment;
                        echo $this->Form->hidden('judgment_' . $document['Document']['document_id'], array('label' => false, 'value' => $data['Category']['judgment_' . $document['Document']['document_id']]));
                    } else {
                        echo '該当なし';
                        echo $this->Form->hidden('judgment_' . $document['Document']['document_id'], array('label' => false, 'value' => '4'));
                    }
                        ?></h3>
                </td>
                <td class="TB040_table2_column3">
                    <?php
                    if ($data['Category']['valid_flag'] == 1 && isset($data_audit_detail_file[$document['Document']['document_id']])) {
                        $data1 = $data_audit_detail_file[$document['Document']['document_id']];
                        foreach ($data1 as $data2) {
                            echo "<p>" . $data2['Audit_detail_file']['audit_detail_file_name'] . "</p>";
                        }
                    }
                    ?>
                </td>

            </tr>
        <?php } ?>
    </table>
</div>

<div id="actionField" class="clearfix">
    <?php echo $this->Html->link('キャンセル', array('controller' => 'Category', 'action' => 'view', $data['Category']['category_id'], $data['Category']['audit_id']), array('class' => 'btnCanceller linkCanceller posLeft')); ?>
    <button class="btnStandard linkCanceller posright" type="submit">OK</button>
</div>