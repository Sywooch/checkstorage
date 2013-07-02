<?php

class m130510_163333_messaging extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_messages',array(
				'id'                        => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
				'sender_id'                 => 'INTEGER UNSIGNED DEFAULT 0',
				'reciever_id'               => 'INTEGER DEFAULT 0',
				'subject'					=> 'VARCHAR(255) NOT NULL DEFAULT ""',
				'body'						=> 'TEXT',
				'is_read'					=> 'TINYINT(1) NOT NULL DEFAULT 0',
				'deleted_by'				=> 'ENUM("sender","reciever") DEFAULT NULL',			
				'date_create'             	=> 'DATETIME NOT NULL',				
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');
	}

	public function down()
	{
		$this->dropTable('tbl_messages');
	}
}
