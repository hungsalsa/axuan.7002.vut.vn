<?php

namespace frontend\models\product;

use Yii;

/**
 * This is the model class for table "tbl_product_versions".
 *
 * @property int $id
 * @property int $pro_id
 * @property string $name
 * @property double $price
 * @property double $price_sale
 * @property int $status
 */
class FProductVersions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product_versions';
    }

     public function rules()
    {
        return [
            [['pro_id', 'name', 'price_sale_1', 'status'], 'required'],
            [['pro_id','status'], 'integer'],
            [['date'], 'safe'],
            [['price_1', 'price_sale_1', 'price_2', 'price_3'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['pro_id', 'name', 'price_sale_1'], 'unique', 'targetAttribute' => ['pro_id', 'name', 'price_sale_1']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_id' => 'Pro ID',
            'date' => 'Date',
            'name' => 'Name',
            'price_1' => 'Price 1',
            'price_sale_1' => 'Price Sale 1',
            'price_2' => 'Price 2',
            'price_3' => 'Price 3',
            'status' => 'Status',
        ];
    }

    public function active($state = 1)
    {
        $this->andWhere(['status' => $state]); // or any other condition
        return $this;
    }

    public function getAllVersionPro($id_pro)
    {
        return self::find()->select(['id','date','name','price_1','price_sale_1','price_2','price_3','status'])
                ->where('status=:status AND pro_id =:pro_id',[':status'=>true,':pro_id'=>$id_pro])
                ->andWhere(['>=','date',date("Y-m-d")])
                ->orderBy(['date'=>SORT_ASC])
                // $version['date']>=date("Y-m-d")
                ->asArray()->all();
    }
    public function getProversionInfo($id_pro)
    {
        return self::find()->select(['id','date','name','price_1','price_sale_1','price_2','price_3','status'])->where('status=:status AND pro_id =:pro_id',[':status'=>true,':pro_id'=>$id_pro])->indexBy('id')->asArray()->all();
    }
    public function getVersionInfo($id)
    {
        return self::find()->select(['id','name','price_1','price_sale_1','status'])->where('status=:status AND id =:pro_id',[':status'=>true,':pro_id'=>$id])->asArray()->one();
    }
}
