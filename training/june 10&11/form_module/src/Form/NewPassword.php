<?php

namespace Drupal\form_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\drupal_set_message;

/**
 * Class Configuration Setting.
 *
 * @package Drupal\form_module\Form
 */
class NewPassword extends FormBase {


public $configid;
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $configid=NULL) {
    
    $config = \Drupal::config('form_module.settings');
    $uservalue = $config->get($configid); 
	
	// kint($uservalue);die;
	
    // Password Confirm.
    $form['password_confirm'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('New Password for '.$uservalue['username']),
      '#maxlength' => 15,
      '#required' => TRUE,
    ];
	
	$form['userid']=$configid;
	
    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Update Password'),
      '#button_type' => 'primary',
    );
	

    return $form;
  }

     /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    if ($form_state->getValue('password_confirm') == '') {
      $msg = t('<strong>Password is required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }
  
  public function getFormId() {
    return 'form_module';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
	
    //$config = \Drupal::config('form_module.settings')->getEditable();
	
	$password_confirm=$form_state->getValue('password_confirm');
	
	$data=['userid'=>$form['userid'],'password'=>$password_confirm];
	// print_r($data);die;
	
    $config = \Drupal::service('form_module.register')->update($data);
   
    drupal_set_message($this->t("@message", ['@message' => 'Password Successfully Updated.']));
  }


}
