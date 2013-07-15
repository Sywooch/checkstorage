<?php
namespace app\modules\units\models;

use \yii\db\ActiveRecord;
use \yii\helpers\Html;
use \Yii;

use app\models\Workflow;
use app\models\Comment;

class Unit extends ActiveRecord
{	
    const PERIOD_DAILY      = 0;
    const PERIOD_WEEKLY 	= 1;
    const PERIOD_4WEEK  	= 2;
    const PERIOD_MONTHLY  	= 3;
    
    public static $periods = array(
        self::PERIOD_DAILY   =>'Tagespreis',
        self::PERIOD_WEEKLY  =>'Wochenpreis',
        self::PERIOD_4WEEK   =>'4 Wochenpreis',
        self::PERIOD_MONTHLY =>'Monatspreis',
    );

    public static function getPeriodOptions()
    {
        return self::$periods;
    }

    public static function getPeriodAsString($rate_period)
    {
        return self::$periods[$rate_period];
    }

    /**
     * @return string the associated database table name
     */
	public static function tableName()
    {
        return '{{%unit}}';
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('storage_id,room_length,room_width', 'required'),
			array('room_length,room_width,room_height,unit_rate,size_code','double'),
			array('date_created','date'),
			array('unit_type,is_consumer,rate_period','integer'),
			array('unit_number','string','max'=>15),
			array('note','string'),
			array('current_status,accesskey', 'string', 'max'=>128),
		);
	}

	/**
    * @return model \app\models\storage Store
    */
    public function getStore(){
        return $this->hasOne('Storage', array('id' => 'storage_id'));
    }
	
    /**
    * @return model \app\models\storage Store
    */
    public function getWeekFactor(){
    	$week = 1;
    	switch($this->rate_period)
    	{
    		case 0:
    			$week = 7;
    			break;
    		case 1:
    			$week = 1;
    			break;
    		case 2:
    			$week = 0.25;
    			break;
    		default:
    			$week = 7/31;
    	}
        return $week;
    }

    /**
    * @return model \app\models\storage Store
    */
    public function getFourWeekFactor(){
    	$week = 1;
    	switch($this->rate_period)
    	{
    		case 0:
    			$week = 28;
    			break;
    		case 1:
    			$week = 4;
    			break;
    		case 2:
    			$week = 1;
    			break;
    		default:
    			$week = 28/31;
    	}
        return $week;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => 'Id',
			'storage_id'		=> Yii::t('app','Title'),
			'date_created'		=> Yii::t('app','Erzeugt am'),
			'room_height'		=> Yii::t('app','Höhe'),
			'room_length'		=> Yii::t('app','Länge'),
			'room_width'		=> Yii::t('app','Breite'),
			'unit_type'    		=> Yii::t('app','Art'),
			'unit_number'		=> Yii::t('app','Nummer'),
			'current_status' 	=> Yii::t('app','Status'),
			'is_consumer'		=> Yii::t('app','privat/gewerblich'),
			'rate_period'		=> Yii::t('app','Zeitraum'), // 1=week, 2=4weeks, 3=monthly, 0=daily
			'unit_rate'			=> Yii::t('app','Preis'),
			'size_code'			=> Yii::t('app','Größen Gruppe'),
			'note'				=> Yii::t('app','Notiz'),
			'accesskey'			=> Yii::t('app','Zugang'),
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::$app->controller->createUrl('unit/view', array(
			'id'=>$this->id,
			'title'=>$this->title,
		));
	}
}
