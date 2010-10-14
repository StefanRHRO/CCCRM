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

/**
 * Description of user
 *
 * @author stefanriedel
 */
class Controller_User extends Controller_Main {

    protected $_whereParameter = array();
    protected $_filterOpException = array('user' => 'LIKE');

    protected $_layoutedAjaxException = array('showNotizen');

    protected $_secureActions = array(
        'addNotiz' => array('login'),
        'index' => array('login'),
        'pictures' => array('login'),
        'details' => array('login'),
    );

    public function action_showNotizen() {
        $this->template->set_filename('theme/default/blank');
        $this->template->content = View::factory($this->_templatePath . '/user/notizen/list')
                        ->bind('results', $results);
        
        $id = $this->request->param('id');
        $usermelden = ORM::factory('usermelden')->setAllByUser($id);
        //$count = $usermelden->count_all();
        //$usermelden->setAllByUser($id);

        /*$pagination = Pagination::factory(array(
                    'total_items' => $count,
                    'items_per_page' => 5,
                ));*/

        //$usermelden->limit($pagination->items_per_page)->offset($pagination->offset);
        if (!empty($_GET['order']) && !empty($_GET['type'])) {
            $usermelden->order_by($_GET['order'], $_GET['type']);
        }
        $results = $usermelden->find_all();
        //$page_links = $pagination->render($this->_templatePath . '/pagination/basic');
        //$current_page = $pagination->current_page;
    }

    public function action_addNotiz() {
        $id = strip_tags(Request::current()->param('id'));
        $data = array();
        $checkData = array(
            'gemeldet' => $id,
            'von' => Session::instance()->get('auth_user')->user,
            'admin' => Session::instance()->get('auth_user')->user,
            'gbid' => 0
            );
        $checkData = array_merge($_POST, $checkData);
        if (!empty($id)) {
            $usermelden = ORM::factory('usermelden');
            $post = $usermelden->validateUpdateAdminNotiz($checkData);
            if ($post->check()) {
                $usermelden->values($post);
                $usermelden->save();
                $data = array('message' => __('Notiz gespeichert.'), 'type' => 'success');
            } else {
                $data = array('message' => __('Es sind Fehler beim Eintragen der Notiz aufgetreten!'), 'type' => 'error');
            }
        } else {
            $data = array('message' => __('Es wurde keine Nutzer ID uebergeben!'), 'type' => 'error');
        }
        $this->request->response = json_encode($data);
    }

    /**
     * @todo CRUD Funktionalität kapseln
     */
    public function action_index() {

        $this->template->siteTitle = I18n::get('Nutzerübersicht');

        $this->template->content = View::factory($this->_templatePath . '/user/list')
                        ->bind('results', $results)
                        ->bind('page_links', $page_links)
                        ->bind('current_page', $current_page)
                        ->bind('account_type', $this->_whereParameter['account_type'])
                        ->bind('user', $this->_whereParameter['user']);

        $this->_initializeWhereParameter($_GET);

        $user = ORM::factory('user');
        $user->setFilterOpExceptions($this->_filterOpException);

        if (!empty($this->_whereParameter)) {
            $user = $user->addFilters($this->_whereParameter);
        }

        $count = $user->count_all();

        if (!empty($this->_whereParameter)) {
            $user = $user->addFilters($this->_whereParameter);
        }

        $pagination = Pagination::factory(array(
                    'total_items' => $count,
                    'items_per_page' => 15,
                ));

        $user->limit($pagination->items_per_page)->offset($pagination->offset);
        if (!empty($_GET['order']) && !empty($_GET['type'])) {
            $user->order_by($_GET['order'], $_GET['type']);
        }
        $results = $user->find_all();
        $page_links = $pagination->render($this->_templatePath . '/pagination/basic');
        $current_page = $pagination->current_page;
    }

    protected function _initializeWhereParameter(array $parameter) {
        foreach ($parameter as $column => $param) {
            if (!in_array($column, $this->_excludeParameter)) {
                $this->_whereParameter[$column] = $param;
            }
        }
    }

    public function action_pictures() {
        $this->template->siteTitle = I18n::get('Nutzer Bilder');
        array_push($this->template->scripts, Route::get('media')->uri(array('file' => 'javascript/jquery.form.js')), Route::get('media')->uri(array('file' => 'javascript/jquery.imagepreview.js')),Route::get('media')->uri(array('file' => 'javascript/jquery.modal.js')));
        $this->template->styles = array_merge($this->template->styles, array(Route::get('media')->uri(array('file' => 'css/nyroModal.css')) => 'screen'));
        $this->template->content = View::factory($this->_templatePath . '/user/pictures_list')
                        ->bind('results', $results)
                        ->bind('page_links', $page_links)
                        ->bind('current_page', $current_page)
                        ->bind('count', $count)
                        ->bind('status_bild', $this->_whereParameter['status_bild'])
                        ->bind('user', $this->_whereParameter['user']);

        $this->_initializeWhereParameter($_GET);

        $picture = ORM::factory('picture');
        $picture->setFilterOpExceptions($this->_filterOpException);

        if (!empty($this->_whereParameter)) {
            $picture = $picture->addFilters($this->_whereParameter);
        }

        $count = $picture->count_all();

        /**
         * warum muessen wir das wieder holen
         */
        if (!empty($this->_whereParameter)) {
            $picture = $picture->addFilters($this->_whereParameter);
        }

        $pagination = Pagination::factory(array(
                    'total_items' => $count,
                    'items_per_page' => 15,
                ));

        $picture->limit($pagination->items_per_page)->offset($pagination->offset);
        if (!empty($_GET['order']) && !empty($_GET['type'])) {
            $user->order_by($_GET['order'], $_GET['type']);
        }
        $picture->with('useronline');
        $results = $picture->find_all();
        $page_links = $pagination->render($this->_templatePath . '/pagination/basic');
        $current_page = $pagination->current_page;
    }

    public function action_details() {
        $userName = strip_tags($this->request->param('id'));
        if (!empty($userName)) {

            try {
                $user = ORM::factory('user')->where('user', '=', $userName)->find();
                $this->template->siteTitle = __('Datenübersicht von :user', array(':user' => $userName));
                if (!$user->id) {
                    $this->template->siteTitle = __(':user existiert nicht', array(':user' => $userName));
                    $this->template->errors[] = __('Den Nutzer: :user gibt es leider nicht.', array(':user' => $userName));
                }
            } catch (Exception $e) {
                throw new Kohana_Exception('Leider ist ein Fehler aufgetreten: :message', array(':message' => $e->getMessage()));
            }
        } else {
            $this->template->errors[] = __('Bitte übergeben Sie einen Nutzernamen.');
        }
    }

}

?>
