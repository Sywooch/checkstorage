<?php

namespace app\models;

use \yii\db\ActiveRecord;
use \yii\base\Model;
use \yii\helpers\ArrayHelper;
use \Yii;

use app\components\GeoLocation;
use app\modules\components\units\models\Unit;

class Storage extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%storage}}';
    }

    public static $countries = array(
        'DE' => 'Deutschland',
        'AT' => 'Österreich',
        'FR' => 'Frankreich',
        'CH' => 'Schweiz',
    );

    public static function getCountryOptions()
    {
        return self::$countries;
    }

 	public function rules()
	{
	    return array(
	        array('name, user_id, address', 'required'),
            array('name, country, address, city','string','max'=>255),
            array('zipcode','string','max'=>15),
            array('no_latitude, no_longitude','string'),	        
	    );
	}

    /**
    * before we save the record, we will calculate the cordinates
    */
    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {
            $location = $this->address . ' ,'.$this->city.' ,'. $this->country;
            $response = GeoLocation::getGeocodeFromGoogle($location);
            $this->no_latitude = $response->results[0]->geometry->location->lat;
            $this->no_longitude = $response->results[0]->geometry->location->lng;
            return true;
        } else {
            return false;
        }
    }

    /**
    * @return model \app\models\user Owner
    */
    public function getOwner(){
        return $this->hasOne('User', array('id' => 'user_id'));
    }

    /**
    * @return model \app\models\comparisonfactor Comparison Factor
    */
    public function getComparision(){
        return $this->hasOne('ComparisionFactor', array('storage_id' => 'id'));
    }

    /**
    * @return model \app\models\comparisonfactor Comparison Factor
    */
    public function getUnits(){
        return $this->hasMany('\app\modules\units\models\Unit', array('storage_id' => 'id'));
    }

    /**
    * @return model \app\models\comparisonfactor Comparison Factor
    */
    public function getUnitPrice($size=1){
        return $this->hasOne('Unit', array('storage_id' => 'id'))
            ->where('size_code = :size_code',array(':size_code'=>(double)$size))
            ->orderBy('size_code ASC')
            ->limit(1);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => 'ID',
            'name'              => Yii::t('app','Name'),
            'country'           => Yii::t('app','Land'),
            'address'           => Yii::t('app','Adresse'),
            'city'              => Yii::t('app','Stadt'),
            'zipcode'           => Yii::t('app','Postleitzahl'),
            'no_longitude'      => Yii::t('app','Longitude'),
            'no_latitude'       => Yii::t('app','Latitude'),
        );
    }

    /**
	 * Returns all possible lists to choose from as an associative array
	 *
	 * @return array The array of lists
	 */
	public static function getListOptions()
	{
		return ArrayHelper::map(storage::find()->orderBy('zipcode ASC')->all(),'id','name');
	}

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::$app->controller->createUrl('/storage/view', array(
            'id'=>$this->id,
            'name'=>$this->name,
        ));
    }

    /**
    * search storage by quicksearch form
    * @param model search params to be looked up
    */
    public static function searchQuickForm($model,$limit=5){
        //here we need to implement a google place search returning geo kordinates and then look for places around the search string
        //return static::find()->where("UPPER(city) LIKE '%".strtoupper($model->address)."%'")->limit($limit);
        return static::find()->where("(no_latitude BETWEEN '".$model->min_latitude."' AND '".$model->max_latitude."') AND  (no_longitude BETWEEN '".$model->min_longitude."' AND '".$model->max_longitude."')")->limit($limit);
    }

    public function calcDistanceBetween($latidute,$longitude)
    {
        // Set locations
        $storeplace = GeoLocation::fromDegrees($this->no_latitude, $this->no_longitude);
        $userplace  = GeoLocation::fromDegrees($latidute, $longitude);
        return $storeplace->distanceTo($userplace, 'miles');
    }

}
