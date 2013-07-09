<?php
namespace app\widgets;
use Yii;
use \yii\helpers\Html;
use \yii\web\Session;

use app\widgets\Portlet;
use app\models\Pages;
use app\models\StorageSearchForm;
use app\models\Storage;

class PortletStorageSearch extends Portlet
{
	public $title='Lagerplatz Suche';
	
	public $maxResults = 3;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new StorageSearchForm;
		if ($model->load($_POST))
		{
			$session = new Session;
			$session['address'] = $model->address;
			$session['double_sqm'] = $model->double_sqm;
			$session['int_weeks'] = $model->int_weeks;
			$session['double_distance'] = $model->double_distance;
			$session['date_start'] = $model->date_start;

			$model->placeFinder();
			$hits = Storage::searchQuickForm($model,$this->maxResults)->all();
			Yii::$app->controller->locations = $hits;
		}
		echo $this->render('@app/views/storage/_search',array('model'=>$model,'hits'=>$hits));
	}
}