<?php

class m130710_190837_unittable extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_unit',array(
			'id'            	=> 'INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'storage_id'		=> 'INTEGER UNSIGNED NOT NULL',
			'date_created'		=> 'DATE',
			'room_height'		=> 'FLOAT DEFAULT 0.00',
			'room_length'		=> 'FLOAT DEFAULT 0.00',
			'room_width'		=> 'FLOAT DEFAULT 0.00',
			'unit_type'    		=> 'TINYINT(2) DEFAULT 1',
			'unit_number'		=> 'VARCHAR(15) DEFAULT NULL',
			'current_status' 	=> 'VARCHAR(1) DEFAULT "v"',
			'is_consumer'		=> 'TINYINT(1) DEFAULT 0',
			'rate_period'		=> 'TINYINT(1) DEFAULT 1', // 1=week, 2=4weeks, 3=monthly, 0=daily
			'unit_rate'			=> 'FLOAT DEFAULT 0.00',
			'size_code'			=> 'DOUBLE DEFAULT 1.00',
			'note'				=> 'TEXT',
			'accesskey'			=> 'VARCHAR(100)',
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');	

		//ADD FKS
		$this->addForeignKey('FK_unit_storage','tbl_unit','storage_id','tbl_storage','id');
	}

	public function down()
	{
		//DROP FKS
		$this->dropForeignKey('FK_unit_storage','tbl_unit');

		$this->dropTable('tbl_unit');
	}
}
