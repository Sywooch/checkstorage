<?php

namespace app\models;

use \yii\db\ActiveRecord;
use \yii\base\Model;
use \yii\helpers\ArrayHelper;
use \Yii;

class Storage extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%storage}}';
    }

 	public function rules()
	{
	    return array(
	        array('name, user_id', 'required'),
            array('name, country, address, city','string','max'=>255),
            array('zipcode','string','max'=>15),	        
	    );
	}

    /**
    * @return model \app\models\costcenter costcenter
    */

    public function getOwner(){
        return $this->hasOne('User', array('id' => 'user_id'));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => 'ID',
            'name'              => Yii::t('app','Name'),
            'country'           => Yii::t('app','Country'),
            'address'           => Yii::t('app','Address'),
            'city'              => Yii::t('app','City'),
            'zipcode'           => Yii::t('app','Zipcode'),
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
        return static::find()->where("UPPER(city) LIKE '%".strtoupper($model->address)."%'")->limit($limit);
    }

}
