<?php foreach ($model as $key => $value): ?>

    <tr class="row_versions" id="row_versions_<?= $value->id ?>">
        <td><?= $key+1 ?></td>
        <td id="versionDate_<?=$value->id ?>">
            <?=  Yii::$app->formatter->asDate($value->date, 'd-MM-Y');  ?>
        </td>
        <td id="versionName_<?=$value->id ?>">
            <?= $value->name ?>
        </td>
        <td>
            <?php if ($value->price_sale_1>0): ?>
            <span id="versionPrice_1<?=$value->id ?>"><?= number_format((int) $value->price_sale_1, 0, ',', '.') ?></span> /
            <del id="versionPrice_sale_1<?=$value->id ?>"><?= number_format((int) $value->price_1, 0, ',', '.') ?></del>
            <?php else: ?>
                <span id="versionPrice_1<?=$value->id ?>">Không / </span>
                <span id="versionPrice_sale_1<?=$value->id ?>"><?= number_format((int) $value->price_1, 0, ',', '.') ?></span>
            <?php endif ?>
        </td>

        <td id="versionPrice_2<?=$value->id ?>">
            <?= number_format((int) $value->price_2, 0, ',', '.') ?>
        </td>
        <td id="versionPrice_3<?=$value->id ?>">
            <?= number_format((int) $value->price_3, 0, ',', '.') ?>
        </td>

        <td>
            <a id="versionStatus_<?=$value->id ?>" onclick="statusVersionPro(<?=$value->id ?>)" href="javascript:void(0)" class="btn btn-info btn-sm"> <?= ($value->status==1)?'Kích hoạt':' Ẩn ' ?> </a>

        </td>

        <td>
            <a onclick="editVersionPro(<?= $value->id ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
            <a onclick="deleteVersionPro(<?=$value->id ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
        </td>
    </tr>
    <?php endforeach ?>