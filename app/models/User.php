<?php

namespace app\models;

use \yii\web\Identity;
use \yii\db\ActiveRecord;
use \yii\helpers\ArrayHelper;
use \yii\helpers\SecurityHelper;
use \yii\base\Model;
use \Yii;

class User extends ActiveRecord implements Identity
{
	/**
     * @return string the associated database table name
     */
	public static function tableName()
    {
        return '{{%user}}';
    }

	const ROLE_SYSADMIN = 0;
    const ROLE_ADMIN    = 1;
    const ROLE_USER_ADVANCED = 2;    
    const ROLE_USER     = 3;

    public static $roles = array(
		self::ROLE_SYSADMIN      => 'System Administrator',
		self::ROLE_ADMIN         => 'Administrator',
		self::ROLE_USER_ADVANCED => 'Fortgeschrittener',
		self::ROLE_USER          => 'Standard Benutzer',
    );

    public static function getRoleOptions()
    {
        return self::$roles;
    }

    /**
     * Returns a string representation of the model's role
     *
     * @return string The role of this model as a string
     */
    public function getRoleAsString()
    {
    	$options = self::getRoleOptions();
    	return isset($options[$this->role]) ? $options[$this->role] : '';
    }

    const POS_STORE = 0;
    const POS_CUSTOMER = 1;
    const POS_LEAD = 2;
    
    public static $positions = array(
		self::POS_STORE         =>'Lagerraumanbieter',
		self::POS_CUSTOMER      =>'Kunde',
		self::POS_LEAD          =>'Interessent',
	);

    public static function getPostitionOptions()
    {
    	return self::$positions;
    }

	/**
     * Returns a string representation of the model's position
     *
     * @return string The position of this model as a string
     */
    public function getPositionAsString()
    {
    	$options = self::getPostitionOptions();
    	return isset($options[$this->position]) ? $options[$this->position] : '';
    } 
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('id');
    }

	/**
	* @return model \app\models\user reports to user
	*/

	public function getReportTo(){
		return $this->hasOne('User', array('id' => 'parent_user_id'));
	}

	/**
	* @return model \app\models\user backup user
	*/

	public function getBackup(){
		return $this->hasOne('User', array('id' => 'backup_user_id'));
	}

	/**
	* before we save the record, we will md5 the password
	*/
	public function beforeSave($insert){
		if (parent::beforeSave($insert)) {
			if ($insert) {
				$this->password = md5($this->password);
				$this->backup_user_id==0?$this->backup_user_id = NULL:'';
				$this->parent_user_id==0?$this->parent_user_id = NULL:'';
			}else{
				$this->parent_user_id==0?$this->parent_user_id = NULL:'';
				$this->backup_user_id==0?$this->backup_user_id = NULL:'';
			}
			return true;
		} else {
			return false;
		}
	}
 
 	public function rules()
	{
	    return array(
	    	array('username','required'),
	    	array('username', 'filter', 'filter' => 'trim'),
	    	array('username', 'string', 'min' => 2, 'max' => 255),
	    	array('username', 'unique', 'message' => 'This username has already been taken.'),

	    	array('email', 'filter', 'filter' => 'trim'),
	    	array('email', 'required'),
			array('email', 'email'),
			array('email', 'unique', 'message' => 'This email has already been taken.'),
			
			array('password', 'required'),
			array('password', 'string', 'min' => 6),

	    	array('no_employee','string','max'=>25),
	        array('phone, name, prename, mobile,messanger,fax', 'string', 'max'=>128),
	        array('date_entry, date_exit','date'),
	        array('position, parent_user_id, backup_user_id, role','integer'),
	    );
	}

	public function scenarios()
	{
		return array(
			'signup' => array('username', 'email', 'password','name','prename','phone','mobile','fax','role'),
			'login'  => array('username', 'password'),
			'default' => array('username', 'email', 'password','name','prename','phone','mobile','fax','role','messanger'),
		);
	}

	/**
	 * Returns all possible lists to choose from as an associative array
	 *
	 * @return array The array of lists
	 */
	public static function getListOptions()
	{
		$returnme = array();
		$returnme[] = array('0'=>'NONE AVAILABLE! Gibts net!');
		$returnme[] = ArrayHelper::map(User::findBySQL('SELECT id, CONCAT(name,", ",prename) AS name FROM tbl_user ORDER BY name')->all(),'id','name');
		return $returnme;
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
			'id'             => 'ID',
			'parent_user_id' => Yii::t('app','Reports To'),
			'backup_user_id' => Yii::t('app','Backup User'),
			'username'       => Yii::t('app','Benutzername'),
			'password'       => Yii::t('app','Passwort'),
			'email'          => Yii::t('app','EMail'),
			'role'           => Yii::t('app','Rolle'),
			'messanger'      => Yii::t('app','Messanger'),
			'fax'            => Yii::t('app','Fax'),
			'mobile'         => Yii::t('app','Mobile Phone'),
			'phone'          => Yii::t('app','Phone'),
			'name'           => Yii::t('app','Fam. Name'),
			'prename'        => Yii::t('app','Prename'),
			'no_employee'    => Yii::t('app','Employee No'),
			'position'       => Yii::t('app','Zweck'),
        );
    }

	public static function searchByString($query){
		return static::find()->where("UPPER(name) LIKE '%".strtoupper($query)."%' OR UPPER(prename) LIKE '%".strtoupper($query)."%'")->all();
	}

    /**
	 * all functions needed for identity
	 */

    public static function findIdentity($id)
	{
		return static::find($id);
	}

	public static function findByUsername($username)
	{
		$user = static::find()->where('username=:username', array('username'=>$username))->one();
		if ($user) {
			return new self($user);
		}
		else
			return null;
	}

	public function getId()
	{
		return $this->id;
	}	

	public function getAuthKey()
	{
		return $this->authKey;
	}

	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	* Checks if the given password is correct.
	* @param string the password to be validated
	* @return boolean whether the password is valid
	*/
	public function validatePassword($password)
	{
		return md5($password)===$this->password?true:false;		
	}

}
