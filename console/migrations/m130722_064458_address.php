<?php

class m130722_064458_address extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_address',array(
			'id'            	=> 'INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'user_id'			=> 'INTEGER UNSIGNED NOT NULL',			
			'date_created'		=> 'DATE',
			'date_deleted'		=> 'DATE DEFAULT NULL',
			'note'				=> 'TEXT',			
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');	

		//ADD FKS
		$this->addForeignKey('FK_address_user','tbl_address','user_id','tbl_user','id');
	}

	public function down()
	{
		//drop FKs
		$this->dropForeignKey('FK_address_user','tbl_address');
		
		$this->dropTable('tbl_address');
	}
}
