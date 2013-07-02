<?php
namespace app\widgets;

use Yii;
use \yii\helpers\Html;

use app\widgets\Portlet;
use app\models\Pages;

class PortletCmsHistory extends Portlet
{
	public $title='Historical Versions';
	
	public $id = 0;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$historics = Pages::findOldVersions($this->id)->All();
		echo $this->render('@app/widgets/views/portlet_cms_history',array('historics'=>$historics));
	}
}