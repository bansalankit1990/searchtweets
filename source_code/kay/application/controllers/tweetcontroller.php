<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tweetController
 *
 * @author ankit
 */
class TweetController extends CI_Controller {
    //put your code here
    public function __construct()
    {
            parent::__construct();
            $params=array(APP_ID,APP_SECRET,OAUTH_TOKEN,OAUTH_SECRET);
            $this->load->library('Twitter',$params);
    }    
    
    public function index()
    {
        $exFlag=0;
        try {
            $status=$this->twitter->getSearchResults("#custserv");
        } catch (Exception $ex) {
            $exFlag=1;
        }
        
        if(is_a($status, 'Exception') || $exFlag==1) {
            $returnArr['error']="Error in fetching tweets.";
        }else {
            $statusDataArr=$this->getRetweetedStatuses($status);
            $returnArr['status']=$statusDataArr;
        }
        
        $this->load->view('templates/header');
        $this->load->view('tweets/viewTweets',$returnArr);
        $this->load->view('templates/footer');                
    }
    
    
    private function getRetweetedStatuses($statusObjArr) {
        $retweetStatusArr=array();
        foreach ($statusObjArr as $key => $status) {
            if($status->retweet_count>=$minRetweetCount) {
                if(!array_key_exists($status->retweeted_status->id, $retweetStatusArr))
                {
                    $retweetStatusArr[$status->retweeted_status->id]=$status->retweeted_status->text;
                }
            }
        }
        return $retweetStatusArr;      
    }
}



