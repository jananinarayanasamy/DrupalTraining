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
class Register extends FormBase {

 

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
   // $config = \Drupal::config('form_module.settings');
    
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 30,
      '#required' => TRUE,
      '#default_value' => '',
    ];
    
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#maxlength' => 50,
      '#required' => TRUE,
      '#default_value' => '',
    ];

    // Password Confirm.
    $form['password_confirm'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('New Password'),
      '#maxlength' => 15,
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
	

    return $form;
  }
   
     /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // valiodate form values
    if ($form_state->getValue('username') == '' || $form_state->getValue('email') == '' || $form_state->getValue('password_confirm') == '') {
      $msg = t('<strong>Username and Email and Password are required!</strong>');
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
	
	
	$username=$form_state->getValue('username');
	$email=$form_state->getValue('email');
	$password_confirm=$form_state->getValue('password_confirm');
	
	$data=['username'=>$username,'email'=>$email,'password'=>$password_confirm];
	// print_r($data);die;
	
    $config = \Drupal::service('form_module.register')->store($data);
   
    drupal_set_message($this->t("@message", ['@message' => 'User Registered Successfully.']));
  }

 
}
