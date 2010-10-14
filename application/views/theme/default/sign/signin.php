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
<div id="login">
        
        	<h1 class="logo">
            	<a href=""><?php echo $title;?></a>
            </h1>
            <h2 class="loginheading">Login</h2>
            <div class="icon_login ie6fix"></div>
            <?php echo Form::open(null, array('id' => 'login-form'));?>    
            <p>
            <?php echo Form::label('username', I18n::get('Nutzername'))?>
          	<?php echo Form::input('username', $username, array('class' => 'input-medium'))?>
            </p>
            <p>
            <?php echo Form::label('password', I18n::get('Passwort'))?>
          	<?php echo Form::password('password', null, array('class' => 'input-medium'))?>
            </p>
            <div class="forgot_pw"><a href="index.html"><?= I18n::get('Passwort vergessen?')?></a></div>
            <p class="clearboth">
			<?php echo Form::submit('submit', I18n::get('Login'), array('class' => 'button'))?>
        	</p>
          	<?php echo Form::close();?>
        </div>
        <?php if(!empty($errors)):?>
        <?php echo HTML2::errorBlock($errors);?>
        <?php endif;?>