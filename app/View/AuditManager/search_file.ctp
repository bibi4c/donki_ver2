<?php
foreach ($fileuploads as $data2) {
    echo "<p>" . $data2['Audit_file']['audit_file_name'];
    //echo $this->Form->postLink(__(' 削除'), array('controller'=>'Fileuploads','action' => 'delete', $data2['Audit_detail_file']['audit_detail_file_id']), null, __('Are you sure you want to delete %s?', $data2['Audit_detail_file']['audit_detail_file_name']));
    $urldelete = $this->Html->url(array('controller' => 'Auditfileuploads', 'action' => 'delete', $data2['Audit_file']['audit_file_id']));
    ?>
    <a class="file_<?php echo $data2['Audit_file']['audit_file_id']; ?>" href="javascript:void(0)" onclick='deleteFile("<?php echo $urldelete ?>", "<?php echo $data2['Audit_file']['audit_file_id']; ?>")'>削除</a>
    <?php
    echo "</p>";
}
?>	