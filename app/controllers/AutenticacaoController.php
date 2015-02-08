<?php

/**
 * User: claudiohenrique
 * Date: 08/02/15
 * Time: 19:01
 */

class AutenticacaoController extends BaseController {

    public function logar(){
        $user = Input::all('user');
    }
} 