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
if (!empty($results)):
    echo $page_links;
?>
<?= Form::open(NULL, array('method' => 'get')) ?>
<h2>Filter</h2>
<?= __('nur Goldfische') ?> <?= Form::select('account_type', array(0 => 'egal', 1 => 'ja'), $account_type) ?> | <?= __('Nutzername') ?> <?= Form::input('user', $user) ?>
<?= Form::submit('sub', 'Filtern') ?>
<?= Form::close() ?>
    <table class="table_auto" cellspacing="0">
        <caption><?= I18n::get('Nutzerübersicht') ?></caption>
        <tr>
            <th class="nobg"><?= HTML2::orderAnchor('id', array(array('name' => 'page', 'value' => $current_page)), '#'.I18n::get('ID')) ?></th>
            <th><?= HTML2::orderAnchor('user', array(array('name' => 'page', 'value' => $current_page)), I18n::get('Nutzername'))?></th>
            <th><?= I18n::get('Name') ?></th>
            <th><?= I18n::get('E-Mail') ?></th>
            <th><?= I18n::get('Geb.') ?></th>
            <th><?= HTML2::orderAnchor('geschlecht', array(array('name' => 'page', 'value' => $current_page)), I18n::get('Geschl.')) ?></th>
            <th><?= HTML2::orderAnchor('account_type', array(array('name' => 'page', 'value' => $current_page)), I18n::get('G-Fisch')) ?></th>
            <th><?= I18N::get('Fischk. seit') ?></th>
            <th><?= I18n::get('Bilder')?></th>
            <th class="nobg"><?=  I18n::get('Akt.')?></th>
        </tr>
        <?php foreach($results as $k => $res):
            $x = $k%2;
            ?>
        <tr>
            <td class="<?=($x===0) ? 'spec' : 'specalt'?>"><?=  strip_tags($res->id)?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?= HTML2::anchor(Route::get('default')->uri(array('controller' => Request::instance()->controller, 'action' => 'details', 'id' => strip_tags($res->user))), strip_tags($res->user)) ?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?=  strip_tags($res->vorname) . ' ' . strip_tags($res->name)?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?=  strip_tags($res->email)?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?=  strip_tags($res->gebdatum)?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?= ($res->geschlecht === 'w') ? I18n::get('weibl.') : I18n::get('männl.') ?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?= ((int)$res->account_type === 1) ? I18n::get('Ja.') : I18n::get('Nein.') ?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?=  strip_tags($res->accountcreated)?></td>
            <td<?=($x===0) ? '' : ' class="alt"'?>><?= $res->pictures->count_all() ?></td>
            <td class="<?=($x===0) ? 'spec' : 'specalt'?>"><?= Helper_User::linkToUser($res); ?></td>
        </tr>
        <?php endforeach;?>

    </table>
<?= $page_links; ?>
<?php endif; ?>