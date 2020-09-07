<?php

namespace frontend\models\setting;

use Yii;
use frontend\models\product\FProductCategory;
use frontend\models\news\FCategories;
use frontend\models\news\FNews;

class FSettingModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_module', 'positions', 'status','cate_id', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['cate_slug','cate_id', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated','parent_id','count_pro'], 'integer'],
            [['order'], 'number'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['type_module'], 'string', 'max' => 30],
            [['positions','hienthi'], 'string', 'max' => 50],
            [['page_show'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
         return [
            'id' => 'ID',
            'name' => 'Name',
            'type_module' => 'Type Module',
            'positions' => 'Positions',
            'hienthi' => 'hienthi',
            'parent_id' => 'parent_id',
            'cate_slug' => 'Cate ID',
            'cate_id' => 'Cate ID',
            'page_show' => 'Page Show',
            'order' => 'Order',
            'count_pro' => 'count_pro',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }
    public function getCategory()
    {
        return $this->hasOne(FProductCategory::className(),['idCate'=>'cate_id']);
    }
    public function getDmtintuc()
    {
        return $this->hasOne(FCategories::className(),['id'=>'cate_id']);
    }
    // public function getTintuc()
    // {
    //     return $this->hasMany(FNews::className(),['category_id'=>'cate_slug']);
    // }

    public function getChildrents()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);
    }

    public function getAllModules($status=true)
    {
        return self::find()->alias('m')
        ->select(['name','m.order','cate_slug','c.slug as CateSlug'])
        ->innerJoinWith('category c',false)
        // ->joinWith([
            
        //     'category' => function (\yii\db\ActiveQuery $query) {
        //         $query->select(['idCate','cateName','slug']);
        //     },
        // ])
        ->asArray()
        ->where('m.status=:active',[':active'=>$status])
        ->orderBy(['m.order' => SORT_DESC,'m.created_at' => SORT_DESC])->all();
    }

    

    public function getAllSettingModules($idModule)
    {
        $model = $this->getModulesWebsite('custom',$idModule,'top_header');
        if($model){
            $data['top_header'] = $model;
        }
        // dbg($model);
        $model = $this->getModulesWebsite('custom',$idModule,'under_slide_show');
        if($model){
            $data['under_slide_show'] = $model;
        }
        $model = $this->getModulesWebsite('custom',$idModule,'above_footer');
        if($model){
            $data['above_footer'] = $model;
        }
        $model = $this->getModulesWebsite('',$idModule,'content_left');
        // dbg($model);
        if($model){
            $data['content']['content_left'] = $model;
        }
        $model = $this->getModulesWebsite('',$idModule,'content_center');
        // dbg($model);
        if($model){
            $data['content']['content_center'] = $model;
        }
        $model = $this->getModulesWebsite('',$idModule,'content_right');
// dbg($model);
        if($model){
            $data['content']['content_right'] = $model;
        }
        if (isset($data)) {
            return $data;
        } else {
            return false;
        }

    }

    private function getModulesWebsite($type_module='',$idModule,$positions='',$parent_id=0)
    {
        // pr($idModule);
        $data = self::find()->alias('m');
        $select = ['m.type_module','m.positions','m.hienthi','m.id','m.name','m.order','m.content','m.parent_id','m.cate_id','m.status','m.count_pro','c.product_parent_id','c.slug as slugCate','dt.slug as slugCateNews'];
        $data->select($select)
            ->joinWith([
                'childrents as ch' => function (\yii\db\ActiveQuery $query) {
                    $query->select(['ch.id','ch.type_module','ch.name','ch.order','ch.content','ch.parent_id','c1.slug as cate_slug','ch.status','ch.count_pro','c1.product_parent_id','ch.cate_id','c1.slug as slugCate','dt1.slug as slugCateNews'])
                    ->joinWith(['category c1','dmtintuc dt1'],false)
                    ->andOnCondition(['ch.status' => true])
                    ->orderBy([
                        'ch.order' => SORT_DESC,
                        'ch.created_at' => SORT_DESC,
                    ])
                    // $query->where(['ch.status'=>1]);
                    // ->joinWith(["category ca"],false)
                    // ->joinWith(["childrents as chi"],true);
                    ->joinWith([
                        'childrents as chi' => function (\yii\db\ActiveQuery $queryi) {
                            $queryi->select(['chi.id','chi.type_module','chi.name','chi.order','chi.content','chi.parent_id','cai.slug as cate_slug','chi.status','chi.count_pro','cai.product_parent_id','chi.cate_id','c2.slug as slugCate','dt2.slug as slugCateNews'])
                            // $queryi->andWhere(['>', 'subtotal', 100]);
                            ->joinWith(['category c2','dmtintuc dt2'],false)
                            ->andOnCondition(['chi.status' => true])
                            ->orderBy([
                                'chi.order' => SORT_DESC,
                                'chi.created_at' => SORT_DESC,
                            ])
                            // $queryi->andWhere(['chi.status'=>1]);
                            ->joinWith(["category cai"],false);
                        }
                    ]);
                    
                }
            ])
        ->joinWith(['category c','dmtintuc dt'],false)
        ->where('m.status=:active',[':active'=>true])
        ->andWhere(['m.parent_id'=>$parent_id])
        // if (!empty($idModule)) {
        ->andWhere(['IN','m.id',$idModule]);
        // }

        if ($type_module !='') {
            $data->andWhere(['m.type_module'=>$type_module]);
        }
        if ($positions!='') {
            $data->andWhere(['m.positions'=>$positions]);
        }
        // if (!empty($idModule)) {
            // $data->andWhere(['IN','ch.id',$idModule]);
        // }
        return $data->orderBy(['m.positions' => SORT_DESC,'m.order' => SORT_DESC,'m.created_at' => SORT_DESC])->asArray()->all();
    }

    private function getModulesCustom($positions='')
    {
        // pr($idModule);
        $data = self::find()->alias('m');
        // $select = ['m.type_module','m.positions','m.hienthi','m.id','m.name','m.order','m.content','m.parent_id','m.cate_id','m.status','m.count_pro','c.product_parent_id','c.slug as slugCate'];
        $data//->select($select)
            ->joinWith([
                'childrents as ch' => function (\yii\db\ActiveQuery $query) {
                    $query->select(['ch.id','ch.type_module','ch.name','ch.order','ch.content','ch.parent_id','ca.slug as cate_slug','ch.status','ch.count_pro','ca.product_parent_id','ch.cate_id']);
                    $query->orderBy([
                        'ch.order' => SORT_DESC,
                        'ch.created_at' => SORT_DESC,
                    ]);
                    // $query->where(['ch.status'=>1]);
                    $query->joinWith(["category ca"],false);
                    // $query->joinWith(["childrents as chi"],true);
                    // $query->joinWith([
                    //     'childrents as chi' => function (\yii\db\ActiveQuery $queryi) {
                    //         $queryi->select(['chi.id','chi.type_module','chi.name','chi.order','chi.content','chi.parent_id','cai.slug as cate_slug','chi.status','chi.count_pro','cai.product_parent_id','chi.cate_id']);

                    //         $queryi->orderBy([
                    //             'chi.order' => SORT_DESC,
                    //             'chi.created_at' => SORT_DESC,
                    //         ]);
                    //         $queryi->joinWith(["category cai"],false);
                    // }]);
                    
                }
            ])
        ->joinWith('category c',false)
        ->where('m.status=:active',[':active'=>true])
        ->andWhere(['m.parent_id'=>0]);

        // if ($type_module !='') {
        //     $data->andWhere(['m.type_module'=>$type_module]);
        // }
        if ($positions!='') {
            $data->andWhere(['m.positions'=>$positions]);
        }
        // if (!empty($idModule)) {
            // $data->andWhere(['IN','ch.id',$idModule]);
        // }
        return $data->orderBy(['m.positions' => SORT_DESC,'m.order' => SORT_DESC,'m.created_at' => SORT_DESC])->asArray()->all();
    }
