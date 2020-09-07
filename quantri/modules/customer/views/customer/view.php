<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// dbg($this->context);
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
                            <th colspan ="4" class="text-center"><h1>Thông tin khách hàng : <?= $model->fullname ?></h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tên đầy đủ: <?= $model->fullname ?></td>
                            <td>Số điện thoại : <?= $model->phone ?></td>
                            <td>Email : <a href="mailto:<?= $model->email ?>"><?= $model->email ?></a></td>
                            <td rowspan="2"><?= $model->getAttributeLabel('status') ?> : 
                                <button id="orderStatus" onclick="changeStatus(<?= $model->id ?>)" class="btn btn-outline btn-rounded btn-<?= ($model->status == 0) ?'danger':'info'?>" style="width: 45%" data-url="<?= Url::to(['/customer/customer/quickchange', 'id' => $model->id],true) ?>" data-field="status"><?= ($model->status == 0) ? 'Chưa tiếp nhận':' Đã tiếp nhận' ?></button> 
                            </td>
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('created_at').' : '.Yii::$app->formatter->asDateTime($model->created_at, "php: H:i:s d-m-Y"); ?></td>
                            <td><?= $model->getAttributeLabel('updated_at').' : '.Yii::$app->formatter->asDateTime($model->updated_at, "php: H:i:s d-m-Y"); ?></td>
                            <td><b><?= $model->getAttributeLabel('userUpdated') ?>  : <?= isset($model->user->username)? $model->user->username : 'Chưa'; ?></b></td>
                            
                            
                        </tr>
                        <tr>
                            <td>Url : </td>
                            <td colspan="3">
                                <?php 
                                    // dbg($model->newslink);
                                switch ($model->type) {
                                    case 'news':
                                    {
                                        try {
                                            $return =  Html::a(Html::img($model->newslink->images,['height'=>'34']).$model->newslink->name,Yii::$app->request->gethostInfo().$model->url);
                                            if(!$return){
                                                throw new Exception('Liên kết ảnh hoặc link ko tồn tại '.$return);
                                            }
                                            echo $return;
                                        } catch (Exception $e) {
                                            $whitelist = array('127.0.0.1', "::1");
                                            if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                                 pr($e->__toString());
                                             }else {
                                                echo $e->getMessage();
                                                echo '<br>Liên kết không có hoặc bị lỗi';
                                            }
                                        }
                                        break;
                                    }
                                    case 'product':
                                    {
                                        try {
                                            $return =  Html::a(Html::img($model->newslink->images,['height'=>'34']).$model->newslink->name,Yii::$app->request->gethostInfo().$model->url);
                                            if(!$return){
                                                throw new Exception('Liên kết ảnh hoặc link ko tồn tại '.$return);
                                            }
                                            echo $return;
                                        } catch (Exception $e) {
                                            $whitelist = array('127.0.0.1', "::1");
                                            if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                                 pr($e->__toString());
                                             }else {
                                                echo $e->getMessage();
                                                echo '<br>Liên kết không có hoặc bị lỗi';
                                            }
                                        }
                                        break;
                                    }

                                    default:
                                    // echo $model->type;
                                     echo Html::a($model->url,$model->url);
                                    break;
                                }
                                
                                 ?>
                            </td>
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