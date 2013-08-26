<?php

namespace app\modules\contracts\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\data\ActiveDataProvider;
use \yii\data\Sort;

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
		return $this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new Contract();
		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('view','id'=>$model->id));
		}

		return $this->render('crud',array(
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

		return $this->render('crud',array(
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

		$dpContracts = new ActiveDataProvider(array(
		      'query' => Contract::find()
		      				->join('INNER JOIN', 'tbl_unit unit', 'unit.id = unit_id')
		      				->where(array('storage_id'=>$id)),		      				
		      'pagination' => array(
		          'pageSize' => 20,
		      ),
	  	));

		return $this->render('index', array(
			'dpContracts' => $dpContracts,
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
	public function actionAdmin($id)
	{
		//change the layout to 2 columns
		$this->layout='/column2';
		
		$query = Contract::find()
      				->join('INNER JOIN', 'tbl_unit unit', 'unit.id = unit_id')
      				->where(array('storage_id'=>$id));
		$sort = new Sort(array(
            'attributes' => array(
              'contract_id',
            ),
      	));

      	$dpContracts = new ActiveDataProvider(array(
		      'query' => $query,
		      'pagination' => array(
		          'pageSize' => 10,
		      ),
		      'sort' => $sort
	  	));

		return $this->render('index', array(
				'dpContracts' => $dpContracts,
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
				$this->_model=Contract::find($id);
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}
