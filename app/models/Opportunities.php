<?php

namespace app\models;

use \yii\db\ActiveRecord;
use \yii\base\Model;
use \yii\helpers\ArrayHelper;
use \Yii;

use app\components\GeoLocation;

class Opportunities extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%opportunities}}';
    }

 	public function rules()
	{
	    return array(
	        array('name, user_id', 'required'),
            array('name, country, address, city','string','max'=>255),
            array('zipcode','string','max'=>15),
            array('date_start,date_created,date_deleted','date'),
            array('no_latitude, no_longitude,double_sqm','float'),	        
	    );
	}

    /**
    * @return model \app\models\user Owner
    */
    public function getRequester(){
        return $this->hasOne('User', array('id' => 'user_id'));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => 'ID',
            'country'           => Yii::t('app','Land'),
            'address'           => Yii::t('app','Adresse'),
            'city'              => Yii::t('app','Stadt'),
            'zipcode'           => Yii::t('app','Postleitzahl'),
            'date_start'       => Yii::t('app','Benötigt ab'),
            'date_created'       => Yii::t('app','Erstellt am'),
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
		return ArrayHelper::map(Opportunities::find()->orderBy('zipcode ASC')->all(),'id','name');
	}

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::$app->controller->createUrl('/opportunities/view', array(
            'id'=>$this->id,
            'name'=>$this->name,
        ));
    }

}
