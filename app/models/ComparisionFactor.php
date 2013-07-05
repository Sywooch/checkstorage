<?php

namespace app\models;

use \yii\db\ActiveRecord;
use \yii\base\Model;
use \yii\helpers\ArrayHelper;
use \Yii;

class ComparisionFactor extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%comparision_factor}}';
    }

 	public function rules()
	{
	    return array(
	        array('storage_id', 'required'),
            array('name, country, address, city,max_degrees,min_degrees','string'),
            array('date_opening','date'),
            array('no_parking,opening_office_days,opening_days,music,shopping_pricelevel,shopping,no_elevators,fireprotection,externalunits,security_camera,security_access,security_service,trolleys,aircondition,aircondition_office','integer'),
            array('room_height','double'),
            array('opening_office_end,opening_office_start,opening_start,opening_end','time'),	        
	    );
	}

    /**
    * @return model \app\models\storage Store
    */

    public function getStore(){
        return $this->hasOne('Storage', array('id' => 'storage_id'));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                   => 'ID',
            'storage_id'           => Yii::t('app','Standort'),
            'date_opening'         => Yii::t('app','Eröffnungsdatum'),
            'no_elevators'         => Yii::t('app','Anzahl Aufzüge'),
            'room_height'          => Yii::t('app','Raum Höhe'),
            'fireprotection'       => Yii::t('app','Feuerschutz'),
            'externalunits'        => Yii::t('app','Aussenlager'),
            'security_camera'      => Yii::t('app','Kameraüberwacht'),
            'security_access'      => Yii::t('app','Zugangssicherung'),
            'security_service'     => Yii::t('app','Sicherheitsdienst'),
            'trolleys'             => Yii::t('app','Ladewagen'),
            'aircondition'         => Yii::t('app','Klimaanlage'),
            'aircondition_office'  => Yii::t('app','Klimaanlage Büro'),
            'max_degrees'          => Yii::t('app','max. Temp. Sommer'),
            'min_degrees'          => Yii::t('app','min. Temp. Winter'),
            'shopping'             => Yii::t('app','Verpackungsmaterial'),
            'shopping_pricelevel'  => Yii::t('app','Preisniveau Shop'),
            'music'                => Yii::t('app','Musik'),
            'opening_start'        => Yii::t('app','Zugang Abteil von'),
            'opening_end'          => Yii::t('app','Zugang Abteil bis'),
            'opening_days'         => Yii::t('app','Zugangstage'),
            'opening_office_start' => Yii::t('app','Bürozeiten von'),
            'opening_office_end'   => Yii::t('app','Bürozeiten bis'),
            'opening_office_days'  => Yii::t('app','Bürotage'),
            'no_parking'           => Yii::t('app','Kundenparkplätze'),
        );
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::$app->controller->createUrl('/comparisionfactor/view', array(
            'id'=>$this->id,
            'name'=>$this->name,
        ));
    }

}
