<?php

namespace app\models;

use \Yii;
use \yii\base\Model;

use app\components\UserIdentity;

/**
 * LoginForm is the model behind the login form.
 */
class StorageSearchForm extends Model
{
	public $address;
	public $date_start;
	public $double_sqm;
	public $double_distance;
	public $int_weeks;
	
	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password are both required
			array('address', 'string'),
			array('date_start','date'),
			array('double_sqm, double_distance','double'),
			array('int_weeks','integer'),
		);
	}

	/**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
			'address'       => Yii::t('app','Wo?'),
			'date_start'       => Yii::t('app','Beginn'),
			'double_sqm'     => Yii::t('app','Fläche in qm'),
			'double_distance'     => Yii::t('app','Umkreis (km)'),
			'int_weeks'     => Yii::t('app','Geplante Lagerzeit'),
        );
    }

}
