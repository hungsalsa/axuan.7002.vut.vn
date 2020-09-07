<?php

namespace app\models\news;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $company_name
 * @property string $address
 * @property string $tax_code Mã số thuế
 * @property string $manager giám đốc
 * @property int $gender
 * @property string $birth_day
 * @property string $phone
 * @property string $email
 * @property string $business Ngành nghề kinh doanh
 * @property string $date_bussiness Ngày thành lập
 * @property string $website Ngành nghề kinh doanh
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'address', 'tax_code', 'manager', 'phone', 'business'], 'required'],
            [['gender', 'status', 'created_at', 'updated_at'], 'integer'],
            [['birth_day', 'date_bussiness'], 'safe'],
            [['company_name', 'address', 'tax_code', 'manager', 'email', 'business', 'website'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Tên công ty',
            'address' => 'Địa chỉ (*)',
            'tax_code' => 'Mã số thuế (*)',
            'manager' => 'Giám đốc (*)',
            'gender' => 'Giới tính',
            'birth_day' => 'Năm sinh',
            'phone' => 'Điện thoại (*)',
            'email' => 'Email',
            'business' => 'Ngành nghề kinh doanh (*)',
            'date_bussiness' => 'Ngày thành lập',
            'website' => 'Website',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
