<?php

namespace  Drupal\form_module\Services;
use Drupal\Core\Config\ConfigFactoryInterface;


interface ServicesInterface { 
	   public  function store($data); 
	   public  function update($data); 
}

class FormServices implements ServicesInterface{

 public $data;

public function __construct(ConfigFactoryInterface $config_factory) {
   $this->configFactory = $config_factory;
 } 
 
 

 public function  store($data){
	$id=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 3);
	//echo $id; die;
	
    // $config = \Drupal::service('config.factory')->getEditable('form_module.settings')->delete();
	$key='user'.$id;
    $config = $this->configFactory->getEditable('form_module.settings');
    // $config = \Drupal::service('config.factory')->getEditable('form_module.settings');
    $config->set($key, $data);
    $config->save();
 }
 
  public function  update($data){
	
	$key=$data['userid'];
	unset($data['userid']);
		
    $config = \Drupal::service('config.factory')->getEditable('form_module.settings');
    $config->set($key.'.password', $data['password']);
    $config->save();
 }

}