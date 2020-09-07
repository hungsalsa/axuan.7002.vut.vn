<?php
$row = '<label class="control-label">Tag Multiple</label>';
$row .= "Select2::widget([
    'name' => 'color_2',
    // 'value' => ['red', 'green'], // initial value
    // 'data' => $data,
    'maintainOrder' => true,
    'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
])";
 ?>