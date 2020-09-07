<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\Menus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$menuType = [
    1 => 'Sản phẩm',
    2 => 'Bài viết',
    3 => 'Download',
    4 => 'Tự tạo',
    5 => 'Album',
];
?>
<div class="menus-view">

    <h1>Chi tiết Menu : <?= $model->name ?> </h1>

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
    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
        <div class="panel panel-default">
            <!-- <div class="panel-heading">Chi tiết Menu : <?= $model->name ?></div> -->
            <div class="panel-wrapper collapse in">
                <table class="table table-hover">
                    <!-- <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td><?= $model->getAttributeLabel('title'); ?> : <?= $model->title ?></td>
                            <td><?= $model->getAttributeLabel('parent_name'); ?> : <?= $model->parent_name ?></td>
                            <td><?= $model->getAttributeLabel('type'); ?> : <?= $menuType[$model->type] ?></td>
                        </tr>
                        <tr>
                            <?php //dbg($model->categoryPro->cateName) ?>
                            <td><?= $model->getAttributeLabel('link_cate'); ?> : 
                                <?php 
                                switch ($model->type) {
                                    case 1:{
                                        try {
                                            if(!$link_cate = $model->categoryPro->cateName){
                                                throw new Exception('Invalid Link: '.$link_cate);
                                            }
                                            echo $link_cate;
                                            } catch (Exception $e) {
                                                $whitelist = array('127.0.0.1', "::1");
                                                if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                                   // pr($e->__toString());
                                                    echo $e->getMessage();
                                               }else {
                                            // echo $e->getMessage();
                                                    echo "<br>Url bị lỗi";
                                                }
                                            }

                                        break;
                                        }
                                    case 2:
                                    {
                                        try {
                                            if(!$link_cate = $model->cateNews->cateName){
                                                throw new Exception('Invalid Link: '.$link_cate);
                                            }
                                            echo $link_cate;
                                            } catch (Exception $e) {
                                                $whitelist = array('127.0.0.1', "::1");
                                                if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                                   // pr($e->__toString());
                                                    echo $e->getMessage();
                                               }else {
                                            // echo $e->getMessage();
                                                    echo "<br>Url bị lỗi";
                                                }
                                            }

                                        break;
                                        }
                                    
                                    case 3:
                                    {
                                        try {
                                            if(!$link_cate = $model->cateNews->cateName){
                                                throw new Exception('Invalid Link: '.$link_cate);
                                            }
                                            echo $link_cate;
                                            } catch (Exception $e) {
                                                $whitelist = array('127.0.0.1', "::1");
                                                if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                                   // pr($e->__toString());
                                                    echo $e->getMessage();
                                               }else {
                                            // echo $e->getMessage();
                                                    echo "<br>Url bị lỗi";
                                                }
                                            }

                                        break;
                                        }
                                    default:
                                    $link_cate = 'Không';
                                    break;
                                }


                                ?>
                            </td>
                            <td><?= $model->getAttributeLabel('order'); ?> : <?= $model->order ?></td>
                            <td><?= $model->getAttributeLabel('image'); ?> : <?= Html::img($model->image, ['alt'=>'some', 'class'=>'thing','style'=>'max-height:50px']);?></td>
                            
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('status'); ?> : <?= $model->status ?></td>
                            <td><?= $model->getAttributeLabel('introduction'); ?> : <?= $model->introduction ?></td>
                            <td><?= $model->getAttributeLabel('created_at'); ?> : <?= \Yii::$app->formatter->asDatetime($model->created_at, "php:H:i:s d-m-Y"); ?></td>
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('updated_at'); ?> : <?= \Yii::$app->formatter->asDatetime($model->updated_at, "php:H:i:s d-m-Y"); ?></td>
                            <td><?= $model->getAttributeLabel('userCreated'); ?> : <?= isset($model->user)? $model->user->username : '' ?></td>
                            <td><?= $model->getAttributeLabel('userUpdated'); ?> : <?= isset($model->user_update->username)? $model->user_update->username : '' ?></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

