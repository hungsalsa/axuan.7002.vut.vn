<?php

namespace frontend\models\product;

use Yii;

/**
 * This is the model class for table "tbl_imgpro_list".
 *
 * @property int $id
 * @property int $pro_id
 * @property string $image
 * @property string $title
 * @property string $alt
 */
class ImgproList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_imgpro_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_id', 'image', 'status'], 'required'],
            [['pro_id'], 'integer'],
            [['image', 'title', 'alt'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIma' => 'ID',
            'pro_id' => 'Pro ID',
            'image' => 'Image',
            'title' => 'Title',
            'alt' => 'Alt',
            'status' => 'Status',
        ];
    }

    public function getAllImagePro($id)
    {
        return ImgproList::find()->asArray()->where('status =:Active AND pro_id =:Product',['Active'=>1,'Product'=>$id])->all();
    }
}
