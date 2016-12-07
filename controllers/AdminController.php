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

namespace humhub\modules\karma\controllers;

use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use humhub\modules\karma\models\Karma;
use humhub\modules\karma\models\KarmaSearch;
use humhub\compat\HForm;


class AdminController extends \humhub\modules\admin\components\Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => \humhub\components\behaviors\AccessControl::className(),
                'adminOnly' => true
            ]
        ];
    }

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex() 
    {

        $searchModel = new KarmaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', array(
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => Karma::find()
        ));
        
    }
     


    /** 
     * Add a karma record
     */
    public function actionAdd()
    {

        // Build Form Definition
        $definition = array();
        $definition['elements'] = array();

        // Define Form Elements
        $definition['elements']['Karma'] = array(
            'type' => 'form',
            'title' => 'Karma',
            'elements' => array(
                'name' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 25,
                ),
                'points' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 10,
                ),
                'description' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 1000
                ),
            ),
        );

        // Get Form Definition
        $definition['buttons'] = array(
            'save' => array(
                'type' => 'submit',
                'class' => 'btn btn-primary',
                'label' => 'Create'
            ),
        );

        $form = new HForm($definition);
        $form->models['Karma'] = new Karma();

        // Save new karma
        if($form->submitted('save') && $form->validate()) {
            $form->models['Karma']->save();
            return $this->redirect(Url::to(['index']));
        }

        return $this->render('add', array('hForm' => $form));
    }


    /** 
     * Edit a karma record
     */
    public function actionEdit()
    {
        $id = (int) Yii::$app->request->get('id');
        $user = User::findOne(['id' => $id]);
        $karma = Karma::findOne(['id' => $id]);

        if ($karma == null)
            throw new \yii\web\HttpException(404, "Karma record not found!");


        // Build Form Definition
        $definition = array();
        $definition['elements'] = array();

        // Define Form Eleements
        $definition['elements']['Karma'] = array(
            'type' => 'form',
            'title' => 'Karma',
            'elements' => array(
                'name' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 25,
                ),
                'points' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 10,
                ),
                'description' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 1000
                ),
            ),
        );


        // Get Form Definition
        $definition['buttons'] = array(
            'save' => array(
                'type' => 'submit',
                'label' => 'Save',
                'class' => 'btn btn-primary',
            ),
            'delete' => array(
                'type' => 'submit',
                'label' => 'Delete',
                'class' => 'btn btn-danger',
            ),
        );

        $form = new HForm($definition);
        $form->models['Karma'] = $karma;

        if ($form->submitted('save') && $form->validate()) {
            if ($form->save()) {
                return $this->redirect(Url::toRoute(['edit', 'id' => $karma->id]));
            }
        }


        if ($form->submitted('delete')) {
            return $this->redirect(Url::toRoute(['delete', 'id' => $karma->id]));
        }

        return $this->render('edit', array('hForm' => $form));

    }


    /**
     * Deletes a karma record
     */
    public function actionDelete()
    {

        $id = (int) Yii::$app->request->get('id');
        $doit = (int) Yii::$app->request->get('doit');

        $karma = Karma::findOne(['id' => $id]);

        if ($karma == null)
            throw new \yii\web\HttpException(404, "Karma record not found!");

        if ($doit == 2) {
            $this->forcePostRequest();
            $karma->delete();
            return $this->redirect(Url::toRoute('index'));

        }

        return $this->render('delete', array('model' => $karma));
    }
}