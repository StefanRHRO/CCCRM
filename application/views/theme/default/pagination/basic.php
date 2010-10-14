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
$navceil = 10/2;
?>
<p>Datensätze: <?=$current_first_item?> - <?=(int)$current_last_item?> von <?=$total_items?></p>
<p class="pagination">

	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo $page->url($first_page) ?>"><?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_b_left.png')), array('title' => __('Erste Seite'), 'alt' => __('Erste Seite'))) ?></a>
	<?php else: ?>
		<?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_b_left.png')), array('title' => __('Erste Seite'), 'alt' => __('Erste Seite'))) ?>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo $page->url($previous_page) ?>"><?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_left.png')), array('title' => __('Zurück'), 'alt' => __('Zurück'))) ?></a>
	<?php else: ?>
		<?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_left.png')), array('title' => __('Zurück'), 'alt' => __('Zurück'))) ?>
	<?php endif ?>

	<?php for ($i = $current_page-$navceil; $i <= $current_page+$navceil; $i++): ?>
                <?php if(($i > 0 && $i<$current_page) || ($i > $current_page && $i <= $total_pages)):?>
                    <a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
                <?php endif;?>
                <?php if ($i == $current_page): ?>
                    <strong>[<?php echo $i ?>]</strong>
                <?php endif; ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo $page->url($next_page) ?>"><?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_right.png')), array('title' => __('Weiter'), 'alt' => __('Weiter'))) ?></a>
	<?php else: ?>
		<?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_right.png')), array('title' => __('Weiter'), 'alt' => __('Weiter'))) ?>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo $page->url($last_page) ?>"><?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_b_right.png')), array('title' => __('letzte Seite'), 'alt' => __('letzte Seite'))) ?></a>
	<?php else: ?>
		<?= HTML2::image(Route::get('media')->uri(array('file'=>'icons/arrow_b_right.png')), array('title' => __('letzte Seite'), 'alt' => __('letzte Seite'))) ?>
	<?php endif ?>

</p><!-- .pagination -->