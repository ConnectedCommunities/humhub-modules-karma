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
<div class="content" style="max-height: 40px; max-width:250px;">
            
    <p id="content-message-<?php echo $reportedContent->id?>" style="display: inline;" class="contentAnchor"><?php print HHtml::enrichText($reportedContent->getSource()->message) ?></p>
    <br/>    
    <small class="media">
        <span class="time"><?php echo Yii::t('ReporterContent.base', 'created by :displayName', array(':displayName' => CHtml::encode($reportedContent->getSource()->content->user->displayName)))?></span>
        <?php echo HHtml::timeago($reportedContent->getSource()->created_at); ?>
    </small>     
</div>

<script type="text/javascript">

$(document).ready(shortenContentMessages);

function shortenContentMessages(id, data){
    $('.contentAnchor').each(function(){
        var divh=$(this).parent().height();
        var divw=$(this).parent().width();
        
        while ($(this).outerHeight()>divh || $(this).outerWidth()>divw) {
        	$(this).text(function (index, text) {
                return text.replace(/\W*\s(\S)*$/, '...');
            });
        }
    });

    $('.time').each(function(){
        $(this).timeago();
    });
}
</script>