<?php

namespace app\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\data\Pagination;
use \yii\web\HttpException;

use app\models\Messages;
use app\models\Workflow;

class WorkflowController extends Controller
{

	public $layout='column2';

	/**
	* @var string the default command action.
	*/
	public $defaultAction = 'index';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public function behaviors() {
		return array(
			'AccessControl' => array(
				'class' => '\yii\web\AccessControl',
				'rules' => array(
					array(
						'allow'=>true,
						'actions'=>array('index','SendWorkflowmessage'),
				        'roles'=>array('@'),
					),  
					array(
						'allow'=>false,  // deny all users
					),
				)
			)
		);
	}

	public function actionIndex()
	{
		$this->layout = 'column1';
		$query = Workflow::getAdapterForUserWorkflow();

		$countQuery = clone $query;
		$pagination = new Pagination();
		$pagination->itemCount = $countQuery->count();

		$models = $query->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		return $this->render('index', array(
			'models' => $models,
			'pagination' => $pagination,
		));
	}

	public function actionSendworkflowmessage($module,$text){
		$wfMsg = new Messages();
		$wfMsg->reciever_id = (int)Yii::$app->user->identity->parent_user_id;
		$wfMsg->sender_id = (int)Yii::$app->user->identity->id;
		$wfMsg->subject = 'WFMESSAGE';
		$wfMsg->is_read = (string)'0';
		$wfMsg->date_create = Date('Y-m-d H:i:s');
		$wfMsg->body = $text;
		$wfMsg->module = strtoupper($module);		
		if(!$wfMsg->save())
			var_dump($wfMsg);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel($id='')
	{
		if($this->_model===null)
		{
			if(!empty($id))
			{
				$this->_model=Workflow::find($id);				
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}
