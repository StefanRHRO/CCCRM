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
<?php

if (! empty ( $results )) {
	?>

<table class="table_auto" cellspacing="0">
	<caption><?=I18n::get ( 'Kampagnenübersicht' )?></caption>
	<tr>
		<th><?=I18n::get ( 'Name/Beschreibung' )?></th>
		<th><?=I18n::get ( 'Erstellt' )?></th>
		<th><?=I18n::get ( 'Läuft ab' )?></th>
        <th><?=I18n::get ( 'Akt.' )?></th>
	</tr>
	<?php
	foreach ( $results as $k => $res ) {
		$x = $k % 2;
		?>
	<tr>
		<td <?=($x === 0) ? '' : ' class="alt"'?>>
		<?= HTML2::anchor(Route::get('default')->uri(array('controller' => Request::instance()->controller, 'action' => 'edit', 'id' => strip_tags($res->id))), HTML2::encode ( $res->name ))  ?><br />
		<strong><?= I18n::get('Beschreibung')?>:</strong>
		<?=HTML2::encode ( $res->beschreibung )?>
		</td>
		<td <?=($x === 0) ? '' : ' class="alt"'?>><?=I18n::formatMySQLDateToLocaleDateTime ( $res->created )?></td>
		<td <?=($x === 0) ? '' : ' class="alt"'?>><?=I18n::formatMySQLDateToLocaleDate ( $res->expired )?></td>
        <td <?=($x === 0) ? '' : ' class="alt"'?>><?=Helper::linkToEdit(Route::get('default')->uri(array('controller' => Request::instance()->controller, 'action' => 'edit', 'id' => strip_tags($res->id))))?></td>
	</tr>
	<?php
	}
	?>
</table>
<?=$page_links;?>
<?php } ?>