<?php
include "twitter/TwitterOAuth.php";
include "twitter/AutoShareException.php";
use Exception;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Twitter
 *
 * @author ankit
 */
class Twitter {
    
    /**
     * @var string
     * */
    private $appId;

    /**
     * @var string
     * */
    private $appSecret;
    
    private $oAuthToken;
    
    private $oAuthSecret;
    
            
    function __construct($params) {    
        $this->appId = $params[0];
        $this->appSecret = $params[1];
        $this->oAuthToken=$params[2];
        $this->oAuthSecret=$params[3];
    }
   
    public function getSearchResults($search_string) {
        try {
            $twitteroauth = new TwitterOAuth($this->appId, $this->appSecret, $this->oAuthToken, $this->oAuthSecret);
            $search_result = $twitteroauth->get('search/tweets',array('q' => $search_string, 'count' => 100));
            $respArr= get_object_vars($search_result);
            if(count($respArr['errors'])!=0) {
                $error=$respArr['errors'];
                $obj=$error[0];
                $exObj=new AutoShareException($obj->code, $obj->message, $search_result);
                return $exObj;
            }
            
            $statusArr=$respArr['statuses'];
            return $statusArr;
        } catch (AutoShareException $e) {
            throw $e;
        } 
        catch (Exception $ex) {
            throw new AutoShareException($ex->getCode(), $ex->getMessage(), $ex);
        }
    }

}
