<?php
class Admin extends ActiveRecord implements IdentityInterface {
    public static function tableName()
    {
        return '{{%admin}}';
    }
}