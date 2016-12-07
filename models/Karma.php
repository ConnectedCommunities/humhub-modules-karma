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

namespace humhub\modules\karma\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\components\ActiveRecord;


/**
 * This is the model class for table "karma".
 *
 * The followings are the available columns in table 'karma':
 * @property integer $id
 * @property string $name
 * @property integer $points
 * @property string $description
 */
class Karma extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'karma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(['name', 'points'], 'required'),
			array(['points'], 'integer'),
			array(['name'], 'string', 'max' => 100),
			array('description', 'safe'),
			array(['description'], 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'points' => 'Points',
			'description' => 'Description',
		);
	}

    /** 
     * Private method that handles assinging
     * karma to a user
     * @param string $karma_name
     * @param int $user_id
     * @return bool
     */
    public function addKarma($karma_name, $user_id) {

        // First find the karma record
		$karma = Karma::findOne(['name' => $karma_name]);

		if($karma) {
	        KarmaUser::attachKarma($user_id, $karma->id);
	        return true;
        } else {
            return false;
        }
    }


}
