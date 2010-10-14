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
class Model_Picture extends ORM {

    protected $_table_name = 'community_userdata_bilder';
    // Relationships
    protected $_belongs_to = array(
        'u' => array('model' => 'user', 'foreign_key' => 'user_id'),
            //'useronline' => array('foreign_key' => 'user', 'far_key' => 'user')
    );
    protected $_load_with = array('u', 'u:useronline');
    protected $_callbacks = array(
        'status_bild' => array('status_allowed'),
    );

    public function find_all() {
        $this->_sorting = array_merge(array('user_id' => 'DESC'), $this->_sorting);
        return parent::find_all();
    }

    public function validateChangeStatus(& $array) {
        $array = Validate::factory($array)
                        ->filter('info_bild', 'trim')
                        ->filter('info_bild', 'strip_tags')
                        ->filter('status_bild', 'trim')
                        ->filter('status_bild', 'strip_tags');
                        
        foreach ($this->_callbacks['status_bild'] as $callback) {
            $array->callback('status_bild', array($this, $callback));
        }

        return $array;
    }

    public function status_allowed(Validate $array, $field) {
        $allowedStatus = array(1,2,3);
        if(!in_array($array[$field], $allowedStatus)) {
            $array->error($field, 'status_allowed', array($array[$field]));
        }
    }

    /* public function validate_create(& $array) {
      // Initialise the validation library and setup some rules
      $array = Validate::factory($array)
      ->rules('md5pass', $this->_rules['md5pass'])
      ->rules('user', $this->_rules['user'])
      ->rules('email', $this->_rules['email'])
      ->rules('password_confirm', $this->_rules['password_confirm'])
      ->filter('user', 'trim')
      ->filter('email', 'trim')
      ->filter('md5pass', 'trim')
      ->filter('password_confirm', 'trim');

      #Executes username callbacks defined in parent
      foreach ($this->_callbacks['user'] as $callback) {
      $array->callback('user', array($this, $callback));
      }

      #Executes email callbacks defined in parent
      foreach ($this->_callbacks['email'] as $callback) {
      $array->callback('email', array($this, $callback));
      }

      return $array;
      } */
}