<?php

namespace quantri\modules\setting\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_setting_default".
 *
 * @property int $id
 * @property string $logo
 * @property string $title
 * @property string $description
 * @property string $keyword
 * @property string $ad
 * @property string $footer_left
 * @property int $tophead
 * @property string $google_analytics
 */
class SettingDefault extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_setting_default';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logo','layout_frontent', 'layout_backend'], 'required','message'=>'{attribute} không được để trống'],
            [['description', 'footer_left','footer_right','bank_account','description_shopping','tophead'], 'string'],
            [['logo', 'title', 'keyword', 'ad', 'google_analytics'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Logo',
            'title' => 'Title',
            'description' => 'Description',
            'keyword' => 'Keywords',
            'bank_account' => 'Tài khoản ngân hàng',
            'layout_frontent' => 'layout_frontent',
            'layout_backend' => 'layout_backend',
            'ad' => 'Banner di dong',
            'description_shopping' => 'Hướng dẫn đặt hàng',
            'footer_left' => 'Footer - trái',
            'footer_right' => 'Footer - phải',
            'cutom_1' => 'cutom_1',
            'cutom_2' => 'cutom_2',
            'cutom_3' => 'cutom_3',
            'tophead' => 'Nội dung trong Head',
            'google_analytics' => 'Google Analytics',
        ];
    }

    public function siteInfo($id=1)
    {
        return ArrayHelper::toArray(self::find()->select(['logo','title','description','keyword','layout_backend','google_analytics'])->where('id=:ID',[':ID'=>$id])->one());
    }
}