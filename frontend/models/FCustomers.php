<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_customers".
 *
 * @property int $id
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property string $note
 * @property int $id_link
 * @property string $type
 * @property string $url
 * @property int $created_at
 * @property int $updated_at
 * @property int $userUpdated
 */
class FCustomers extends \yii\db\ActiveRecord
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
            [['fullname', 'id_link', 'url','phone'], 'required', 'message' => '{attribute} không được để trống'],
            [['note'], 'string'],
            [['id_link', 'created_at', 'updated_at', 'userUpdated'], 'integer'],
            [['fullname', 'email', 'type', 'url'], 'string', 'max' => 255],
            // [['phone'], 'number', 'max' => 12],
            [['phone'], 'string', 'max' => 10, 'message' => '{attribute} dài tối đa 10 ký tự'],
            [['phone'], 'match', 'pattern' => '/^0[0-9]{9}$/', 'message' => '{attribute} bao gồm các chữ số bắt đầu bằng 0 tối thiểu 10 số'],
            [['people_id','phone'], 'unique','message' => '{attribute} đã có'],
            [['people_id'], 'match', 'pattern' => '/^[0-9]+$/','message' => '{attribute} bao gồm các số'],
             ['people_id', 'string', 'length' => [9, 12],'message' => '{attribute} từ 9 đến 12 ký tự'],
            ['email', 'email', 'message' => '{attribute} không đúng định dạng'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Họn tên',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'note' => 'Ghi chú',
            'id_link' => 'Id Link',
            'people_id' => 'Số chứng minh thư',
            'type' => 'Type',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userUpdated' => 'User Updated',
        ];
    }


    public function actionSendEmail($setSubject,$emailTo,$emailCC,$textBody) {
        $send = Yii::$app->mailer->compose()
        ->setFrom('minhlam26889@gmail.com')
        ->setTo($emailTo)
        ->setCc($emailCC)
        ->setSubject($setSubject)
        ->setTextBody($setSubject)
        ->setHtmlBody($textBody);
        if($send->send()){
            return true;
        }else {
            return false;
        }
    }
}
