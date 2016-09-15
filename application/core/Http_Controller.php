<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Http_Controller extends MX_Controller {
  public $codepage = 0;
  public $length = 0;
  private $curl = null; 
  public $error = null; 
	public function __construct($timeout=null,$cookie=null,$auth=null,$proxy=null){
      parent::__construct();
      $this->curl = curl_init();
      if($proxy) curl_setopt ($this->curl, CURLOPT_PROXY, $proxy);
      if($auth) {
          curl_setopt ($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          curl_setopt ($this->curl, CURLOPT_USERPWD, $auth);
      }
      
      curl_setopt ($this->curl, CURLOPT_TIMEOUT, $timeout?$timeout:10);
      curl_setopt ($this->curl, CURLOPT_HEADER, 0);
      curl_setopt ($this->curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($this->curl, CURLOPT_AUTOREFERER, 1);
      curl_setopt ($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt ($this->curl, CURLOPT_FOLLOWLOCATION, 0);

      curl_setopt ($this->curl, CURLOPT_COOKIEFILE, $cookie);  
      curl_setopt ($this->curl, CURLOPT_COOKIEJAR, $cookie);  


      $header_array[]= 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/528.112 (KHTML, like Gecko)';  
      $header_array[]= 'Accept: application/xml,application/xhtml+xml,text/html;q=0.8';
      $header_array[]= 'Accept-Language: en-us,en;q=0.5';
      //$header_array[]= 'Accept-Encoding: text/html';
      $header_array[]= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
      $header_array[]= 'Keep-Alive: 300';
      $header_array[] = 'Connection: close';
  }

  function __destruct(){
        curl_close ($this->curl);
    }
    public function getheader($head=0){
        curl_setopt ($this->curl, CURLOPT_HEADER, $head);        
    }
    
    public function follow($follow=1){
        curl_setopt ($this->curl, CURLOPT_FOLLOWLOCATION, $follow);        
    }    
    public function cookie($name='cookie.txt'){
            curl_setopt ($this->curl, CURLOPT_COOKIEFILE, $name);  
            curl_setopt ($this->curl, CURLOPT_COOKIEJAR, $name);       
    }    
    
    
    public function setheader($arr_header){
        $arr_header[]= 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/528.112 (KHTML, like Gecko)'; 
        $arr_header[]= 'Accept: application/xml,application/xhtml+xml,text/html;q=0.8';
        $arr_header[]= 'Accept-Language: en-us,en;q=0.5';
        //$arr_header[]= 'Accept-Encoding: text/html';
        $arr_header[]= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
        $arr_header[]= 'Keep-Alive: 300';
        $arr_header[] = 'Connection: close';
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $arr_header);  
    }
    
    public function getPage($url,$ref=null){
        if($ref) curl_setopt ($this->curl, CURLOPT_REFERER, $ref);
        curl_setopt ($this->curl, CURLOPT_URL, $url);  
        $html = curl_exec ($this->curl);
        $this->length=curl_getinfo($this->curl,CURLINFO_SIZE_DOWNLOAD);
        $this->codepage=curl_getinfo($this->curl,CURLINFO_HTTP_CODE);
        $this->error=curl_error($this->curl);    
        return $html;
    }
    
    public function out_ip($ip=null){
        if($ip) curl_setopt ($this->curl, CURLOPT_INTERFACE, $ip);        
    }
    
    function postPage($url,$var,$ref=null){
        curl_setopt ($this->curl, CURLOPT_POST, 1);
        curl_setopt ($this->curl, CURLOPT_POSTFIELDS, $var);
        if($ref) curl_setopt ($this->curl, CURLOPT_REFERER, $ref); 
        curl_setopt ($this->curl, CURLOPT_URL, $url);
        $html = curl_exec ($this->curl);
        $this->length=curl_getinfo($this->curl,CURLINFO_SIZE_DOWNLOAD);
        $this->codepage=curl_getinfo($this->curl,CURLINFO_HTTP_CODE);
        $this->error=curl_error($this->curl);    
        return $html;
    }  
  
}
