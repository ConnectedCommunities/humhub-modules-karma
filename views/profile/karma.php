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

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\data\ActiveDataProvider;
?>
<div class="panel panel-default">
    <div
        class="panel-heading"><?php echo Yii::t('UserModule.views_profile_about', '<strong>Karma</strong> for this user'); ?></div>

    <div class="panel-body">

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'karma.points',
                'karma.name',
                'karma.description',
                'created_at:datetime',
            ],
        ]);


        // 'modelx' => KarmaUser::model()->
        /*$this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'user-grid',
            'dataProvider' => $model->user($user->id)->search(), 
            'itemsCssClass' => 'table table-hover',
            // 'loadingCssClass' => 'loader',
            'columns' => array(
                array(
                    'name' => 'karma.points',
                    'header' => 'Points',
                ),
                array(
                    'name' => 'karma.name',
                    'header' => 'Karma',
                ),
                array(
                    'name' => 'karma.description',
                    'header' => 'Description',
                ),
                array(
                    'name' => 'created_at',
                    'value' => 'date("M j, Y", strtotime($data->created_at))',
                    'header' => '',
                ),
            ),
            'pager' => array(
                'class' => 'CLinkPager',
                'maxButtonCount' => 5,
                'nextPageLabel' => '<i class="fa fa-step-forward"></i>',
                'prevPageLabel' => '<i class="fa fa-step-backward"></i>',
                'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
                'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination'),
            ),
            'pagerCssClass' => 'pagination-container',
        ));*/
        ?>


    </div>


</div>
