<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property int $type
 * @property string $value
 * @property int $link
 */
class FTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'link','slugTag','name'], 'required'],
            [['link'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['value','name','slugTag'], 'string', 'max' => 255],
            [['type', 'value', 'link'], 'unique', 'targetAttribute' => ['type', 'value', 'link']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'name',
            'value' => 'Value',
            'slugTag' => 'slugTag',
            'link' => 'Link',
        ];
    }

    public function getProOne()
    {
        return $this->hasOne(\frontend\models\product\FProduct::className(),['id'=>'link']);//->viaTable('FTags',['type' => 'product']);;
    }

    public function getNewsOne()
    {
        return $this->hasOne(\frontend\models\news\FNews::className(),['id'=>'link']);//->andOnCondition(['type' => 'product']);;
    }

    /*Hàm lấy tất cả các tags theo loại, sản phẩm , tin tức, 
    sử dụng cho cập nhật*/
    public function getAllTagsBytype($slugTag,$type='product')
    {
        return yii\helpers\ArrayHelper::map(self::find()->where('type=:type AND slugTag=:slugTag',[':type'=>$type,':slugTag'=>$slugTag])->indexBy('id')->all(),'link','link');
    }
    public function getInfoTags($slugTag,$type='product')
    {
        return self::find()->where('type=:type AND slugTag=:slugTag',[':type'=>$type,':slugTag'=>$slugTag])->asArray()->one();
    }

    public function getAllTag($keysearch,$type='product')
    {
        $data = self::find()->alias('t')
            ->select(['t.id','t.type','t.value','t.slugTag','t.name','t.link','n.images'])
            ->joinWith([
                'proOne as p' => function (\yii\db\ActiveQuery $query){
                    $query->select(['p.id','p.pro_name','ip.image']);
                    // return $query
                    // $query->andWhere(['t.type'=> 'product']);
                    $query->joinWith('imageOne ip',false);
                    // $query->where(['i.status' => true]);
                // $query->orderBy(['i.order'=>SORT_ASC]);
                // $query->andWhere(['<>','pd.slug', $slug]);
                // $query->orderBy([
                //     'i.order' => SORT_ASC,
                //     'i.updated_at' => SORT_DESC,
                // ]);
                },
            ])
            ->joinWith([
                'newsOne n'
            ],false)
            // ->where('t.type=:type',[':type'=>$type])
            ->where(['like', 't.value', '%'.$keysearch.'%', false])
            ->orWhere(['like', 't.name', '%'.$keysearch.'%', false])
            // ->orWhere(['like', 'p.pro_name', '%'.$keysearch.'%', false])
            ->groupBy(['t.value'])
            // ->orderBy(['t.type' => SORT_DESC])
            ->asArray()->all();
        return $data;
    }
    public function getSearch($keysearch)
    {
        // $data['products'] = $this->getAllTag($keysearch);
        // $data['news'] = $this->getAllTag($keysearch,'news');
        // return $data;
    }
}
