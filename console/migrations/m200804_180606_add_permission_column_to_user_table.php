<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m200804_180606_add_permission_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'permission', $this->string(64)->defaultValue(0)->after('phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
