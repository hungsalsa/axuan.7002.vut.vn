<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$productCategory = isset(Yii::$app->params['productCategory']['arrayCateName'])?Yii::$app->params['productCategory']['arrayCateName'] : [];
$newsCategories = isset(Yii::$app->params['newsCategories']['arrayCateName'])?Yii::$app->params['newsCategories']['arrayCateName'] : [];
?>
<div class="setting-modules-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa Module', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'type_module',
            [
                'attribute'=>'parent_id',
                'value'=>function ($data) use ($dataModules){
                    if ($data->parent_id==0) {
                        return 'root';
                    } else {
                        try {
                            if(!$name = $data->modulecha->name){
                                throw new Exception('Invalid Link: '.$name);
                            }
                            return $dataModules[$data->parent_id];
                        } catch (Exception $e) {
                            $whitelist = array('127.0.0.1', "::1");
                            if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                               // pr($e->__toString());
                                return $e->getMessage();
                           }else {
                                return $e->getMessage(). "<br>Url bị lỗi";
                            }
                        }
                         
                    }
                }
            ],
            [
                'attribute'=>'cate_id',
                'value'=> function ($data) use ($productCategory,$newsCategories){
                    if($data->type_module=='product'){
                        // dbg($productCategory);
                        try {
                            if(!$link_cate = $data->category->cateName){
                                throw new Exception('Invalid Link: '.$link_cate);
                            }
                            return $link_cate;
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
                    }elseif ($data->type_module=='news') {
                        try {
                            if(!$link_cate = $data->dmuctin->cateName){
                                throw new Exception('Invalid Link: '.$link_cate);
                            }
                            return $link_cate;
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
                        // dbg($newsCategories);
                    }else {
                        return '';
                    }
                },
            ],
            [
                'attribute'=>'page_show',
                'value'=> function ($data){
                    $array_show = Yii::$app->params['modules']['page_show'];
                    $show = [];
                    $pa_show =json_decode($data->page_show);
                    if(is_array($pa_show)){
                        foreach ($pa_show as $value) {
                            $show[] = $array_show[$value];
                        }
                    }
                    return implode(" || ",$show);
                }
            ],
            'order',
            'hienthi',
            'positions',
            'content:ntext',
            [
                'attribute'=>'status',
                'label'=>'Trạng thái',
                'value'=> function ($data){
                    return ($data->status==0)? ' Ẩn ' :'Kích hoạt';
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute'=>'userCreated',
                'value'=> function ($data){
                    try {
                        if(!$username = $data->usercreate->username){
                            throw new Exception('Invalid Link: '.$username);
                        }
                        return $username;
                    } catch (Exception $e) {
                        $whitelist = array('127.0.0.1', "::1");
                        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                               // pr($e->__toString());
                            return $e->getMessage();
                        }else {
                            return $e->getMessage(). "<br>Url bị lỗi";
                        }
                    }
                }
            ],
            [
                'attribute'=>'userCreated',
                'value'=> function ($data){
                    try {
                        if(!$username = $data->userupdate->username){
                            throw new Exception('Invalid Link: '.$username);
                        }
                        return $username;
                    } catch (Exception $e) {
                        $whitelist = array('127.0.0.1', "::1");
                        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                               // pr($e->__toString());
                            return $e->getMessage();
                        }else {
                            return $e->getMessage(). "<br>Url bị lỗi";
                        }
                    }
                }
            ]
        ],
    ]) ?>

<?php if($dataProvider->getTotalCount()>0): ?>

