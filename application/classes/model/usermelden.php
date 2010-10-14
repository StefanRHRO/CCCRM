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
class Model_Usermelden extends ORM {

    protected $_table_name = 'community_usermelden';

    protected $_updated_column = array(
        'column' => 'changed',
    );
    protected $_created_column =  array(
        'column' => 'created',
    );

    // Relationships
    //protected $_primary_key = 'user';
    protected $_callbacks = array(
        'gemeldet' => array('user_available'),
    );
    protected $_belongs_to = array('u' => array('model' => 'user'));

    //protected $_belongs_to = array('u' => array('model' => 'user', 'foreign_key' => 'user_id'));
    //protected $_load_with = array('u');

    protected function _setWhere() {

    }

    public function setAllByUser($username) {
        $this->addFilters(array('gemeldet' => $username));
        return $this;
    }

    public function validateUpdateAdminNotiz(& $array) {
        $array = Validate::factory($array)
                        ->filter('grund', 'trim')
                        ->filter('grund', 'strip_tags')
                        ->filter('von', 'trim')
                        ->filter('von', 'strip_tags')
                        ->filter('gemeldet', 'trim')
                        ->filter('gemeldet', 'strip_tags')
                        ->filter('art', 'strip_tags')
                        ->filter('art', 'trim')
                        ->filter('admin', 'strip_tags')
                        ->filter('admin', 'trim');

        foreach ($this->_callbacks['gemeldet'] as $callback) {
            $array->callback('gemeldet', array($this, $callback));
        }
        return $array;
    }

    public function user_available(Validate $array, $field) {
        $user = ORM::factory('user');
        if (!$user->unique_key_exists($array[$field])) {
            $array->error($field, 'user_available', array($array[$field]));
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