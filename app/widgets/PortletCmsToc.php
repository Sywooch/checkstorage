<?php
namespace app\widgets;

use Yii;
use \yii\helpers\Html;

use app\widgets\Portlet;
use app\models\Pages;

class PortletCmsToc extends Portlet
{
	public $title='Content Navigation';
	
	public $rootId = 0;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		echo $this->render('@app/widgets/views/portlet_cms_toc',array('rootId'=>$this->rootId));
	}
}