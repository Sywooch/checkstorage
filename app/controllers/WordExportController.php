<?php
/**
 * The ApiController is used for external requests to the search engine
 *
 * @author Philipp Frenzel <philipp@frenzel.net>
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

use \PHPWord;
use \PHPWord_IOFactory;

class WordExportController extends Controller
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
	public function actionHelloWorld()
	{
		// Create a new PHPWord Object
		$PHPWord = new PHPWord();
		// Every element you want to append to the word document is placed in a section. So you need a section:
		$section = $PHPWord->createSection();
		//header
		$section->addText(utf8_decode('Überschrift 1'),array('name'=>'Verdana'));
		// After creating a section, you can append elements:
		$section->addText('Hello world!');
		// You can directly style your text by giving the addText function an array:
		$section->addText('Hello world! I am formatted.', array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));
		// If you often need the same style again you can create a user defined style to the word document
		// and give the addText function the name of the style:
		$PHPWord->addFontStyle('myOwnStyle', array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
		$section->addText('Hello world! I am formatted by a user defined style', 'myOwnStyle');
		// You can also putthe appended element to local object an call functions like this:
		$myTextElement = $section->addText('Hello World!');
		self::buildDocument($PHPWord,'Helloworld.docx');		
	}

	/**
	* this will create the employeeholiday document
	*/

	public function actionEmployeeHolidaySheet($id){
		//create word object
		$PHPWord = new PHPWord();
		$docModel = new \app\models\worddocs\HolidayEmployeeDoc();
		$docModel->createDocument($PHPWord,$id);
		self::buildDocument($docModel->PHPWord,'HolidayEmployee.docx');
	}

	/**
	* builds the complete document, creates the header for the browser and sends it out to php output
	* @param $document object phpword
	* @param $filename string the filename of the document
	*/

	private static function buildDocument($document,$filename='tmp.docx'){
		//get the path
		$directory = Yii::$app->basePath."/../www/autodocs/";		

		// At least write the document to webspace:
		$objWriter = PHPWord_IOFactory::createWriter($document, 'Word2007');		
		$objWriter->save($directory.'helloworld.docx');

		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers
		header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header("Content-Disposition: attachment; filename=\"".$filename."\";" );
		header("Content-Transfer-Encoding: binary");
		ob_clean();
		flush();
		readfile($directory.'helloworld.docx');
		exit;
	}

}