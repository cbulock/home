<?php
namespace cbulock\home\Controller;

class Printer extends Base {
 
 public function process() {
  
  $this->setTemplate('Printer');
  
  $ipp = new \PHPIPP\CupsPrintIPP();
  $ipp->setHost('printer');
  
  $this->addData(
   [
    'status' => $ipp->getPrinters()
   ]
  );
 
 }
 
}