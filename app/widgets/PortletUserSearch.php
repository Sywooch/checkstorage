<?php
namespace app\widgets;
use Yii;
use \yii\helpers\Html;

use app\widgets\Portlet;
use app\models\User;
use app\models\UserSearchForm;

class PortletUserSearch extends Portlet
{
	public $title='Employee Search';
	
	public $maxResults = 5;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new UserSearchForm;
		if ($model->load($_POST))
		{
			if($model->username!=='')
				$hits = User::searchByString($model->username);
		}
		echo $this->render('@app/views/user/_search',array('model'=>$model,'hits'=>$hits));
	}
}