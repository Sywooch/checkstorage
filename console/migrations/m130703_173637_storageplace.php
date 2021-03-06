<?php

class m130703_173637_storageplace extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_storage',array(
				'id'            => 'INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
				'user_id'		=> 'INTEGER UNSIGNED NOT NULL',
				'responsible_id'	=> 'INTEGER UNSIGNED DEFAULT NULL',
				'name'          => 'VARCHAR(255)',
				'country'       => 'VARCHAR(255)',
				'address'       => 'VARCHAR(255)',
				'zipcode'       => 'VARCHAR(15)',
				'city'          => 'VARCHAR(255)',
				'phone'			=> 'VARCHAR(60)',
				'mail'			=> 'VARCHAR(200)',
				'fax'			=> 'VARCHAR(60)',
				'no_latitude'	=> 'FLOAT DEFAULT 0.00',
				'no_longitude'  => 'FLOAT DEFAULT 0.00',				
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');	

		//ADD FKS
		$this->addForeignKey('FK_storage_user','tbl_storage','user_id','tbl_user','id');
		$this->addForeignKey('FK_storage_responsible_user','tbl_storage','responsible_id','tbl_user','id');
	}

	public function down()
	{
		//DROP FKS
		$this->dropForeignKey('FK_storage_user','tbl_storage');
		$this->dropForeignKey('FK_storage_responsible_user','tbl_storage');

		$this->dropTable('tbl_storage');
	}

}
