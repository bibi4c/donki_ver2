<?php

$options = array();
foreach ($arrCategory as $category) {
    $options += array(
        $category ['Category'] ['category_id'] => $category ['Category'] ['category_name']
    );
}
if (count($options) == 0)
    $options = array('' => '');
echo $this->Form->input('category', array(
    'options' => $options,
    'style' => 'width: 30%; height: 22px;',
    'label' => false
));
?>