<?php

namespace app\models;

use \Yii;
use \yii\base\Model;

use app\components\UserIdentity;
use app\components\GeoLocation;

/**
 * LoginForm is the model behind the login form.
 */
class StorageSearchForm extends Model
{
	public $address;
	public $date_start;
	public $double_sqm;
	public $double_distance = 5;
	public $int_weeks;

	public $latitude;
	public $longitude;

	public $min_latitude;
	public $min_longitude;

	public $max_latitude;
	public $max_longitude;
	
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
			'address'         => Yii::t('app','Wo?'),
			'date_start'      => Yii::t('app','Beginn'),
			'double_sqm'      => Yii::t('app','Fläche in qm'),
			'double_distance' => Yii::t('app','Umkreis (km)'),
			'int_weeks'       => Yii::t('app','Erwartete Lagerzeit'),
        );
    }

    public function placeFinder(){
		$location = $this->address;
	    $response = GeoLocation::getGeocodeFromGoogle($location);
	    $this->latitude = $response->results[0]->geometry->location->lat;
	    $this->longitude = $response->results[0]->geometry->location->lng;

	    $startpoint = GeoLocation::fromDegrees($this->latitude, $this->longitude);
    	$coordinates = $startpoint->boundingCoordinates((double)$this->double_distance, 'miles');

        $this->min_latitude = $coordinates[0]->degLat;
        $this->min_longitude = $coordinates[0]->degLon;

        $this->max_latitude = $coordinates[1]->degLat;
        $this->max_longitude = $coordinates[1]->degLon;
    }

}
