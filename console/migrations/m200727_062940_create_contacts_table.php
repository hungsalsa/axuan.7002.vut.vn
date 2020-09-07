<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m200727_062940_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'tax_code' => $this->string()->notNull()->comment('Mã số thuế'),
            'manager' => $this->string()->notNull()->comment('giám đốc'),
            'gender' => $this->tinyInteger()->defaultValue(0),
            'birth_day' => $this->date(),
            'phone' => $this->string(12)->notNull(),
            'email' => $this->string(),
            'business' => $this->string()->notNull()->comment('Ngành nghề kinh doanh'),
            'date_bussiness' => $this->date()->comment('Ngày thành lập'),
            'website' => $this->string()->comment('Ngành nghề kinh doanh'),

            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contacts}}');
    }
}
