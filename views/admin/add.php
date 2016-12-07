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
?><div class="panel panel-default">
    <div class="panel-heading"><strong>Add</strong> Karma</div>
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li><a
                    href="<?php echo $this->createUrl('index'); ?>"><?php echo Yii::t('AdminModule.views_user_index', 'Overview'); ?></a>
            </li>
            <li class="active">
                <a href="<?php echo $this->createUrl('add'); ?>">Add Karma Record</a>
            </li>
        </ul>
        <p />
        <?php echo $form; ?>

    </div>
</div>