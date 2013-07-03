<?php
namespace app\widgets;
use Yii;
use \yii\helpers\Html;

use app\widgets\Portlet;
use app\models\Pages;
use app\models\StorageSearchForm;

class PortletStorageSearch extends Portlet
{
	public $title='Lagerplatz Suche';
	
	public $maxResults = 5;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new StorageSearchForm;
		if ($model->load($_POST))
		{
			if($model->searchstring!=='')
				$hits = Storage::searchByString($model->searchstring)->all();
		}
		echo $this->render('@app/views/storage/_search',array('model'=>$model,'hits'=>$hits));
	}
}