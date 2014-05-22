<?php
namespace cbulock\home\SiteInterface;

class Base {
 
 private $twig;
 private $template;
 protected $data = [];
 private $content_type;
 
 public function __construct() {
  
  $loader = new \Twig_Loader_Filesystem('templates');
  $this->twig = new \Twig_Environment($loader);
  $this->twig->addExtension(new \Twig_Extensions_Extension_I18n());
  
  $this->setContentType("Content-type: text/html; charset=UTF-8");
 }
 
 public function setContentType($content_type) {
  $this->content_type = $content_type;
 }
 
 public function template($template) {
  $this->template = $template;
 }
 
 public function addData($data) {
  $this->data = array_merge($this->data, $data);
 }
 
 public function render() {
  header($this->content_type);
  $template = $this->twig->loadTemplate($this->template . '.twig');
  return $template->render($this->data);
 }
 
 public function output() {
  echo $this->render();
 }
 
 public function exceptionHandler($e) {
  $code = $e->getCode();
  switch($code) {
   case 403:
   case 404:
    header("HTTP/1.0 ".$code);
    $_SERVER['REDIRECT_STATUS'] = $code;
    $this->addData([
     'number'	=>	$code,
     'rand'	=>	md5(uniqid(rand(), true))
    ]);
    $this->template('error');
    $this->output();
    die();
    break;
   default:
    $body = 'An error occured for site '. $site_name . ".\n\n";
    $body .= "Error:\n";
    $body .= $e->getMessage()."\n\n";
    $body .= "Code:\n";
    $body .= $code."\n\n";
    $body .= "Page requested:\n";
    $body .= $_SERVER['REQUEST_URI']."\n\n";    
    $body .= "IP:\n";
    $body .= $_SERVER['REMOTE_ADDR'];
    $this->addData([
     'code'	=>	$code,
     'message'	=>	$e->getMessage()
    ]);
    $this->template('exception');
    $this->output();
    die();
    break;
  }
 }
 
}