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

class KarmaEvents{
    
    public static function onTopMenuInit($event){
        $event->sender->addItem(array(
            'label' => 'Karma',
            'url' => Yii::app()->createUrl('/karma/main/index', array()),
            'icon' => '<i class="fa fa-trophy"></i>',
            'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'karma'),
        ));
    }

    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param type $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('KarmaModule.base', 'Karma'),
            'url' => Yii::app()->createUrl('//karma/admin'),
            'group' => 'manage',
            'icon' => '<i class="fa fa-trophy"></i>',
            'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'karma' && Yii::app()->controller->id == 'admin'),
            'sortOrder' => 510,
        ));
    }


    /** 
     * Add the Karma menu to the user
     * profile page
     * @param type $event
     */
    public static function onProfileMenuWidgetInit($event) 
    {
         $event->sender->addItem(array(
            'label' => Yii::t('KarmaModule.base', 'Karma'),
            'group' => 'profile',
            'url' => $event->sender->user->createUrl('//karma/profile/view'),
            'sortOrder' => 400,
            'isActive' => (Yii::app()->controller->module->id == "karma" && Yii::app()->controller->id == "profile" && Yii::app()->controller->action->id == "view"),
        ));
    }

}