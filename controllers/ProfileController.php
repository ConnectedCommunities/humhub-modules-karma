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

class ProfileController extends Controller {


    public $subLayout = "application.modules_core.user.views.profile._layout";
    public $user = null;


    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'users' => array('@', (HSetting::Get('allowGuestAccess', 'authentication_internal')) ? "?" : "@"),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    /**
     *
     */
    public function actionView()
    {
        // $model->findByAttributes(array('user_id' => $this->getUser()->id));
        $this->render('karma', array(
            'user' => $this->getUser(), 
            // 'modelx' => new KarmaUser('search'),
            'model' => new KarmaUser('search')
        ));
    }




    public function getUser()
    {

        if ($this->user != null) {
            return $this->user;
        }

        // Get User GUID by parameter
        $guid = Yii::app()->request->getQuery('uguid');
        if ($guid == "") {
            // Workaround for older version
            $guid = Yii::app()->request->getQuery('guid');
        }

        $this->user = User::model()->findByAttributes(array('guid' => $guid));

        if ($this->user == null)
            throw new CHttpException(404, Yii::t('UserModule.behaviors_ProfileControllerBehavior', 'User not found!'));


        return $this->user;
    }

	
}
