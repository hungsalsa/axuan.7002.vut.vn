<?php

namespace frontend\models\setting;

use Yii;

/**
 * This is the model class for table "tbl_setting_default".
 *
 * @property int $id
 * @property string $logo
 * @property string $title
 * @property string $description
 * @property string $keyword
 * @property int $layout_frontent
 * @property int $layout_backend
 * @property string $ad
 * @property string $footer_left
 * @property string $cutom_1
 * @property string $cutom_2
 * @property string $cutom_3
 * @property int $tophead
 * @property string $google_analytics
 */
class FSettingDefault extends \yii\db\ActiveRecord
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
            [['logo', 'layout_frontent', 'layout_backend'], 'required'],
            [['description', 'footer_left', 'footer_right','bank_account','description_shopping', 'tophead'], 'string'],
            [['layout_frontent', 'layout_backend'], 'integer'],
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
            'keyword' => 'Keyword',
            'layout_frontent' => 'Layout Frontent',
            'layout_backend' => 'Layout Backend',
            'ad' => 'Ad',
            'description_shopping' => 'description_shopping',
            'footer_left' => 'footer_left',
            'footer_right' => 'footer_right',
            // 'cutom_1' => 'Cutom 1',
            // 'cutom_2' => 'Cutom 2',
            // 'cutom_3' => 'Cutom 3',
            'tophead' => 'Talk Do',
            'google_analytics' => 'Google Analytics',
        ];
    }
    public function getSiteinfo()
    {
        return self::find()->select(['logo','title','description','keyword','footer_left','footer_right','layout_frontent','google_analytics','bank_account','description_shopping','tophead','ad'])->asArray()->one();
    }
}
