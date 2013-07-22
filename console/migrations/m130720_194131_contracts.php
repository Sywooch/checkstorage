<?php

class m130720_194131_contracts extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_contract',array(
			'id'            	=> 'INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'unit_id'			=> 'INTEGER UNSIGNED NOT NULL',
			'user_id'			=> 'INTEGER UNSIGNED NOT NULL',			
			'date_created'		=> 'DATE',
			'date_start'		=> 'DATE',
			'date_end'			=> 'DATE DEFAULT NULL',
			'date_deleted'		=> 'DATE DEFAULT NULL',
			'is_consumer'		=> 'TINYINT(1) DEFAULT 0',		
			'note'				=> 'TEXT',			
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');	

		//ADD FKS
		$this->addForeignKey('FK_contract_unit','tbl_contract','unit_id','tbl_unit','id');
		$this->addForeignKey('FK_contract_user','tbl_contract','user_id','tbl_user','id');
	}

	public function down()
	{
		//DROP FKS
		$this->dropForeignKey('FK_contract_unit','tbl_contract');
		$this->dropForeignKey('FK_contract_user','tbl_contract');

		$this->dropTable('tbl_contract');
	}
}
