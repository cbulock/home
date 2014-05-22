<?php
namespace cbulock\home\Controller;

class Base {
 
 public $route;
 protected $interface;
 
 public function __construct($route) {
  $this->route = $route;
  $this->setupInterface();
 }
 
 protected function setupInterface() {
  $this->interface = new \cbulock\home\SiteInterface\Base;
 }
 
 public function setTemplate($template) {
  $this->interface->template($template);
 }
 
 public function addData($data) {
  $this->interface->addData($data);
 }
 
 public function setContentType($content_type) {
  $this->interface->setContentType($content_type);
 }
 
 public function load() {
  $this->process();
  $this->interface->output();
 }

}