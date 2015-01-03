<?php
//namespace AutoShare;
//include "Exception.php";
use Exception;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoShareException
 *
 * @author ankit
 */
class AutoShareException extends Exception{
    
    private $originalExceptionObject;
    
    private $EXCEPTION_CODE_MAPPING =array(
        190=>500,
        89=>501,
        187=>502,
        401=>500,
    );
    
    private $EXCEPTION_CODE_MESSAGE_MAPPING =array(
        500=>"The user hasn't authorized the application to perform this action",
        501=>"Invalid or expired token",
        502=>"Status is a duplicate",
    );    
    
    public function getOriginalExceptionObject() {
        return $this->originalExceptionObject;
    }

    public function __construct($reply_code, $reply_text, $originalExceptionObject) {
        $code=  $this->EXCEPTION_CODE_MAPPING[$reply_code];
        $message=$this->EXCEPTION_CODE_MESSAGE_MAPPING[$code];
        if(empty($code)) { $code=$reply_code;}
        if(empty($message)) { $message=$reply_text;}
        parent::__construct($message,$code);
        $this->originalExceptionObject=$originalExceptionObject;
    }
    
}
