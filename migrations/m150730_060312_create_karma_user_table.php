<?php

/**
 * Connected Communities Initiative
 * Copyright (C) 2016 Queensland University of Technology
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class m150730_060312_create_karma_user_table extends EDbMigration
{
	public function up()
	{
        $this->createTable('karma_user', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'karma_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime DEFAULT NULL',
            'updated_at' => 'datetime DEFAULT NULL',
        ), '');
	}

	public function down()
	{
        $this->dropTable('karma_user');
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