/*
    private function getModulesWebsite($type_module='',$idModule,$positions='',$parent_id=0)
    {
        // pr($idModule);
        $data = self::find()->alias('m');
        $select = ['m.type_module','m.positions','m.hienthi','m.id','m.name','m.order','m.content','m.parent_id','m.cate_id','m.status','m.count_pro','c.product_parent_id','c.slug as slugCate'];
        $data->select($select)
            ->joinWith([
                'childrents as ch' => function (\yii\db\ActiveQuery $query) {
                    $query->select(['ch.id','ch.type_module','ch.name','ch.order','ch.content','ch.parent_id','ca.slug as cate_slug','ch.status','ch.count_pro','ca.product_parent_id','ch.cate_id']);
                    $query->joinWith(["category ca"]);
                    // $query->rightJoin('FProductCategory ca', 'ca.idCate = m.cate_id');
                    // 'idCate'=>'cate_id'
                    $query->orderBy([
                        'ch.order' => SORT_DESC,
                        'ch.created_at' => SORT_DESC,
                    ]);
                    $query->where(['ch.status'=>1]);
                    // $query->andWhere(['IN', 'ch.id', $idModule]);
                }
            ])
        ->joinWith('category c',false)
        ->where('m.status=:active',[':active'=>true])
        ->andWhere(['m.parent_id'=>$parent_id]);
        if (!empty($idModule)) {
            $data->andWhere(['IN','m.id',$idModule]);
        }

        if ($type_module !='') {
            $data->andWhere(['m.type_module'=>$type_module]);
        }
        if ($positions!='') {
            $data->andWhere(['m.positions'=>$positions]);
        }
        // if (!empty($idModule)) {
            // $data->andWhere(['IN','ch.id',$idModule]);
        // }
        return $data->orderBy(['m.positions' => SORT_DESC,'m.order' => SORT_DESC,'m.created_at' => SORT_DESC])->asArray()->all();
    }*/
}
