<?php

namespace app\models;

use \Yii;
use \yii\base\Model;

use app\models\User;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
	public $username;
	public $password;
	public $rememberMe = true;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password are both required
			array('username, password', 'required'),
			// password is validated by validatePassword()
			array('password', 'validatePassword'),
			// rememberMe must be a boolean value
			array('rememberMe', 'boolean'),
		);
	}

	/**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
			'username'       => Yii::t('app','Username'),
			'password'       => Yii::t('app','Password'),
			'rememberMe'     => Yii::t('app','remember me'),
        );
    }

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 */
	public function validatePassword()
	{
		$user = User::findByUsername($this->username);
		if (!$user || !$user->validatePassword($this->password)) {
			$this->addError('password', 'Incorrect username or password.');
		}
	}	

	/**
	 * Logs in a user using the provided username and password.
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			$user = User::findByUsername($this->username);
			Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
			/*$loginuser = User::find($user->id);
			$loginuser->time_login = time();
			$loginuser->save();*/
			return true;
		} else {
			return false;
		}
	}

}
