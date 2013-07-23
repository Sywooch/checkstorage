<?php

namespace app\modules\contracts\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\data\ActiveDataProvider;

use \app\modules\contracts\models\Contract;

class ContractsController extends Controller
{
	public $layout='/column1';

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
						'actions'=>array('index','view','create','update','indexadmin','admin'),
				        'roles'=>array('@'),
					), 
					array(
						'allow'=>false,  // deny all users
					),
				)
			)
		);
	}

	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$comment=$this->newComment($model);
		return $this->render('view',array(
			'model'=>$model,
			'comment'=>$comment,
		));
	}

	public function actionCreate()
	{
		$this->layout='column1';

		$model=new Post();
		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('view','id'=>$model->id));
		}

		return $this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$this->layout='column1';

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

	public function actionIndex($id)
	{
		//change the layout to 2 columns
		$this->layout='/column2';

		$provider = new ActiveDataProvider(array(
		      'query' => Contract::find()->with('Unit'),//->where(array('storage_id'=>$id)),
		      'pagination' => array(
		          'pageSize' => 20,
		      ),
	  	));

		return $this->render('index', array(
			'provider' => $provider,
		));
	}

	public function actionIndexadmin()
	{
		return $this->render('indexadmin', array(
		
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$query = Post::find()
			->where('status="'. Workflow::STATUS_PUBLISHED.'"')
			->orderBy('time_create DESC');

		$countQuery = clone $query;
		$pagination = new Pagination();
		$pagination->totalCount = $countQuery->count();
		
		$models = $query->offset($pagination->offset)
				->limit($pagination->limit)
				->all();

		return $this->render('admin', array(
				'models' => $models,
				'pagination' => $pagination,
			));
	}
	

	public function actionSuggestTags($q='',$limit=20, $timestamp=0)
	{
		if(($keyword=trim($q))!=='')
		{
			$tags=Tag::suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
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
				$this->_model=Contract::find($id);
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}
