<?php

namespace app\controllers;

use \Yii;
use \yii\web\Controller;
use \yii\data\Pagination;
use \yii\web\HttpException;
use \yii\helpers\Json;
use \yii\db\Query;

use app\models\User;
use app\models\Messages;

class UserController extends Controller
{
	public $layout='column2';

	/**
	* @var string the default command action.
	*/
	public $defaultAction = 'view';

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
				        'actions'=>array('view','update','index','admin','jsongriduserdata','create','softdelete'),
						'roles'=>array('@'),
		            ),
		            array(
		            	'allow'=>false, //deny all users						
					),					
				)
			)
		);
	}

	public function actionView($id='')
	{
		$model=$this->loadModel($id);

		/**
		* LOADING THE MESSAGES
		*/
		$msgquery = Messages::getAdapterForInbox($id);

		$countmsgQuery = clone $msgquery;
		$msgpagination = new Pagination($countmsgQuery->count());
		$msgpagination->totalCount = $countmsgQuery->count();

		$msgmodels = $msgquery->offset($msgpagination->offset)
						->limit($msgpagination->limit)
						->all();

		return $this->render('view',array(
			'model'=>$model,
			'msgmodels' => $msgmodels,
			'pagination' => $msgpagination,			
		));
	}

	public function actionUpdate($id)
	{
		$this->layout = 'column1';
		$model=$this->loadModel($id);
		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(array('/user/view','id'=>$id));
		}

		return $this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* create a new user
	* @return view create
	* @return model
	*/

	public function actionCreate()
	{
		$this->layout = 'column1';
		$model=new User();
		if ($model->load($_POST) && $model->save()) {
			$this->sendCreateNotificationMail($model);
			return $this->redirect(array('view','id'=>$model->id));
		}

		return $this->render('create',array(
			'model'=>$model,
		));
	}

	private static function sendCreateNotificationMail(){
		$mail = new \PHPMailer;

		$mail->IsSMTP();                                      			// Set mailer to use SMTP
		$mail->Host       = Yii::$app->params['mailconfig']['Host'];  	// Specify main and backup server
		$mail->SMTPAuth   = true;                               		// Enable SMTP authentication
		$mail->Username   = Yii::$app->params['mailconfig']['Username'];// SMTP username
		$mail->Password   = Yii::$app->params['mailconfig']['Password'];// SMTP password
		//$mail->SMTPSecure = 'tls';                            			// Enable encryption, 'ssl' also accepted

		$mail->From = Yii::$app->params['adminEmail'];
		$mail->FromName = Yii::$app->params['mailerAlias'];
		$mail->AddAddress($model->email, $model->name.', '.$model->prename);  // Add a recipient
		$mail->AddBCC(Yii::$app->params['adminEmail'], 'Administrator');  // Add a recipient
		
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->IsHTML(true);                                  // Set email format to HTML

		$mail->Subject = Yii::$app->params['mailerAlias'].' - User Registration';
		$mail->Body    = 'Welcome, <p>you are created as a new user under '.Yii::$app->params['consoleBaseUrl'].' and you can login with your credentials!</p><p>If you have any questions feel free to contact '.Yii::$app->params['adminEmail'].'.</p> Enjoy!';
		$mail->AltBody = 'Welcome, you are created as a new user under '.Yii::$app->params['consoleBaseUrl'].' and you can login with your credentials! If you have any questions feel free to contact '.Yii::$app->params['adminEmail'].'. Enjoy!';

		if(!$mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		}
	}

	public function actionSoftdelete($id)
	{
		// we only allow deletion via POST request
		$model = $this->loadModel($id);
		$model->date_exit = date('Y-m-d');
		$model->save();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		return $this->redirect(array('admin'));
	}

	public function actionIndex($tag='')
	{
		$this->layout = 'column2';
		$query = User::find();

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
		return $this->render('admin', array());
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
				$this->_model=User::find($id);				
			}
			if($this->_model===null)
				throw new \yii\web\HttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * returns the current holiday, sickness, etc. values for passed user
	 *
	 * @param int $id The user id (used for paginating)
	 */

	public function actionJsongriduserdata(){
		
		$query = new Query;
		$query->select('user.id AS user_id, user.name AS user_name, user.prename, costcenter.name, date_entry')
			->from('tbl_user user')
		    ->join('INNER JOIN', 'tbl_location location', 'location.id = location_id')
		    ->join('INNER JOIN', 'tbl_costcenter costcenter', 'costcenter.id = costcenter_id')
		    ->where('user.date_exit IS NULL')
			->orderBy('user.name');

		$command = $query->createCommand();

		$count = User::find();

		$models = $command->queryAll();

		$clean = array('pos'=>0, 'total_count'=>$count->count());
		$ii=0;
		foreach($models AS $record){
			$clean['rows'][]=array(
				'id' => $record['user_id'],
				'data' => array_values($record),
			);
		}
		header('Content-type: application/json');
		echo Json::encode($clean);
		exit;
	}

}
