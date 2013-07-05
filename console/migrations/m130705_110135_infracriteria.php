<?php

class m130705_110135_infracriteria extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_comparision_factor',array(
				'id'            => 'INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
				'storage_id'	=> 'INTEGER UNSIGNED NOT NULL',
				'date_opening'		=> 'DATE',
				'no_elevators'		=> 'INTEGER(3) DEFAULT 1',
				'room_height'		=> 'FLOAT DEFAULT 0.00',
				'fireprotection'    => 'TINYINT(1) DEFAULT 1',
				'externalunits' 	=> 'TINYINT(1) DEFAULT 0',
				'security_camera'   => 'TINYINT(1) DEFAULT 1',
				'security_access'   => 'TINYINT(1) DEFAULT 1',
				'security_service'  => 'TINYINT(1) DEFAULT 0',
				'trolleys'   		=> 'TINYINT(1) DEFAULT 1',
				'aircondition'   	=> 'TINYINT(1) DEFAULT 0',
				'aircondition_office'   	=> 'TINYINT(1) DEFAULT 0',
				'max_degrees'   	=> 'VARCHAR(100)',
				'min_degrees'   	=> 'VARCHAR(100)',
				'shopping'   		=> 'TINYINT(1) DEFAULT 0',
				'shopping_pricelevel'  => 'TINYINT(1) DEFAULT 3',				
				'music'   			=> 'TINYINT(1) DEFAULT 0',
				'opening_start'		=> 'TIME',
				'opening_end'		=> 'TIME',
				'opening_days'		=> 'VARCHAR(15)',
				'opening_office_start'		=> 'TIME',
				'opening_office_end'		=> 'TIME',
				'opening_office_days'		=> 'VARCHAR(15)',
				'no_parking'		=> 'INTEGER(3) DEFAULT 1',
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');	

		//ADD FKS
		$this->addForeignKey('FK_comparision_storage','tbl_comparision_factor','storage_id','tbl_storage','id');
	}

	public function down()
	{
		//DROP FKS
		$this->dropForeignKey('FK_comparision_storage','tbl_comparision_factor');

		$this->dropTable('tbl_comparision_factor');
	}
}
