<?php
namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\helpers\Html;

use app\models\Workflow;

class Comment extends ActiveRecord
{
	/**
     * @return string the associated database table name
     */
	public static function tableName()
    {
        return '{{%comment}}';
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, comment_table, comment_id', 'required'),
			array('comment_table,comment_id,author_id','integer'),
		);
	}

	//the author

	public function getAuthor() {
		return $this->hasOne('User', array('id' => 'author_id'));
	}

	//for each module we allow comments, we need to add a dynamic reference

	public function getPost() {
		return $this->hasOne('Post', array('id' => 'comment_id'));
			//->where('t1.comment_table = '.Workflow::MODULE_BLOG); //,'comment_table'=>'tbl_post'
	}

	public function getPage() {
		return $this->hasOne('Pages', array('id' => 'comment_id'));
			//->where('t1.comment_table = '.Workflow::MODULE_CMS); //,'comment_table'=>'tbl_post'
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'content' => Yii::t('app','Comment'),
			'status' => Yii::t('app','Status'),
			'time_create' => Yii::t('app','Create Time'),
			'author_id' => Yii::t('app','Name'),
			'comment_id' => Yii::t('app','Reference ID'),
			'comment_table' => Yii::t('app','Module'),
		);
	}

	/**
	 * Approves a comment.
	 */
	public function approve()
	{
		$this->status=Workflow::STATUS_APPROVED;
		$this->update(array('status'));
	}

	/**
	 * @param Post the post that this comment belongs to. If null, the method
	 * will query for the post.
	 * @return string the permalink URL for this comment
	 */
	public function getUrl($post=null)
	{
		if($post===null)
			$post=$this->post;
		return $post->url.'#c'.$this->id;
	}

	/**
	 * @return string the hyperlink display for the current comment's author
	 */
	public function getAuthorLink()
	{
		/*if(!empty($this->url))
			return Html::a(Html::encode($this->author),$this->url);
		else*/
		return Html::encode($this->Author->username);
	}

	/**
	 * @return integer the number of comments that are pending approval
	 */
	public static function getPendingCommentCount()
	{
		return static::find()->where('status='.Workflow::STATUS_PENDING)->count();
	}

	/**
	 * @param integer the maximum number of comments that should be returned
	 * @return array the most recently added comments
	 */
	public static function findRecentComments($limit=10)
	{
		return static::find()->where('status='.Workflow::STATUS_APPROVED)
					->orderBy('time_create DESC')
					->limit($limit)
					->with('post')->all();
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($insert) {
				$this->author_id = Yii::$app->user->identity->id;
				$this->time_create=time();
			}
			return true;
		} else {
			return false;
		}
	}

}
