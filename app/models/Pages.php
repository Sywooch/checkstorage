<?php
namespace app\models;

use \yii\db\ActiveRecord;
use \yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use \Yii;

use app\models\Workflow;
use app\models\Comment;

class Pages extends ActiveRecord
{
	/**
     * @return string the associated database table name
     */
	public static function tableName()
    {
        return '{{%pages}}';
    }

	private $_oldTags;

	/**
	* the content of the preupdated body
	* @var string the complete body content
	*/
	private $_oldBody;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, name, body, status', 'required'),
			array('status', 'in', 'range'=>array(Workflow::STATUS_DRAFT,Workflow::STATUS_PUBLISHED,Workflow::STATUS_ARCHIVED)),
			array('title, name', 'string', 'max'=>128),
			array('parent_pages_id','integer'),
			array('body, description','string'),
			array('date_associated','date'),
			array('ord','integer'),
			array('time_create, time_update, template','string'),
			array('special','integer'),
			array('category','integer'),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
		);
	}

	/**
	* returns the number of child nodes
	*/
	public function getNoChildren(){
		return static::find()->where('parent_pages_id = '.$this->id.' AND (special IS NULL OR special <> "-1")')->count();
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
		$returnme[] = ArrayHelper::map(Pages::findBySQL('SELECT id, name FROM tbl_pages ORDER BY name')->all(),'id','name');
		return $returnme;
	}


	/**
	* shows the comments for the current page
	* @return array related comments for this page
	*/

	public function getComments() {		
		return $this->hasMany('Comment', array('comment_id' => 'id'))
		            ->where('status = "'. Workflow::STATUS_APPROVED.'" AND comment_table = '.Workflow::MODULE_CMS)
					->orderBy('time_create DESC');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'              => 'Id',
			'title'           => Yii::t('app','Title'),
			'name'            => Yii::t('app','Name'),
			'body'            => Yii::t('app','Body'),
			'parent_pages_id' => Yii::t('app','parent'),
			'ord'             => Yii::t('app','sort order'),
			'time_create'     => Yii::t('app','created'),
			'time_update'     => Yii::t('app','updated'),
			'special'         => Yii::t('app','Special'),
			'title'           => Yii::t('app','Title'),
			'template'        => Yii::t('app','Design'),
			'category'        => Yii::t('app','Type'),
			'tags'            => Yii::t('app','Tags'),
			'description'     => Yii::t('app','Description'),
			'date_associated' => Yii::t('app','Association Date'),
			'vars'            => Yii::t('app','Vars'),
			'status'          => Yii::t('app','Status'),
			);
	}

	/**
	 * @return string the URL that shows the detail of the pages
	 */
	public function getUrl()
	{
		return Yii::$app->controller->createUrl('pages/view', array(
			'id'=>$this->id,
			'title'=>$this->title,
		));
	}

	/**
	 * @return string the URL that shows the update of the pages
	 */
	public function getUrlUpdate()
	{
		return Yii::$app->controller->createUrl('pages/update', array(
			'id'=>$this->id
		));
	}

	/**
	 * @return string the URL that shows the update of the pages
	 */
	public function getUrlDiff()
	{
		return Yii::$app->controller->createUrl('pages/diffview', array(
			'id'=>$this->id
		));
	}

	/**
	 * @return array a list of links that point to the pages list filtered by every tag of this pages
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=Html::a(Html::encode($tag), array('pages/index', 'tag'=>$tag), array('class'=>'label'));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	/**
	 * Adds a new comment to this pages.
	 * This method will set status and pages_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
		if(Yii::$app->params['commentNeedApproval'])
			$comment->status=Workflow::STATUS_DRAFT;
		else
			$comment->status=Workflow::STATUS_APPROVED;
		$comment->comment_table=Workflow::MODULE_CMS;
		$comment->comment_id=$this->id;
		return $comment->save();
	}

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	public function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
		$this->_oldBody=$this->body;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($insert) {
				$this->time_create=$this->time_update=time();
			}
			else {
				$this->time_update=time();
				//here we check if the body has changed
				if($this->body != $this->_oldBody){
					$OldPage = new Pages; //looks strange, but the old page needs to be backuped into a new one;)
					$OldPage->body = $this->_oldBody;
					$OldPage->title = $this->title;
					$OldPage->name = $this->name;
					$OldPage->tags = $this->_oldTags;
					$OldPage->parent_pages_id = $this->id;
					$OldPage->special = -1; //means its a none normal page
					$OldPage->status = Workflow::STATUS_ARCHIVED;
					$OldPage->save();
				}
			}
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This is invoked after the record is saved.
	 */
	public function afterSave($insert)
	{
		parent::afterSave($insert);
		Tag::updateFrequency($this->_oldTags, $this->tags);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	public function afterDelete()
	{
		if (parent::beforeDelete()) {
			Comment::deleteAll('comment_id='.$this->id.' AND comment_table="'.$this->tableName().'"');
			Tag::updateFrequency($this->tags, '');
		} else {
			return false;
		}
	}

	/**
	* returns the parent nodes for the menu
	*/

	public static function getRootNodes()
	{
		return self::find()->where('parent_pages_id = 0')->all();
	}

	/**
     * Forms an associative, multidimensional array holding only the first
     * level of nodes. Used when lazy loading is enabled and only the first
     * nodes should be shown.
     * 
     * @param int dataview_id The id of the dataview to show this tree for
     * @param User $user The user model to filter this tree for (Defaults to false, meaning no user filter)
     *
     * @return array The parent child data as associative, multidimensional array
     */
    public static function rootTreeAsArray($id)
    {
    	$checkRootNode = Pages::find($id);
    	if(is_null($checkRootNode->parent_pages_id) OR $checkRootNode->parent_pages_id == 0)
    		$rootNode = $checkRootNode->id;
    	else
    		$rootNode = $checkRootNode->parent_pages_id;

    	$roots = array();
    	$roots = Pages::find()->where(array('id' => $rootNode))->All();
		$out = array();
        foreach($roots as $root)
        {        	
        	$currow = array('id'=>$root->id,'child' => $root->noChildren,'text'=>$root->name);
        	$out[]=$currow;
        }
        return $trees = array('id' => 0,'item' => $out);
    }

    /**
     * Returns the children of a given node as associative array
     *
     * @param int $id The id of the parent node
     * @return array an associative array holding the children of the given node
     */
    public static function nodeChildren($id,$lazyLoad = false)
    {
        $curnode = static::find($id);
        if($curnode)
        {
            $children = static::find()->where('parent_pages_id = '.$id.' AND (special IS NULL OR special <> "-1")')->All();
            if(sizeOf($children)>0)
            {
                $out = array();
            	foreach($children as $child)
                {
                	if($child->noChildren>0)
                	{
                		$currow=array('id'=>$child->id,'text'=>$child->name,'child'=>1);
                	}
                	else
                	{
                		$currow=array('id'=>$child->id,'text'=>$child->name);
                	}
                	$out[] = $currow;
                }
                return array('id' => $id,'item' => $out);
            }
            else
            {
            	return array();
            }
        }
        return array();
    }

    /**
    * search body by string
    * @param string searchText to be looked up
    */
    public static function searchByString($query){
		return static::find()->where("UPPER(body) LIKE '%".strtoupper($query)."%' AND (special IS NULL OR special <> '-1')");
	}

	/**
	* historical versions
	* return all old versions
	*/
	public static function findOldVersions($id)
	{
		return static::find()->where('parent_pages_id = '.$id.' AND special = "-1"')
					->orderBy('time_create DESC'); 
	}

}
