<?php

namespace quantri\modules\news;

use Yii;
class News extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'quantri\modules\news\controllers';

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
