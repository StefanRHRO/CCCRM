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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <title><?= $title ?></title>
        
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), "\n" ?>
      	<?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
        
        <!--Internet Explorer Trancparency fix-->
        <!--[if IE 6]>
        <script src="js/ie6pngfix.js"></script>
        <script>
          DD_belatedPNG.fix('#head, a, a span, img, .message p, .click_to_close, .ie6fix');
        </script>
        <![endif]--> 
    </head>
    
    <body>
    	<!-- this is the content for the dialog that pops up on window start -->
    
        
        <div id="top">
        
            <div id="head">
            	<h1 class="logo">
                	<a href="">flexy - adjustable admin skin</a>
                </h1>
                
                <div class="head_memberinfo">
                    <span class='memberinfo_span'>
                        Hallo <?= (Auth::instance()->logged_in()) ? Session::instance()->get('auth_user')->username : ''?>
                    </span>
                    <span>
                    	<?= HTML2::anchor('/logout', I18n::get('Logout')) ?>
                    </span>
                </div><!--end head_memberinfo-->
            
            </div><!--end head-->
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                            <div class="content_block">
                                <h2 class="jquery_tab_title"><?=$siteTitle?></h2>
                                <?=(!empty($errors)) ? HTML2::errorBlock($errors) : ''?>
                                <?=$content?>
                            </div>
                        </div><!--end content-->
                        
                    </div><!--end main-->
                    
              <div id="sidebar">
                            <ul class="nav">
                                <li><a class="headitem item1" href="javascript:void(0);"><?=I18n::get('Dashboard')?></a>
                                    <ul class="opened"><!-- ul items without this class get hiddden by jquery-->
                                        <li><?=  HTML2::anchor(Route::get('default')->uri(), I18n::get('Start'))?></li>
                                        <li><a href="#"><?=I18n::get('Suche')?></a></li>
                                        <li><?= HTML2::anchor(Route::get('default')->uri(array('controller' => 'user', 'action' => 'pictures')), 'Bildermanager') ?></li>
                                    <li class="current"><?= HTML2::anchor(Route::get('default')->uri(array('controller' => 'user', 'action' => 'index')), 'Nutzermanager') ?></li>
                                    </ul>
                                </li>
                                <!--<li><a class="headitem item2" href="#">Settings</a>
                                    <ul>
                                    <li><a href="#">Post settings</a></li>
                                    <li><a href="#">User settings</a></li>
                                    <li><a href="#">Permalink Structure</a></li>
                                    </ul>                            
                                </li>
                                <li><a class="headitem item4" href="#">Edit</a>
                                    <ul>
                                    <li><a href="#">Edit Posts</a></li>
                                    <li><a href="#">Edit Pages</a></li>
                                    <li><a href="#">Edit Links</a></li>
                                    <li><a href="#">Edit Menu Items</a></li>
                                    </ul>
                                </li>
                                <li><a class="headitem item5" href="#">Search Site</a>
                                    <ul>
                                    <li><a href="#">Basic Search</a></li>
                                    <li><a href="#">Advanced Search</a></li>
                                    <li><a href="#">Search Option</a></li>
                                    </ul>
                                </li>
                                <li><a class="headitem item6" href="#">Deleted Items</a>
                                    <ul>
                                    <li><a href="#">Content</a></li>
                                    <li><a href="#">Images</a></li>
                                    <li><a href="#">Audio</a></li>
                                    <li><a href="#">Video</a></li>
                                    <li><a href="#">PDF</a></li>
                                    <li><a href="#">Scripts</a></li>
                                    <li><a href="#">Other</a></li>
                                    </ul>
                                </li>-->
                            </ul><!--end subnav-->
                            
                          <div class="flexy_datepicker"></div>
                           
                           <!--<ul>
                           <li><a class="headitem item7" href="#">Task Manager</a>
                                    <ul>
                                    <li><a href="#">Write Blogpost</a></li>
                                    <li><a href="#">Script Pages</a></li>
                                    <li><a href="#">Meeting at 8.00</a></li>
                                    </ul>
                                </li>
                           </ul>-->
                            
                        </div><!--end sidebar-->
                        
                     </div><!--end bg_wrapper-->
                     
                <div id="footer">

                </div><!--end footer-->
                
        </div><!-- end top -->
        <?php if(Kohana::config('defaults.debug')) { ?>
        <div id="kohana-profiler">
		<?php echo View::factory('profiler/stats') ?>
		</div>
        <?php } ?>
                    	
<?php
$javascriptCode = HTML2::getJavaScriptCodes();
if(!empty($javascriptCode)):
?>
<script type="text/javascript">
    /* <![CDATA[ */
    jQuery(document).ready(function(){
    <?php foreach($javascriptCode as $jsCode):?>
        <?= $jsCode; ?>
    <?php endforeach; ?>
    });
    /* ]]> */
</script>
<?php endif; ?>
    </body>
    
</html>
