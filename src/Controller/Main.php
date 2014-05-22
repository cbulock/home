<?php
namespace cbulock\home\Controller;

class Main extends Base {
 
 public function process() {
  
  $this->setTemplate('Main');
  
  $nest = new \Nest(NEST_USERNAME, NEST_PASSWORD);
  
  print_r($nest->getDeviceInfo());
  $info = $nest->getDeviceInfo();
    
  $this->addData(
  [
   'rand'    =>    md5(uniqid(rand(), true)),
   'state' => $info->current_state,
   'target' => $info->target
  ]);
    
 }
 
}