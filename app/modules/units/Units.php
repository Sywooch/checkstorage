<?php

namespace app\modules\units;

use yii\base\Module;

class Units extends Module
{

	/**
	* @var public $controllerNamespace holing the namespace of the controller
	*/
	public $controllerNamespace = 'app\modules\units\controllers';

	/**
	* @var public defaultRoute holding the controller name which will be called by default
	*/
	public $defaultRoute = 'units';	

	public function init()
    {
        parent::init();
        // custom initialization code goes here
    }

}
