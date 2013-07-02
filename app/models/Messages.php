<?php

namespace app\models;

use \Yii\base\Model;
use \yii\db\ActiveRecord;
use \Yii;

class Messages extends ActiveRecord
{

	const DELETED_BY_RECEIVER = 'reciever';
	const DELETED_BY_SENDER = 'sender';

	//public $userModel;
	//public $userModelRelation;

	public $unreadMessagesCount;
 
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%messages}}';
    }
 
    /**
     * @return array primary key of the table
     **/     
    public static function primaryKey()
    {
        return array('id');
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reciever_id, sender_id', 'required'),
			array('reciever_id, sender_id', 'integer'),
			array('subject', 'required'),
			array('body, deleted_by, module','string'),
			array('subject', 'string', 'max'=>256),
			array('is_read', 'string', 'max'=>1),
		);
	}


	/**
	* @return model \app\models\user reciever
	*/

	public function getReciever(){
		return $this->hasOne('User', array('id' => 'reciever_id'));
	}

	/**
	* @return model \app\models\user sender
	*/
	
	public function getSender(){
		return $this->hasOne('User', array('id' => 'sender_id'));
	}
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'            => 'ID',
			'sender_id'     => 'Sender',
			'reciever_id'   => 'Receiver',
			'subject'       => 'Subject',
			'body'          => 'Body',
			'is_read'       => 'Is Read',
			'deleted_by'    => 'Deleted By',
			'date_create' => 'Created At',
			'module'        => 'Module',
		);
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($insert) {
				$this->date_create = Date('Y-m-d H:i:s');
				$this->sender_id = Yii::$app->user->identity->id;
				return true;
			}
		}else{
			return true;
		}
	}

	public function getSenderName() {
		if ($this->sender) {
		    return $this->sender->username;
		}
	}

	public function getReceiverName() {
		if ($this->receiver) {
		    return $this->reciever->username;
		}
	}

	public static function getAdapterForInbox($userId) {
		return static::find()->select('id, reciever_id, sender_id, subject, body, is_read, deleted_by, date_create, module')
							 ->where('(reciever_id = '.$userId.' or sender_id = '.$userId.') AND (deleted_by <> "'.self::DELETED_BY_RECEIVER.'" OR deleted_by IS NULL)')
							 ->orderBy('date_create DESC');
	}

	public static function getAdapterForSent($userId) {
		/*$c = new CDbCriteria();
		$c->addCondition('t.sender_id = :senderId');
		$c->addCondition('t.deleted_by <> :deleted_by_sender OR t.deleted_by IS NULL');
		$c->order = 't.date_create DESC';
		$c->params = array(
			'senderId' => $userId,
			'deleted_by_sender' => Messages::DELETED_BY_SENDER,
		);
		$messagesProvider = new CActiveDataProvider('Messages', array('criteria' => $c));
		$messagesProvider->pagination->pageSize=5;
		return $messagesProvider;*/
	}

	public function deleteByUser($userId) {

		/*if (!$userId) {
			return false;
		}

		if ($this->sender_id == $this->reciever_id && $this->reciever_id == $userId) {
			$this->delete();
			return true;
		}

		if ($this->sender_id == $userId) {
			if ($this->deleted_by == self::DELETED_BY_RECEIVER) {
				$this->delete();
			} else {
				$this->deleted_by = self::DELETED_BY_SENDER;
				$this->save();
			}

			return true;
		}

		if ($this->reciever_id == $userId) {
			if ($this->deleted_by == self::DELETED_BY_SENDER) {
				$this->delete();
			} else {
				$this->deleted_by = self::DELETED_BY_RECEIVER;
				$this->save();
			}

			return true;
		}

		// message was not deleted
		return false;*/
	}

	public function markAsRead() {
		if (!$this->is_read) {
			$this->is_read = true;
			$this->save();
		}
	}

	public static function getCountUnreaded($userId) {
		return static::find()->select('id')
							 ->where('(reciever_id = '.$userId.') AND (deleted_by <> "'.self::DELETED_BY_RECEIVER.'" OR deleted_by IS NULL) AND is_read = 0');
	}

	public static function sendWorkflowMessage($module,$text){
		$wfMsg = new Messages();
		$wfMsg->reciever_id = (int)Yii::$app->user->identity->parent_user_id;
		$wfMsg->sender_id = (int)Yii::$app->user->identity->id;
		$wfMsg->subject = 'WFMESSAGE';
		$wfMsg->is_read = (string)'0';
		$wfMsg->date_create = Date('Y-m-d H:i:s');
		$wfMsg->body = $text;
		$wfMsg->module = strtoupper($module);		
		if(!$wfMsg->save())
			var_dump($wfMsg);
	}

}
