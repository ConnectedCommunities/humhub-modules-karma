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

Yii::app()->moduleManager->register(array(
    'id' => 'karma',
    'class' => 'application.modules.karma.KarmaModule',
    'import' => array(
        'application.modules.karma.*',
        'application.modules.karma.models.*',
        'application.modules.karma.widgets.*',

        'application.modules_core.user.*', 
        'application.modules_core.user.controllers.*', 
        'application.modules_core.user.views.*', 
        'application.modules_core.user.behaviors.*',


    ),
    'events' => array(
        array('class' => 'AdminMenuWidget', 'event' => 'onInit', 'callback' => array('KarmaEvents', 'onAdminMenuInit')),
        array('class' => 'ProfileMenuWidget', 'event' => 'onInit', 'callback' => array('KarmaEvents', 'onProfileMenuWidgetInit')),
		// array('class' => 'WallEntryControlsWidget', 'event' => 'onInit', 'callback' => array('ReportContentModule', 'onWallEntryControlsInit')),
		// array('class' => 'HActiveRecordContent', 'event' => 'onBeforeDelete', 'callback' => array('ReportContentModule', 'onContentDelete')),
		// array('class' => 'SpaceAdminMenuWidget', 'event' => 'onInit', 'callback' => array('ReportContentModule', 'onSpaceAdminMenuInit')),
        // array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('KarmaEvents', 'onTopMenuInit')),
    ),
));
?>