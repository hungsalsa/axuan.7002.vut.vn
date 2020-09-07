<?php

namespace quantri\modules\customer\models;

use Yii;


class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'id_link', 'url', 'created_at', 'updated_at'], 'required'],
            [['note'], 'string'],
            [['id_link', 'created_at', 'updated_at', 'userUpdated','status'], 'integer'],
            [['fullname', 'email', 'type', 'url', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 12],
            [['people_id'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Họ tên',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'note' => 'Note',
            'id_link' => 'Id Link',
            'people_id' => 'Số CMTND',
            'type' => 'Kiểu',
            'address' => 'Địa chỉ',
            'status' => 'Trạng thái',
            'url' => 'Url',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người xử lý',

        ];
    }

    public function getNewslink()
    {
        return $this->hasOne(\quantri\modules\news\models\News::className(),['id'=>'id_link']);
        //->onCondition(['type' => 'news']);
    }

    public function getUser()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
        //->onCondition(['type' => 'news']);
    }
    public function getProductlink()
    {
        return $this->hasOne(\quantri\modules\products\models\Products::className(),['id'=>'id_link']);
        //->onCondition(['type' => 'news']);
    }

    public function getCountCustomer()
    {
        $data = self::find()->select(['id','fullname','phone','email','type','status'])->where('type != :type', ['type'=>'shopping']);
        $result['total'] = $data->count();
        $result['not_activated'] = $data->andWhere('status=:status',[':status'=>0])->count();
        $result['rows'] = $data->all();
        return $result;
    }
}