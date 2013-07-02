<?php

namespace app\models;

use \yii\web\Identity;
use \yii\db\ActiveRecord;
use \yii\helpers\ArrayHelper;
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
		self::ROLE_SYSADMIN      => 'Sysadmin',
		self::ROLE_ADMIN         => 'Admin',
		self::ROLE_USER_ADVANCED => 'Advanced User',
		self::ROLE_USER          => 'User',
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

    const POS_OWNER = 0;
    const POS_MANAGEMENT = 1;
    const POS_OFFICE = 2;
    const POS_STORE = 3;
    const POS_STORE_SERVICE = 4;

    public static $positions = array(
		self::POS_OWNER         =>'Owner',
		self::POS_MANAGEMENT    =>'Management',
		self::POS_OFFICE        =>'Office',
		self::POS_STORE         =>'Store',
		self::POS_STORE_SERVICE =>'Housekeeper',
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
	* @return model \app\models\location location name
	*/

	public function getLocation(){
		return $this->hasOne('Location', array('id' => 'location_id'));
	}

	/**
	* @return model \app\models\orga orga name
	*/

	public function getOrgunit(){
		return $this->hasOne('Orgunit', array('id' => 'orgunit_id'));
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
	    	array('no_employee','string','max'=>25),
	        array('username, password, email, phone, name, prename, mobile,messanger,fax', 'string', 'max'=>128),
	        array('date_entry, date_exit','date'),
	        array('position, parent_user_id, backup_user_id, orgunit_id, location_id, role','integer'),
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
			'username'       => Yii::t('app','Username'),
			'password'       => Yii::t('app','Password'),
			'email'          => Yii::t('app','EMail'),
			'role'           => Yii::t('app','Role'),
			'location_id'    => Yii::t('app','Location'),
			'orgunit_id'     => Yii::t('app','Org Unit'),
			'messanger'      => Yii::t('app','Messanger'),
			'fax'            => Yii::t('app','Fax'),
			'mobile'         => Yii::t('app','Mobile Phone'),
			'phone'          => Yii::t('app','Phone'),
			'name'           => Yii::t('app','Fam. Name'),
			'prename'        => Yii::t('app','Prename'),
			'no_employee'    => Yii::t('app','Employee No'),
        );
    }

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('app','Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		return $salt;
	}

	public static function searchByString($query){
		return static::find()->where("UPPER(name) LIKE '%".strtoupper($query)."%' OR UPPER(prename) LIKE '%".strtoupper($query)."%'")->all();
	}

	public static function getAdapterForHoliday() {
        return static::find()
        		->select('id, name, prename, orgunit_id, location_id')
        		->orderBy('name ASC');
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
		return md5($password)===$this->password;
		//return crypt($password,$this->password)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return md5($password);
		//return crypt($password, $this->generateSalt());
	}


}
