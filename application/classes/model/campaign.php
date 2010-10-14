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
 * $Id: user.php 9 2010-08-12 20:31:38Z stefanriedel $
 * $LastChangedBy: stefanriedel $
 *
 * @author    Stefan Riedel <info@srit-stefanriedel.de>
 * @copyright 2010 SRIT Stefan Riedel
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Model_Campaign extends ORM {
	//protected $_table_name = 'community_userdata';
	//protected $_load_with = array('useronline');
	// Relationships
	protected $_has_many = array ('campaignfields' => array ('model' => 'campaignfield', 'foreign_key' => 'campaign_id' ) );
	protected $_updated_column = array ('column' => 'changed' );
	protected $_created_column = array ('column' => 'created' );
	protected $_rules = array ('name' => array ('max_length' => array (200 ), 'not_empty' => array () ), 'beschreibung' => array ('max_length' => array (255 ) ), 'expired' => array ('date' => array () ) );
	protected $_filters = array (TRUE => array ('trim' => array () ), TRUE => array ('stripslashes' => array () ) );
	//protected $_load_with = array('campaignfields');
	/*protected $_belongs_to = array(
        'useronline' => array('foreign_key' => 'user')
    );*/
}