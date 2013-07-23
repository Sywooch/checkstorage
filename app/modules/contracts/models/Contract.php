<?php

namespace app\modules\contracts\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use Yii;

class Contract extends ActiveRecord
{	
    /**
     * @return string the associated database table name
     */
	public static function tableName()
    {
        return '{{%contract}}';
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_id,user_id', 'required'),
			array('unit_id,user_id,is_consumer','integer'),
			array('date_created,date_start,date_end,date_deleted','date'),
			array('note','string'),		
		);
	}

	/**
    * @return model \app\modules\units\models\Unit Unit
    */
    public function getUnit(){
        return $this->hasOne('app\modules\units\models\Unit', array('id' => 'unit_id'));
    }

    /**
    * @return model \app\models\User User
    */
    public function getContractPartner(){
        return $this->hasOne('app\models\User', array('id' => 'user_id'));
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
			'id'                => 'Id',
			'user_id'		    => Yii::t('app','Vertragsnahmer'),
			'date_created'		=> Yii::t('app','Erzeugt am'),
			'date_start'        => Yii::t('app','Vertragsbegin'),
            'date_end'          => Yii::t('app','Vertragsende'),
            'date_deleted'      => Yii::t('app','Gelöscht am'),
            'is_consumer'		=> Yii::t('app','privat/gewerblich'),
			'note'				=> Yii::t('app','Notiz'),			
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::$app->controller->createUrl('/contracts/contracts/view', array(
			'id'=>$this->id,
			'unit'=>$this->Unit->unit_number,
		));
	}
}
