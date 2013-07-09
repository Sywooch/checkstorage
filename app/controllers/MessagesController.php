<?php

namespace app\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\data\Pagination;
use \yii\web\HttpException;

use app\models\Messages;

class MessagesController extends Controller
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
						'actions'=>array('index', 'view','create','update'),
				        'roles'=>array('@'),
					),  
					array(
						'allow'=>false,  // deny all users
					),
				)
			)
		);
	}

	public function actionView($id='')
	{
		$model=$this->loadModel($id);
		return $this->render('view',array(
			'model'=>$model,			
		));
	}

	public function actionCreate()
	{
		$this->layout = 'column1';
		$model=new Messages();
		
		//assign the sender!
		$model->sender_id = Yii::$app->user->identity->id;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('view','id'=>$model->id));
		}

		return $this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('view','id'=>$model->id));
		}

		return $this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		// we only allow deletion via POST request
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		return $this->redirect(array('index'));
	}

	public function actionIndex($tag='')
	{
		$query = Messages::find()
			->orderBy('date_create DESC');

		$countQuery = clone $query;
		$pagination = new Pagination();
		$pagination->itemCount = $countQuery->count();

		$models = $query->offset($pagination->offset)
			->limit($pagination->limit)
			->with('sender', 'reciever')
			->all();

		return $this->render('index', array(
			'models' => $models,
			'pagination' => $pagination,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$query = Messages::find()->all();

		$countQuery = clone $query;
		$pagination = new Pagination();
		$pagination->itemCount = $countQuery->count();
		
		$models = $query->offset($pagination->offset)
				->limit($pagination->limit)
				->all();

		return $this->render('admin', array(
				'models' => $models,
				'pagination' => $pagination,
			));
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
				$this->_model=Messages::find($id);				
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}
