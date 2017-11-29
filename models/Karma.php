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
     * Method that handles assigning karma to a user
     * @param string $karma_name
     * @param int $user_id
     * @param object $object
     * @param bool $force
     * @return bool
     */
    public function addKarma($karma_name, $user_id, $object = null, $force = false) {

        // First find the karma record
		$karma = Karma::findOne(['name' => $karma_name]);

        // Cancel if we can't find the karma record
        if(!$karma) {
            return;
        }

        // Prevent users getting karma for themselves unless $force is true
        if($force == false && Yii::$app->user->id == $user_id) {
            return;
        }

        // Prevent repeated karma granting
        $alreadyGranted = KarmaUser::findOne([
            'user_id' => $user_id,
            'karma_id' => $karma->id,
            'created_by' => Yii::$app->user->id,
            'object_model' => (!is_null($object) && is_object($object)) ? get_class($object) : null,
            'object_id' => (!is_null($object) && is_object($object)) ? $object->id : null,
        ]);

        // Cancel if it's already been granted
        if($alreadyGranted) {
            return;
        }

        // Attach Karma to user if record exists
        return KarmaUser::attachKarma($user_id, $karma->id, $object);

    }

    public static function leaderboard() {

        $sql = "SELECT u.username, SUM(k.points) as points
                FROM karma_user ku, karma k, user u
                WHERE ku.karma_id = k.id 
                AND ku.user_id = u.id
                GROUP BY ku.user_id
				ORDER BY points DESC";

        return Yii::$app->db->createCommand($sql)->queryAll();

    }


}
