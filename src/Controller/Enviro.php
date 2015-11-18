<?php
namespace cbulock\home\Controller;

class Enviro extends Base {
 
 public function process() {
  
  $this->setTemplate('Enviro');
  
  $nest = new \Nest(NEST_USERNAME, NEST_PASSWORD);
  
  //print_r($nest->getDeviceInfo());
  $info = $nest->getDeviceInfo();
  $weather = $nest->getWeather(ZIP_CODE);
  
  $active_status = NULL;
  if ($info->current_state->ac) $active_status = 'cool';
  if ($info->current_state->heat) $active_status = 'heat';
  
  $nestdata = [
   'temp' => [
    'inside' => round($info->current_state->temperature),
    'outside' => round($weather->outside_temperature)
   ],
   'rawtemp' => [
    'inside' => $info->current_state->temperature,
    'outside' => $weather->outside_temperature
   ],
   'humidity' => [
    'inside' => $info->current_state->humidity,
    'outside' => $weather->outside_humidity
   ],
   'active_status' => $active_status
   
  ];
    
  $this->addData(
  [
   'nestdata' => $nestdata
  ]);
 
 }
 
}