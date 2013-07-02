<?php

class m130517_162510_site_to_user_fk extends \yii\db\Migration
{
	public function up()
	{
		/**
		* Add all needed fields to tbl_user in one_site belongs to many users
		**/
		$this->addForeignKey('FK_location_user','tbl_user','location_id','tbl_location','id');
	}

	public function down()
	{
		$this->dropForeignKey('FK_location_user','tbl_user');
	}
}
