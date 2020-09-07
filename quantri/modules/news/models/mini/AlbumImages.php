<?php

namespace quantri\modules\news\models;

use Yii;

/**
 * This is the model class for table "tbl_album_images".
 *
 * @property int $id
 * @property int $album_id
 * @property string $image
 * @property string $title
 * @property string $descriptions
 */
class AlbumImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_album_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album_id', 'image', 'status','alt'], 'required','message'=>'{attribute} không được để trống'],
            [['album_id', 'status'], 'integer'],
            [['descriptions'], 'string'],
            [['sort'], 'number'],
            [['image', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album ID',
            'image' => 'Ảnh',
            'title' => 'Title',
            'alt' => 'Alt',
            'sort' => 'Sắp xếp',
            'descriptions' => 'Mô tả',
            'status' => 'Trạng thái',
        ];
    }
}