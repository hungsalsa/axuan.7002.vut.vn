<?php foreach ($data as $keyi => $model): ?>
<tr class="row_image" id="row_image_<?= $model->idIma ?>">
    <td><?= $keyi+1 ?></td>
    <td>
        <img src="<?= $model->image ?>" height="60px" id="imageFile_<?= $model->idIma ?>">
        <span><?= Yii::$app->formatter->asDatetime($model->created_at, "php:d-m-Y H:i:s") ?></span>
        <span><?= Yii::$app->formatter->asDatetime($model->updated_at, "php:d-m-Y H:i:s") ?></span>
    </td>
    <td><?= $model->order ?></td>

    <td>
        <a onclick="editImagePro(<?= $model->idIma ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
        <!-- <a href="javascript:void(0)" data-toggle="tooltip" data-id="<?=$model->idIma ?>" data-original-title="Edit" class="EditProImage"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> -->
        <a onclick="deleteImagePro(<?= $model->idIma ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
    </td>
</tr>
<?php endforeach ?>