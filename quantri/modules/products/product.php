<?php

namespace quantri\modules\products;

use Yii;
class product extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'quantri\modules\products\controllers';

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