<div class="danhsach">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' =>'name',
                'format'=>'raw',
                'value'=>function ($data)
                {
                    return Html::a($data->name,['view','id'=>$data->id]);
                },
            ],
            /*[
                'attribute' =>'name',
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                    Html::textInput('name', $model->name, ['class'=>'form-control col-md-4','id'=>'name'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key,'data-field'=>'name']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->name,$options = [
                        'data-field'=>'name',
                        'data-id'=>$key,
                        'id'=>'buttonname'.$key,
                        'class'=>'btn btn-block btn-outline btnName Quickchange change',
                    ]).$html;
                },
            ],*/
            // [
            //     'attribute' =>'positions',
            //     'contentOptions' => ['class' => 'text-center'],
                // 'format'=>'html',
                // 'content' => function($model,$key,$index, $column) {
                //     $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                //     Html::textInput('positions', $model->positions, ['class'=>'form-control col-md-4','id'=>'positions'.$key]).
                //     Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key,'data-field'=>'positions']).
                //     Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                //     "</div>";
                //     return Html::button($model->positions,$options = [
                //         'data-field'=>'positions',
                //         'data-id'=>$key,
                //         'id'=>'buttonname'.$key,
                //         'class'=>'btn btn-block btn-outline btnName Quickchange change',
                //     ]).$html;
                // },
            // ],
            // 'parent_id',
            [
                'attribute'=>'parent_id',
                'value'=>function ($data) use ($dataModules){
                    if ($data->parent_id==0) {
                        return 'root';
                    } else {
                        try {
                            if(!$name = $data->modulecha->name){
                                throw new Exception('Invalid Link: '.$name);
                            }
                            return $dataModules[$data->parent_id];
                        } catch (Exception $e) {
                            $whitelist = array('127.0.0.1', "::1");
                            if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                               // pr($e->__toString());
                                return $e->getMessage();
                           }else {
                                return $e->getMessage(). "<br>Url bị lỗi";
                            }
                        }
                        // return $data->parent->name;
                    }
                }
            ],
            'type_module',
            [
                'attribute'=>'cate_id',
                'value'=> function ($data) use ($productCategory,$newsCategories){
                    if($data->type_module=='product'){
                        try {
                            return isset($data->category->cateName) ? $productCategory[$data->cate_id]:'';
                            
                        } catch (Exception $e) {
                            return 'loi roi: loại san pham :'.$e->getMessage();
                        }
                    }elseif ($data->type_module=='news') {
                        try {
                            return isset($data->dmuctin->cateName) ? $newsCategories[$data->cate_id]:'';
                            
                        } catch (Exception $e) {
                            return 'loi roi: loại tin :'.$e->getMessage();
                        }
                    }else {
                        return '';
                    }
                },
            ],
            /*[
                'attribute' =>'cate_slug',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($dataCategory){
                    
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'cate_slug',
                        'value' => $model->cate_slug,
                        'data' => $dataCategory,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'options' => [
                             // 'allowClear'=> true,
                            'id'=>'cate_slug'.$key,
                            'class'=>'form-control',
                            'placeholder' => 'Select provinces ...',
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savecateName','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key,'data-field'=>'cate_slug']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";

                    return Html::button($dataCategory[$model->cate_slug],
                        $options = [
                        'data-id'=>$key,
                        'data-field'=>'cate_slug',
                        'id'=>'menuName'.$key,
                        'class'=>'text-info btn btn-outline btn-info Quickchange change text-primary',
                    ]).$html;
                },
            ],*/
            [
                'attribute' =>'order',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['max' => 998,'class'=>'form-control col-md-4','id'=>'order'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveOrder',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key]).
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
                        'data-field'=>'status',
                        'data-id'=>$key,
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            // 'page_show',
            //'sort',
            //'positions',
            //'content:ntext',
            //'created_at',
            //'updated_at',
            //'userCreated',
            //'userUpdated',

             [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 8%','class'=>'text-center'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{view}  {update}  {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('setting/setting-modules/view'),
                    'update' => Yii::$app->user->can('setting/setting-modules/update'),
                    'delete' => Yii::$app->user->can('setting/setting-modules/delete')
                ],
            ],
        ],
    ]); ?>
    <?php endif ?>
</div>
</div>
<?php 
$this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/productcategory_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>