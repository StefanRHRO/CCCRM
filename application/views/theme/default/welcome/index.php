<?php
/**
 *
 * Copyright (c) 2010, SRIT Stefan Riedel <info@srit-stefanriedel.de>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 * - Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 * - Neither the name of the author nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
 * OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
 * EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * PHP version 5
 *
 * $Id$
 * $LastChangedBy$
 *
 * @author    Stefan Riedel <info@srit-stefanriedel.de>
 * @copyright 2010 SRIT Stefan Riedel
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
?>

<!--<a class="dashboard_button button1" href="#">
    <span class="dashboard_button_heading">Dashboard</span>
    <span>Edit various basic settings and Options</span>
</a><!--end dashboard_button-->

<!--<a class="dashboard_button button2" href="#">
    <span class="dashboard_button_heading">Settings</span>
    <span>Edit various advanced settings and Options</span>
</a><!--end dashboard_button-->

<!--<a class="dashboard_button button3" href="#">
    <span class="dashboard_button_heading">Applications</span>
    <span>Add and edit applications</span>
</a><!--end dashboard_button-->

<!--<a class="dashboard_button button4" href="#">
    <span class="dashboard_button_heading">Script editor</span>
    <span>Enter your javascript and php scripts</span>
</a><!--end dashboard_button-->
<?=HTML2::anchor(Route::get('default')->uri(array('controller' => 'search')), '<span class="dashboard_button_heading">'.I18n::get('Suche').'</span>
    <span>'.I18n::get('erweiterte Suche nach Nutzern').'</span>', array('class'=>'dashboard_button button5'))?>

<!--<a class="dashboard_button button6" href="#">
    <span class="dashboard_button_heading">Trash</span>
    <span>Deleted items and database entries</span>
</a><!--end dashboard_button-->

<!--<a class="dashboard_button button7" href="#">
    <span class="dashboard_button_heading two_lines">Content Manager</span>
    <span>Add new static and dynamic content</span>
</a><!--end dashboard_button-->

<?=HTML2::anchor(Route::get('default')->uri(array('controller' => 'campaigns', 'action' => 'list')), '<span class="dashboard_button_heading">'.I18n::get('Kampagnen').'</span>
    <span>'.I18n::get('Kampagnenmanagement Tool.').'</span>', array('class'=>'dashboard_button button3'))?>

<?=HTML2::anchor(Route::get('default')->uri(array('controller' => 'files', 'action' => 'list')), '<span class="dashboard_button_heading">'.I18n::get('Dateimanager').'</span>
    <span>'.I18n::get('Dateiverwaltungs Tool.').'</span>', array('class'=>'dashboard_button button13'))?>

<!--<a class="dashboard_button button9" href="#">
    <span class="dashboard_button_heading two_lines">Newsletter Manager</span>
    <span>Add and manage newsletter subscriptions</span>
</a><!--end dashboard_button-->

<?=HTML2::anchor(Route::get('default')->uri(array('controller' => 'user')), '<span class="dashboard_button_heading">'.I18n::get('Nutzermanager').'</span>
    <span>'.I18n::get('Nutzer hinzufügen oder bearbeiten').'</span>', array('class'=>'dashboard_button button10'))?>
    
<?=HTML2::anchor(Route::get('default')->uri(array('controller' => 'settings')), '<span class="dashboard_button_heading">'.I18n::get('Einstellungen').'</span>
    <span>'.I18n::get('erweiterte Einstellungen').'</span>', array('class'=>'dashboard_button button2'))?>
<!--<a class="dashboard_button button11" href="#">
    <span class="dashboard_button_heading">Gallery</span>
    <span>Manage your image gallery</span>
</a><!--end dashboard_button-->

<!--<a class="dashboard_button button12" href="#">
    <span class="dashboard_button_heading">Help</span>
    <span>Tutorial on how to use out scripts</span>
</a><!--end dashboard_button-->
