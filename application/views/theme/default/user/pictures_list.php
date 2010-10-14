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

/*+
 * ids der schon gerenderten User
 */
$users = array();
echo $page_links;
?>
<?= Form::open(NULL, array('method' => 'get')) ?>
<h2>Filter</h2>
<?= __('nur ungeprüfte Bilder') ?> <?= Form::select('status_bild', array(0 => 'nein', 1 => 'ja'), $status_bild) ?> | <?= __('Nutzername') ?> <?= Form::input('user', $user) ?>
<?= Form::submit('sub', 'Filtern') ?>
<?= Form::close() ?>
<table class="table_auto" cellspacing="0">
        <caption><?= I18n::get('Nutzer Bilder') ?></caption>
        <tr>
            <th class="nobg"><?= __('Nutzerdaten') ?></th>
            <th class="nobg"><?= __('Bilder') ?></th>
        </tr>
        <?php foreach($results as $k => $res) {
            $x = $k%2;
            if(!in_array($res->user, $users)) {
                if($k>0) { //die geöffnete Zeile wieder schließen?>
</td>
</tr>
                <?php }
                $users[] = $res->user;
            ?>
        <tr>
            <td valign="top">
                <table cellspacing="0" style="float:left;">
                    <tr>
                        <td colspan="2"><?= Helper_User::textLinkToUserWithInfo($res->u)?></td>
                    </tr>
                    <tr>
                        <td><?= __('Login')?>:</td>
                        <td><?= date('d.m.Y H:i', strtotime($res->u->lastlogin))?></td>
                    </tr>
                    <tr>
                        <td><?= __('Angemeldet')?>:</td>
                        <td><?= date('d.m.Y H:i', strtotime($res->u->accountcreated))?></td>
                    </tr>
                    <tr>
                        <td><?= __('Änderungen')?>:</td>
                        <td><?= date('d.m.Y H:i', strtotime($res->u->lastchanged))?></td>
                    </tr>
                    <tr>
                        <td><?= __('Anmelde IP')?>:</td>
                        <td><?= $res->u->ip ?></td>
                    </tr>
                    <tr>
                        <td><?= __('letzte IP') ?>:</td>
                        <td><?= $res->u->ip_lastlogin ?> </td>
                    </tr>
                    <tr>
                        <td><?= __('Vor-/Name') ?>:</td>
                        <td><?= $res->u->vorname ?> <?= $res->u->name ?> </td>
                    </tr>
                    <tr>
                        <td><?= __('Straße') ?>:</td>
                        <td><?=$res->u->strasse?> <?= $res->u->hausnummer ?></td>
                    </tr>
                    <tr>
                        <td><?= __('PLZ/Ort') ?>:</td>
                        <td><?=$res->u->plz?> <?=$res->u->ort?></td>
                    </tr>
                    <tr>
                        <td><?= __('Email')?>:</td>
                        <td><?= $res->u->email ?></td>
                    </tr>
                </table>
                <table cellspacing="0" style="margin-left: 5px; float:left;">
                    <tr>
                        <td><strong><?=__('Userstatus')?></strong></td>
                    </tr>
                    <tr>
                        <td><?=__('Status')?>: <?= Helper_User::renderOnlineOfflineIcon($res->u->useronline)?>
                            <?php if(!empty($res->u->useronline->id)) { ?>
                            <p><?= HTML2::anchor('#', __('Status ändern'))?></p>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= HTML2::javascriptAnchor(__('Neue interne Notiz'), array('id' => 'notiz'.$res->id, 'onclick' => 'jQuery("#notiz-form'.$res->id.'").toggle("slow")')) ?>
                        <div id="notiz-form<?=$res->id?>" style="display:none">
                        <?= Form::open(Route::get('default')->defaults(array('controller' => Request::current()->controller, 'action' => 'addNotiz'))->uri(array('id' => $res->u->user)), array('id' => 'form' . $res->id, 'class' => 'notiz-form')) ?>
                            <?=  Form::textarea('grund')?><br />
                            <?= Form::hidden('art', 'bildcheck')?>
                            <?=  Form::button('sub'.$res->id, __('Notiz Speichern'), array('type' => 'submit'))?> <span style="display:none; padding:1px 2px;"></span>
                        <?= Form::close()?>
                        </div>
                            <p><?= HTML2::anchor(Route::get('default')->defaults(array('controller' => Request::current()->controller, 'action' => 'showNotizen'))->uri(array('id' => $res->u->user)), __('Notiz Verlauf'), array('class' => 'nyroModal'))?></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td><?= Helper_User::renderUserPicture($res, 'thumb', true); ?>
        <?php 
            }
            else { 
                echo Helper_User::renderUserPicture($res, 'thumb', true);
            }
        }
        ?>
                </td>
</tr>
<tr>
    <td colspan="2" align="right"><?= Form::button('subAll', __('Alle Bilder speichern'), array('type' => 'submit'))?> <span style="display:none; padding:1px 2px;"></span></td>
</tr>
</table>
<?php
/**
 * @todo kapseln
 */
$submitFormFunktion = "
    
    jQuery('#subAll').click(function(){
        var forms = jQuery('form.save-picture-status');
        forms.each(function(){
            jQuery(this).trigger('submit');
        });
        return false;
    });

    var options = {
        beforeSubmit:  bRequest,
        success:       aRequest,
        dataType:      'json'
    };

    // bind form using 'ajaxForm'
    jQuery('form.notiz-form').submit(function() {
        // submit the form via ajax
        $(this).ajaxSubmit(options);
        return false;
    });
    $('a.nyroModal').nyroModal({bgColor: '#ffffff'});
    ";

HTML2::addJavaScriptCode($submitFormFunktion);

echo $page_links;