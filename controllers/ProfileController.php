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

use humhub\modules\karma\models\KarmaUserSearch;
use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use humhub\modules\karma\models\Karma;
use humhub\modules\karma\models\KarmaSearch;
use humhub\modules\karma\models\KarmaUser;
use humhub\compat\HForm;
use humhub\modules\content\components\ContentContainerController;


class ProfileController extends \humhub\modules\content\components\ContentContainerController
{

    /**
     *
     */
    public function actionView()
    {
        $searchModel = new KarmaUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        // $model->findByAttributes(array('user_id' => $this->getUser()->id));
        return $this->render('karma', array(
            'user' => $this->getUser(),
            'dataProvider' => $dataProvider,
        ));
    }

	
}
