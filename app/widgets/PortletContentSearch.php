<?php
namespace app\widgets;
use Yii;
use \yii\helpers\Html;

use app\widgets\Portlet;
use app\models\Pages;
use app\models\ContentSearchForm;

class PortletContentSearch extends Portlet
{
	public $title='Content Search';
	
	public $maxResults = 5;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new ContentSearchForm;
		if ($model->load($_POST))
		{
			if($model->searchstring!=='')
				$hits = Pages::searchByString($model->searchstring)->all();
		}
		echo $this->render('@app/views/pages/_search',array('model'=>$model,'hits'=>$hits));
	}
}