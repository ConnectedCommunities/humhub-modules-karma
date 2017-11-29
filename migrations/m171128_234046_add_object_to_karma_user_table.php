<?php

use yii\db\Migration;

class m171128_234046_add_object_to_karma_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('karma_user', 'created_by', $this->integer(11));
        $this->addColumn('karma_user', 'object_model', 'varchar(255)');
        $this->addColumn('karma_user', 'object_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('karma_user', 'created_by');
        $this->dropColumn('karma_user', 'object_model');
        $this->dropColumn('karma_user', 'object_id');
    }

}
