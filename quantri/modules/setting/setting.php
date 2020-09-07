<?php

namespace quantri\modules\setting;
use Yii;
/**
 * setting module definition class
 */
class setting extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'quantri\modules\setting\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // dbg(Yii::$app->params['layout']['layout_backend']);
        // Yii::$app->setLayoutPath($this->getBasePath().'/views/layout');
        $this->layout = '@quantri/views/layouts/'.Yii::$app->params['layout']['layout_backend'];

        // custom initialization code goes here
    }
}