</div>
<div class="clearfix"></div>
<div class="row">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'summary' => "Từ {begin} đến {end} menu con => trong tổng {totalCount}",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // [
            //     'attribute' =>'name',
            //     'contentOptions' => ['class' => 'text-center'],
            //     'format'=>'html',
            //     'content' => function($model,$key,$index, $column) {
            //         $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
            //         Html::textInput('name', $model->name, ['class'=>'form-control col-md-4','id'=>'menuName'.$key]).
            //         Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveMenuName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/menus/quickchange']),'data-id'=>$key,'data-field'=>'name']).
            //         Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
            //         "</div>";
            //         return Html::button($model->name,$options = [
            //             'data-field'=>'name',
            //             'data-id'=>$key,
            //             'id'=>'buttonname'.$key,
            //             'class'=>'btn btn-block btn-outline btnName Quickchange change',
            //         ]).$html;
            //     },
            // ],
            [
               'attribute' => 'name',
               'format' => 'html',
               'value'=>function ($data){
                // dbg($data->parent_id);
                // dbg($dataMenu);
                // return Html::a($data->name,Url::toRoute(['product/index', 'cat' => 'all']));
                return Html::a($data->name, ['view', 'id' => $data->id], ['class' => 'btn btn-outline btn-primary']);
                },
            ],
            [
               'attribute' => 'type',
               'format' => 'html',
               'value'=>function ($data) use($menuType){
                // $menuType = [
                //         1 => 'Danh mục sản phẩm',
                //         2 => 'Danh mục bài viết',
                //         3 => 'Trang download',
                //         4 => 'Tự tạo'
                //     ];
                // dbg($data->parent_id);
                // dbg($dataMenu);
                return $menuType[$data->type];
                },
            ],
            // [
            //     'attribute'=>'type',
            //     'value'=>function($data)
            //     {
                    
            //         return ;
            //     }
            // ],
            'parent_name',
/*
            [
                'attribute' =>'parent_id',
                'value' =>function ($data)
                {
                    if ($data->parent_id==0) {
                        return 'Root';
                    } else {
                        return $data->parent->name;
                        
                    }
                },
            ],*/

            // [
            //     'attribute' =>'parent_id',
            //     // 'headerOptions' => ['width' => '20%'],
            //     'format'=>'html',
            //     'content' => function($model,$key,$index, $column) use($dataMenu){
            //         // unset($dataMenu[$model->id]);
            //         // pr($data);
            //         // dbg($dataMenu);
            //         $html = "<div class=\"updateProduct$key proUpdate\">".
            //         Select2::widget([
            //             'name' => 'parent_id',
            //             'value' => $model->parent_id,
            //             'data' => $dataMenu,
            //             'pluginOptions' => [
            //                 'allowClear' => true
            //             ],
            //             'options' => [
            //                  // 'allowClear'=> true,
            //                 'id'=>'parent_id'.$key,
            //                 'class'=>'form-control',
            //                 'placeholder' => 'Select provinces ...',
            //             ],
            //         ]).
            //         Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 saveMenuName','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/menus/quickchange']),'data-id'=>$key,'data-field'=>'parent_id']).
            //         Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
            //         "</div>";

            //         return Html::tag('span',isset($dataMenu[$model->parent_id])? $dataMenu[$model->parent_id]:'',$options = [
            //             'data-id'=>$key,
            //             'data-field'=>'parent_id',
            //             'id'=>'menuName'.$key,
            //             'class'=>'text-info btn btn-outline btn-info Quickchange change text-primary',
            //         ]).$html;
            //     },
            // ],


             // 'title',
            // 'slug',
            
            /*[
                'attribute'=>'link_cate',
                'value'=>'category.cateName'
            ],*/
            // 'introduction:ntext',
            [
                'attribute' =>'order',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['max' => 998,'class'=>'form-control col-md-4','id'=>'order'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveOrder',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/menus/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->order,$options = [
                        'data-field'=>'order',
                        'data-id'=>$key,
                        'id'=>'buttonOrder'.$key,
                        'class'=>'btn btn-block btn-outline btn-primary Quickchange change',
                    ]).$html;
                },
            ],
            
            [
                'attribute' =>'status',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $classbtn = ($model->status==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->status==0)?' Ẩn ':'Kích hoạt',$options = [
                        'data-id'=>$key,
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/menus/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            // [
            //     'attribute' =>'status',
            //     'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
            //     'format'=>'html',
            //     'content' => function($model,$key,$index, $column) {
            //         return Html::button(($model->status==0)?'Hidden':'Active',$options = [
            //             'data-field'=>'status',
            //             'data-id'=>$key,
            //             'data-value'=>$model->status,
            //             'id'=>'status'.$key,
            //             "data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/menus/quickchange']),
            //             'class'=>'btn btn-block btn-outline btn-info QuickStatus change',
            //         ]);
            //     },
            // ],
            /*[
                'attribute'=>'created_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:10%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],*/
            [
                'attribute'=>'updated_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:10%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 8%','class'=>'text-center'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{view}  {update}  {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('setting/menus/view'),
                    'update' => Yii::$app->user->can('setting/menus/update'),
                    'delete' => Yii::$app->user->can('setting/menus/delete')
                ],
            ],
        ],
    ]); ?>
</div>
<?php 
$this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/menu_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>