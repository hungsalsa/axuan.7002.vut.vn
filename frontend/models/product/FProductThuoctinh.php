<?php

namespace frontend\models\product;

use Yii;

/**
 * This is the model class for table "tbl_product_thuoctinh".
 *
 * @property int $id
 * @property string $name
 * @property int $product_id
 * @property string $value
 */
class FProductThuoctinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_thuoctinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'product_id', 'value'], 'required'],
            [['product_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['value'], 'string', 'max' => 200],
            [['sort'], 'number'],
            [['name', 'product_id', 'value'], 'unique', 'targetAttribute' => ['name', 'product_id', 'value']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sort' => 'sort',
            'product_id' => 'Product ID',
            'value' => 'Value',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(FProduct::className(),['id'=>'product_id'])->orderBy(['sort'=>SORT_DESC]);
    }

    public function getAllIdproduct($id)
    {
        $data = self::find()->select(['name','value'])->where(['IN','id',$id])->all();
        $result = [];
        foreach ($data as $one) {
            $model =self::find()->select(['product_id'])->where('name =:name AND value=:value',[':name'=>$one->name,':value'=>$one->value])->asArray()->all();
            $model = array_column($model, 'product_id');
            $result = array_merge($result,$model);
            // $result = array_merge($result,self::find()->select(['product_id'])->where('name =:name AND value=:value',[':name'=>$one['name'],':value'=>$one['value']])->asArray()->all());
        }
        // return $data;
        return $result;
    }

    // Lay tat ca cac thuoc tinh san pham, danh muc
    public function getAllAttribute($idCate)
    {
        return self::find()->alias('t')
        ->select(['t.id','t.name','t.value','t.product_id'])
        // ->select(['p.id','p.pro_name','p.short_introduction'])

        ->joinWith(['product p'],false)
        ->where('p.status =:status',[':status'=>true])
        ->andWhere(['IN', 'p.product_category_id', $idCate])
        ->groupBy(['t.name','t.value'])
        // ->andWhere(['like', 'p.pro_name', '%'.$keysearch.'%', false])
        ->orderBy(['t.name' => SORT_ASC])
        ->asArray()
        ->all();
    }
}
