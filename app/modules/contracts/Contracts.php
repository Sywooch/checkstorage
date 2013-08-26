<?php

namespace app\modules\contracts;

use yii\base\Module;

class Contracts extends Module
{

	/**
	* @var public $controllerNamespace holing the namespace of the controller
	*/
	public $controllerNamespace = 'app\modules\contracts\controllers';

	/**
	* @var public defaultRoute holding the controller name which will be called by default
	*/
	public $defaultRoute = 'contracts';

	public function init()
    {
        parent::init();
        // custom initialization code goes here
    }

}
