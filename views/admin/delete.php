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
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('AdminModule.views_karma_delete', 'Delete karma: <strong>{name}</strong>', array('{name}' => $model->name)); ?></div>
    <div class="panel-body">


        <p>
            <?php echo Yii::t('AdminModule.views_user_delete', 'Are you sure you want to delete this Karma record? Deleting Karma records can cause some unexpected side effects.'); ?>
        </p>

        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'name',
                'points',
                'description',
            ),
        ));
        ?>

        <br/>
        <?php echo HHtml::postLink(Yii::t('AdminModule.views_karma_delete', 'Delete karma'), $this->createUrl('//karma/admin/delete', array('id' => $model->id, 'doit' => 2)), array('class' => 'btn btn-danger')); ?>
        &nbsp;
        <?php echo CHtml::link(Yii::t('AdminModule.views_user_delete', 'Back'), $this->createUrl('//karma/admin/edit', array('id' => $model->id)), array('class' => 'btn btn-primary')); ?>


    </div>
</div>