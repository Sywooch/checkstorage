<?php
/**
 * The SiteController is used for external requests to the search engine
 *
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace app\controllers;

use Yii;
use yii\base\HttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Json;

use app\models\Pages;
use app\models\Comment;
use app\models\User;
use app\models\Workflow;

class PagesController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @var String the default layout that will be rendered
	 */
	public $layout='cms/column2';

	public function behaviors() {
		return array(
			'AccessControl' => array(
				'class' => '\yii\web\AccessControl',
				'rules' => array(
					array(
						'allow'=>true, 
						'roles'=>array('@'), // allow authenticated users to access all actions
					),
					array(
						'allow'=>false
					),
				)
			)
		);
	}

	public function actions()
	{
		return array(
			'connector' => array(
				'class' => 'yii2elfinder\ConnectorAction',
				'clientOptions'=>array(
					'locale' => '',	
					'roots'  => array(
				        array(
				        	'rootAlias' => 'CMS Bilder',
				            'driver' => 'LocalFileSystem',
				            'path'   => dirname(__DIR__).'/../www/img/cms/',
				            'URL'    => '',				            
				            'mimeDetect' => 'internal',
				            'dotFiles' => false,
				            'uploadAllow' => array('image'),
							'accessControl' => 'access',
							'perms'=>array(
								 '/^$/' => array('read'=>true, 'write'=>true,  'rm'=>false),
								 '/^gallery\/pictures$/' => array('read'=>true, 'write'=>true,  'rm'=>false),
							)
				        )
				    ) 	
				)
			)
		);
	}

	public function actionView($id){
		$model=$this->loadModel($id);
		$comment=$this->newComment($model);
		return $this->render('view',array(
			'model'=>$model,
			'comment'=>$comment,
		));
	}

	public function actionDiffview($id){
		$model = $this->loadParentModel($id);
		$compareModel = Pages::find($id);

		$diff = new \SebastianBergmann\Diff;
		$difftext = $diff->diff($compareModel->body,$model->body);

		return $this->render('view_diff',array(
			'difftext' => $difftext,
			'model'=>$model,
		));
	}

	public function actionViewparent($id){
		$model=$this->loadParentModel($id);
		$comment=$this->newComment($model);
		return $this->render('view',array(
			'model'=>$model,
			'comment'=>$comment,
		));
	}

	
	/**
	* renders the file manager for the content management system
	*/

	public function actionFilemanager(){
		//will not use any layout
		$this->layout = 'column1_plain';
		return $this->render('elfinder');
	}


	public function actionCreate($id = NULL)
	{
		$this->layout='column1';

		$model=new Pages();
		if(!is_null($id))
			$model->parent_pages_id = $id;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('/pages/view','id'=>$model->id));
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
			return $this->redirect(array('/pages/view','id'=>$model->id));
		}

		return $this->render('update',array(
			'model'=>$model,
		));
	}

	protected function newComment($page)
	{
		$comment=new Comment();
		if($comment->load($_POST) && $page->addComment($comment))
		{
			if($comment->status==Workflow::STATUS_PENDING)
				Yii::$app->session->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
			Yii::$app->response->refresh();
		}
		return $comment;
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
				$this->_model=Pages::find($id);				
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Returns the parent data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadParentModel($id='')
	{
		if($this->_model===null)
		{
			if(!empty($id))
			{
				$tmpModel = $this->loadModel($id);
				$this->_model=Pages::find($tmpModel->parent_pages_id);				
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	public function actionJsontreeview($id=NULL,$rootId=NULL)
	{
		if(!is_NULL($rootId) AND is_null($id))
			$data = Pages::rootTreeAsArray($rootId);
		else
			$data = Pages::nodeChildren($id,true);
		return Yii::$app->response->sendContentAsFile(Json::encode($data),'tree.json','application/json');
	}

}