<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// echo $model->getAttributeLabel('company_name');
// dbg( $model->attributes);
// dbg( Yii::info($model->attributes,'company_name'));
?>
<div class="customers-view">


    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <!-- <div class="panel-heading"></div> -->
                <div class="panel-body">
                    <table class="table">
                    <thead>
                        <tr>
                            <th colspan ="4" class="text-center"><h1>Thông tin Hội viên : <?= $model->company_name ?></h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $model->getAttributeLabel('company_name') ?>: <?= $model->company_name ?></td>
                            <td><?= $model->getAttributeLabel('phone') ?> : <?= $model->phone ?></td>
                            <td><?= $model->getAttributeLabel('email') ?> : <a href="mailto:<?= $model->email ?>"><?= $model->email ?></a></td>
                            <td rowspan="2"><?= $model->getAttributeLabel('status') ?> : 
                                <button id="orderStatus" onclick="changeStatus(<?= $model->id ?>)" class="btn btn-outline btn-rounded btn-<?= ($model->status == 0) ?'danger':'info'?>" style="width: 45%" data-url="<?= Url::to(['/customer/contacts/quickchange', 'id' => $model->id]) ?>" data-field="status"><?= ($model->status == 0) ? 'Chưa tiếp nhận':' Đã tiếp nhận' ?></button> 
                            </td>
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('address') ?> : <?= $model->address ?></td>
                            <td><?= $model->getAttributeLabel('tax_code') ?> : <?= $model->tax_code ?></td>
                            <td><?= $model->getAttributeLabel('manager') ?> : <?= $model->manager ?></td>
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('gender') ?> : <?= ($model->gender==0)?'Nam':'Nữ' ?></td>
                            <td><?= $model->getAttributeLabel('birth_day') ?> : <?= Yii::$app->formatter->asDate($model->birth_day) ?></td>
                            <td><?= $model->getAttributeLabel('date_bussiness') ?> : <?= Yii::$app->formatter->asDate($model->date_bussiness) ?></td>
                            <td><?= $model->getAttributeLabel('business') ?> : <?= $model->business ?></td>
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('website') ?> : <?= $model->website ?></td>
                            <td><?= $model->getAttributeLabel('created_at').' : '.Yii::$app->formatter->asDatetime($model->created_at, "php: H:i:s d-m-Y"); ?></td>
                            <td><?= $model->getAttributeLabel('updated_at') ?> : <?= ($model->created_at == $model->updated_at)?' Chưa ' : Yii::$app->formatter->asDateTime( $model->updated_at, "php: H:i:s d-m-Y"); ?></td>
                            <td><b><?= $model->getAttributeLabel('userUpdated') ?>  : <?= isset($model->user->username)? $model->user->username : 'Chưa'; ?></b></td>
                            
                            
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php
$this->registerJsFile("@web/js/product/product_order.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>