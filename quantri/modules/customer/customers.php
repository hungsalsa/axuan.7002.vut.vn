<?php

namespace quantri\modules\customer;
use Yii;
/**
 * customer module definition class
 */
class customers extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'quantri\modules\customer\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = '@quantri/views/layouts/'.Yii::$app->params['layout']['layout_backend'];
        // custom initialization code goes here
    }
}
