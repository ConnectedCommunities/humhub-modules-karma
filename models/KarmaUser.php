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

/**
 * This is the model class for table "karma_user".
 *
 * The followings are the available columns in table 'karma_user':
 * @property integer $id
 * @property integer $user_id
 * @property integer $karma_id
 * @property string $created_at
 * @property string $updated_at
 */
class KarmaUser extends HActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'karma_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, karma_id', 'required'),
			array('user_id, karma_id', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, karma_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
            'user' => array(static::BELONGS_TO, 'User', 'user_id'),
            'karma' => array(static::BELONGS_TO, 'Karma', 'karma_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'karma_id' => 'Karma',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('karma_id',$this->karma_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/** 
	 * Filters results by the question_id
	 * @param $question_id
	 */
	public function user($user_id)
	{
	    $this->getDbCriteria()->mergeWith(array(
	        'condition'=>"user_id=:user_id", 
	        'params' => array(':user_id' => $user_id)
	    ));

	    return $this;
	}

	/**
	 * Calculate the user's karma score
	 */
	public function score($user_id) {

		// Calculate the "score" (up votes minus down votes)
		$sql = "SELECT sum(points) as score FROM karma_user ku, karma k
					WHERE k.id = ku.karma_id
					AND user_id = :user_id";
					
		return Yii::app()->db->createCommand($sql)->bindValue('user_id', $user_id)->queryScalar();

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KarmaUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/** 
	 * Attaches karam to a user
	 * @param int $user_id
	 * @param int $karma_id
	 */
	public function attachKarma($user_id, $karma_id) 
	{
		$karma = new KarmaUser;
		$karma->user_id = $user_id;
		$karma->karma_id = $karma_id;

		if($karma->validate()) {
			$karma->save();
			return true;
		} else {
			return false;
		}

	} 
}
