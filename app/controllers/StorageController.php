<?php

namespace app\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\web\HttpException;

use \yii\db\Query;
use \yii\data\Sort;
use \yii\data\ActiveDataProvider;

use \yii\data\Pagination;

use \yii\helpers\Json;

use app\models\Storage;
use app\models\ComparisionFactor;

class StorageController extends Controller
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
						'actions'=>array('view','rememberme'),
						'roles' => array('?'),
					),
					array(
						'allow'=>true,
						'actions'=>array('dashboard','view','update','create','index','admin','jsongridstoragedata'),
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
		if(Yii::$app->user->isGuest OR !Yii::$app->user->id == $model->user_id)
			$this->layout = 'column1';	

		return $this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionDashboard($id='')
	{		
		$model=$this->loadModel($id);	

		$unitsprovider = new ActiveDataProvider(array(
		      'query' => \app\modules\units\models\Unit::find()->where(array('storage_id'=>$id)),
		      'pagination' => array(
		          'pageSize' => 10,
		      ),
	  	));

		return $this->render('dashboard',array(
			'model' => $model,
			'unitsprovider' => $unitsprovider,
		));
	}

	public function actionCreate()
	{
		$this->layout = 'column1';
		$model=new Storage();
		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('view','id'=>$model->id));
		}

		return $this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$this->layout = 'column1';
		$model=$this->loadModel($id);
		if (($model->load($_POST) AND $model->Comparision->load($_POST)) && ($model->save() AND $model->Comparision->save())) {
			return $this->redirect(array('admin'));
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
		return $this->redirect(array('admin'));
	}

	public function actionRemberme(){
		$this->render('index');
	}

	public function actionIndex($tag='')
	{
		$this->layout = 'column2';
		$query = Storage::find()
			->orderBy('id DESC');

		$countQuery = clone $query;
		$pagination = new Pagination();
		$pagination->totalCount = $countQuery->count();

		$models = $query->offset($pagination->offset)
			->limit($pagination->limit)
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
		$this->layout = 'column2';

		$query = Storage::find()->where(array('user_id'=>Yii::$app->user->id));
		$sort = new Sort(array(
          'attributes' => array(
              'country',
              'name' => array(
                  'asc' => array('name' => Sort::ASC),
                  'desc' => array('name' => Sort::DESC),
                  'default' => Sort::DESC,
                  'label' => 'Name',
              	),
        	),
      	));

		$dpStorage = new ActiveDataProvider(array(
		      'query' => $query,
		      'pagination' => array(
		          'pageSize' => 10,
		      ),
		      'sort' => $sort
	  	));		

		return $this->render('admin', array(
			'dpStorage' => $dpStorage,
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
				$this->_model=Storage::find($id);				
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	public function actionJsongridStoragedata(){
		
		$query = new Query;
		$query->select('id, address, name, category_age ,stat_final_nnf')
			->from('tbl_storage')
		    ->orderBy('address ASC');

		$command = $query->createCommand();

		$count = Storage::find();

		$models = $command->queryAll();

		$clean = array('pos'=>0, 'total_count'=>$count->count());
		$ii=0;
		foreach($models AS $record){
			$clean['rows'][]=array(
				'id' => $record['id'],
				'data' => array_values($record),
			);
		}
		header('Content-type: application/json');
		echo Json::encode($clean);
		exit;
	}

}
