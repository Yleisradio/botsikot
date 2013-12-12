<?php

class m131212_063723_create_headings extends CDbMigration
{

    public function up()
    {
        $this->createTable('heading', array(
            'id' => 'pk',
            'heading' => 'varchar(128) NOT NULL',
            'tweeted' => "int(11) NOT NULL DEFAULT '0'",
            'score' => "int(11) NOT NULL DEFAULT '0'",
            'generated' => 'int(11) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('heading');
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}