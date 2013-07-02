<?php
namespace app\models\worddocs;

use Yii;
use \yii\base\Model;

/**
 * Holiday Employee Word Document is the model behind the contact form.
 */
class HolidayEmployeeDoc extends Model
{
	/**
	* @var $PHPWord object will hold the complete document instance
	*/
	public $PHPWord = NULL;

	public $globalStyles = array(
		'heading1' => array('name'=>'Avenir','color'=>'00688B', 'size'=>18, 'bold'=>true),
		'heading2' => array('name'=>'Avenir','color'=>'2E2E2E', 'size'=>16, 'bold'=>false),
		'heading3' => array('name'=>'Avenir','color'=>'000000', 'size'=>14, 'bold'=>false),
	);

	public $globalTableStyles = array(
		'table' => array('borderColor'=>'9FB6CD','borderSize'=>1,'cellMargin'=>10),
		'thead' => array('bgColor'=>'E0EEEE', 'bold'=>true),
	);


	public function getPHPWord(){
		return $this->PHPWord;
	}
	
	public function createDocument($PHPWord,$user_id,$year='2013')
	{		
		$Employee = \app\models\User::find($user_id);
		$this->PHPWord = $PHPWord;
		// Every element you want to append to the word document is placed in a section. So you need a section:
		$section = $this->PHPWord->createSection();
		//logo
		$section->addImage( Yii::$app->basePath."/../www/img/myplace_logo.jpg", array('align'=>'right'));
		
		//header
		$section->addText(utf8_decode(Yii::t('app','Employee Book Holiday')),$this->globalStyles['heading1']);
		$section->addText(utf8_decode($Employee->name.' ,'.$Employee->prename),$this->globalStyles['heading2']);
		
		$section->addTextBreak();
		$section->addText(utf8_decode(Yii::t('app','General')),$this->globalStyles['heading3']);
		$this->PHPWord->addTableStyle('myTable', $this->globalTableStyles['table'], $this->globalTableStyles['thead']);
		$table = $section->addTable('myTable');
		$table->addRow(200);
		$table->addCell(2000)->addText('Field');
		$table->addCell(4000)->addText('Value');
		$table->addRow();
		$table->addCell(2000)->addText(Yii::t('app','Date Entry'));
		$table->addCell(4000)->addText($Employee->date_entry);
		$table->addRow();
		$table->addCell(2000)->addText(Yii::t('app','Region'));
		$table->addCell(4000)->addText($Employee->Location->name);
		$table->addRow();
		$table->addCell(2000)->addText(Yii::t('app','Costcenter'));
		$table->addCell(4000)->addText($Employee->Location->Costcenter->name);

		$section->addTextBreak();
		$section->addText(utf8_decode(Yii::t('app','Statistics')),$this->globalStyles['heading3']);
		$this->PHPWord->addTableStyle('myStatTable', $this->globalTableStyles['table'], $this->globalTableStyles['thead']);
		$stattable = $section->addTable('myStatTable');
		$stattable->addRow(200);
		$stattable->addCell(2000)->addText('Field');
		$stattable->addCell(4000)->addText('Value');
		$stattable->addRow();
		$stattable->addCell(2000)->addText(Yii::t('app','Current Saldo'));
		$stattable->addCell(4000)->addText(\app\models\TimeTable::getCurrentSaldo($Employee->id,$year)->double_value*1);

		$section->addTextBreak();
		$section->addText(utf8_decode(Yii::t('app','Bookings')),$this->globalStyles['heading3']);
		$periods = \app\models\TimeTable::getUserBookings($Employee->id,$year);

		$this->PHPWord->addTableStyle('myBookTable', $this->globalTableStyles['table'], $this->globalTableStyles['thead']);
		$booktable = $section->addTable('myBookTable');
		$booktable->addRow();
		$booktable->addCell(2000)->addText(Yii::t('app','Date'));
		$booktable->addCell(800)->addText(Yii::t('app','Week of year'));
		$booktable->addCell(3200)->addText(Yii::t('app','Category'));
		$booktable->addCell(1000)->addText(Yii::t('app','Status'));
		$booktable->addCell(1800)->addText(Yii::t('app','Value'));
		foreach($periods As $periode)
		{
			$booktable->addRow();
			$booktable->addCell(2000)->addText($periode->date_start);
			$booktable->addCell(800)->addText(date('W',strtotime($periode->date_start)));
			$booktable->addCell(3200)->addText(utf8_decode(Yii::t('app',$periode->CategoryAsString)));
			$booktable->addCell(1000)->addText(utf8_decode(Yii::t('app',$periode->status)));
			$booktable->addCell(1800)->addText(utf8_decode(Yii::t('app',$periode->double_value)));
		}
	}

}
