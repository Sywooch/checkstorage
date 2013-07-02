<?php
namespace app\widgets;

use \Yii;
use \yii\helpers\Html;

use app\widgets\Portlet;

class PortletPagesToc extends Portlet
{
	public $title='Page Navigation';

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		echo $this->render('@app/widgets/views/portlet_pages_toc');
	}
}