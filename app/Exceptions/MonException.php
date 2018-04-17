<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Exceptions;

use Exception;

/**
 * Description of MonException
 *
 * @author Pierre-Elliott
 */
class MonException extends Exception {
    
    private $numArticle = 0;
    
    public function __construct($numArticle, $message = null, $code = 0, Exception $previous = null) {
        $this->numArticle = $numArticle;
        parent::__construct($message, $code, $previous);
    }
    
    public function getNumArticle() {
        return $this->numArticle;
    }
}
