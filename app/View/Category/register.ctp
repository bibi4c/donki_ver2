<script>
    jQuery(function() {
        jQuery('.timePicker').datepicker({
            timeFormat: 'yyyy/m/d',
            'controlType': 'select'
        });
    });
</script>
<style>
    table#serchfield th {
        text-align: center;
        color: black;
        width: 15%;
    }
    #error_mes{
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #999999;
        margin: 5px 0 30px;
        padding: 10px;
        display: none;
        font-weight: bold;
        font-size: 15px;
        color: red;
    }
</style>
<div id="error_mes" class="clearfix">

</div><br>
<h4 style="top: 10px; color: red">
    <?php
    if (isset($e_message))
        echo '<div class="error_mes clearfix" style="display:block">' . $e_message . '</div>'
        ?> 
</h4>
<?php //debug ( $data ); ?>
<div id="result_category"></div>
<table id="summaryField">
    <col width="10%" />
    <col width="60%" />
<?php echo $this->Form->create('Document', array('url' => array('controller' => 'Document', 'action' => 'register'))); ?>
    <tr>
        <th>ジャンル</th>
        <td>
            <?php
            $options = array(
            );
            foreach ($data_item as $item) {
                $options += array(
                    $item ['Item'] ['item_id'] => $item ['Item'] ['name']
                );
            }
            echo $this->Form->input('item', array(
                'options' => $options,
                'style' => 'width: 30%; height: 22px;',
                'default' => $data ['Document'] ['item_id'],
                'label' => false,
            ));
            ?>
        </td>
    </tr>
    <tr>
        <th>カテゴリ</th>
        <td>
            <?php
            $options = array();
            foreach ($data_category as $category) {
                $options += array(
                    $category ['Category'] ['category_id'] => $category ['Category'] ['category_name']
                );
            }
            if (count($options) == 0)
                $options = array('' => '');
            echo $this->Form->input('category', array(
                'options' => $options,
                'style' => 'width: 30%; height: 22px;',
                'default' => $data ['Document'] ['category_id'],
                'label' => false
            ));
            ?>
        </td>
    </tr>
    <tr>
        <th>引き継ぎ対象</th>
        <td>
            <?php
            echo $this->Form->input('transfer_flag', array(
                'type' => 'radio',
                'options' => array(
                    '1' => '　臨点チェックシート引き継ぎあり　　',
                    '0' => '　臨点チェックシート引き継ぎなし'
                ),
                'label' => false,
                'legend' => false,
                'default' => $data ['Document']['transfer_flag']
            ));
            ?>
        </td>
    </tr>
    <tr>
        <th>有効開始日</th>
        <td>
<?php echo $this->Form->input('start_date', array('class' => 'timePicker', 'type' => 'text', 'style' => 'width: 29%', 'label' => false, 'value' => $data['Document']['start_date'], 'required' => FALSE)); ?>
        </td>
    </tr>
    <tr>
        <th>有効終了日</th>
        <td>
<?php echo $this->Form->input('end_date', array('class' => 'timePicker', 'type' => 'text', 'style' => 'width: 29%', 'label' => false, 'value' => $data['Document']['end_date'], 'required' => FALSE)); ?>
        </td>
    </tr>
</table>
<table class="summaryObject">

    <caption style="text-align: center">内容</caption>
    <tr>
        <td height="200px">
<?php echo $this->Form->input('contents', array('class' => 'timePicker', 'type' => 'textarea', 'style' => 'width: 100%; height: 200px', 'label' => false, 'value' => $data['Document']['contents'], 'required' => FALSE)); ?>
        </td>
    </tr>
</table>

<div id="actionField" class="clearfix">
<?php echo $this->Html->link('戻る', array('controller' => 'Document', 'action' => 'index'), array('class' => 'btnCanceller linkCanceller posLeft')); ?>
    <button class="btnStandard linkCanceller posright" type="submit">登録</button>
</div>
<?php echo $this->Form->end(); ?>
<script>
    var tt = ($(".error-message:first").text());
    $("#error_mes").text(tt);
    if (tt.length > 0)
        $("#error_mes").show();
</script>
<script>
    $("select[name='data[Document][item]']").change(function() {
        var curr = $("select[name='data[Document][item]']").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array('controller' => 'document', 'action' => 'itemsearch')) ?>',
            data:
                    {
                        curr: curr
                    },
            success: function(data) {//alert(data);
                $('#DocumentCategory').html(data).show();
            },
            error: function() {
                alert("error");
            }

        });
    })
</script>