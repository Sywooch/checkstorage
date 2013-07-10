<?php

class m130710_155900_opportunities extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_opportunities',array(
				'id'            => 'INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
				'user_id'		=> 'INTEGER UNSIGNED NOT NULL',
				'country'       => 'VARCHAR(255)',
				'address'       => 'VARCHAR(255)',
				'zipcode'       => 'VARCHAR(15)',
				'city'          => 'VARCHAR(255)',
				'double_sqm'	=> 'DOUBLE DEFAULT 1.00',
				'date_start'	=> 'DATE',
				'date_created'	=> 'DATE',
				'date_deleted'  => 'DATE DEFAULT NULL',
				'no_latitude'	=> 'FLOAT DEFAULT 0.00',
				'no_longitude'  => 'FLOAT DEFAULT 0.00',				
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');	

		//ADD FKS
		$this->addForeignKey('FK_opp_user','tbl_opportunities','user_id','tbl_user','id');
	}

	public function down()
	{		
		//DROP FKS
		$this->dropForeignKey('FK_opp_user','tbl_opportunities');

		$this->dropTable('tbl_opportunities');
	}
}
