<?php
/**
 * The SiteController is used for external requests to the search engine
 *
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace app\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\web\HttpException;
use \yii\data\Pagination;

use app\models\Post;
use app\models\User;
use app\models\Messages;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Workflow;

class SiteController extends Controller
{

	/**
	* @var string the default layout
	*/
	public $layout='column3';

	/**
	* @var string the default command action.
	*/
	public $defaultAction = 'index';
	
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'yii\web\CaptchaAction',
			),
			'page' => array(
				'class' => 'app\actions\ViewAction',				
			),
			'connector' => array(
				'class' => 'yii2elfinder\ConnectorAction',
				'clientOptions'=>array(
					'locale' => '',
					'roots'  => array(
				        array(
				            'driver' => 'LocalFileSystem',
				            'path'   => dirname(__DIR__).'/../www/',
				            'URL'    => '',
				        )
				    ) 	
				)
			)
		);
	}

	public function behaviors() {
		return array(
			'AccessControl' => array(
				'class' => '\yii\web\AccessControl',
				'rules' => array(
					array(
						'allow'=>true,
						'actions'=>array('login'),
						'roles'=>array('?'), // allow guest users to access the named actions 
					),
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

	public function actionIndex($tag='All')
	{
		$this->layout = 'column3';

		//check for unread messages
		$unread = 0;
		if(!Yii::$app->user->isGuest)
			$unread = Messages::getCountUnreaded(Yii::$app->user->identity->id)->count();

		//the blog part!
		$query = Post::find()
			->where('status="'. Workflow::STATUS_PUBLISHED.'"')
			->orderBy('time_update DESC');

		if (!empty($tag))
			$query->andWhere(array('like', 'tags', '%'.$tag.'%'));
		$countQuery = clone $query;
		$pagination = new Pagination($countQuery->count());

		$models = $query->offset($pagination->offset)
				->limit($pagination->limit)
				->with('comments', 'author')
				->all();

		return $this->render('index',array(
			'models' => $models,
			'pagination' => $pagination,
			'msgunread'=>$unread
		));		
	}

	public function actionLogin()
	{
		$this->layout = 'column1_plain';

		$model = new LoginForm();
		if ($model->load($_POST) && $model->login()) {
			return $this->redirect(array('site/index'));
		} else {
			return $this->render('login', array(
				'model' => $model,
			));
		}
	}

	public function actionLogout()
	{
		Yii::$app->getUser()->logout();
		Yii::$app->getResponse()->redirect(array('site/index'));
	}

	public function actionContact()
	{
		$model = new ContactForm;
		if ($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');
			Yii::$app->response->refresh();
		} else {
			return $this->render('contact', array(
				'model' => $model,
			));
		}
	}

	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionFilemanager()
	{
		$this->layout = 'column1';
		return $this->render('elfinder');
	}

}
