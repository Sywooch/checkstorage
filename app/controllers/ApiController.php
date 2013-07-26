<?php
/**
 * The ApiController is used for external requests to the search engine
 *
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\base\HttpException;
use yii\helpers\Json;

use \SimpleXMLElement;
use app\components\XmlImporter;

class ApiController extends Controller
{
	
	public function behaviors() {
		return array(
			'AccessControl' => array(
				'class' => '\yii\web\AccessControl',
				'rules' => array(
					array(
						'allow'=>true,
					)
				)
			)
		);
	}

	/**
	 * Creates a text query based upon user input
	 *
	 * @param string $tablename table
	 */
	public function actionFetchtable($tablename,$secret)
	{
		$allowedTables = array('tbl_location','tbl_user');
		if(in_array($tablename,$allowedTables) && $secret=='t0p53cr3t'){
			$db = Yii::$app->getComponent('db');

			$command = $db->createCommand('SELECT * FROM '.$tablename);
		 	$result = $command->queryAll();
			
			header('Content-type: application/xml');
			$xml = new SimpleXMLElement('<results></results>');
			echo XmlImporter::toXML($result, 'result',$xml);
			exit;
		}
	}

	public function actionJsontestdata(){
		header('Content-type: application/json');
		echo Json::encode(array(
			array('year'=>'2011','value'=>18,'colors'=>'#228B22'),
			array('year'=>'2012','value'=>12,'colors'=>'#458B00'),
			array('year'=>'2013','value'=>8,'colors'=>'#B3EE3A'),
		));
		exit;
	}

}