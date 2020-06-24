<?php

namespace Drupal\config_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;

/**
 * Class Configuration Setting.
 *
 * @package Drupal\config_module\Form
 */
class ConfigurationSetting extends FormBase {

  /**
   * {@inheritdoc}
   */
  // public static function create(ContainerInterface $container) {
  //   return new static(
  //       $container->get('config_module.settings')
  //   );
  // }

 

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $config = \Drupal::config('config_module.settings');
    
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 30,
      '#required' => TRUE,
      '#default_value' => $config->get('user.name') ? $config->get('user.name') : '',
    ];
    
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#maxlength' => 70,
      '#required' => TRUE,
      '#default_value' => $config->get('user.email') ? $config->get('user.email') : '',
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
    if ($form_state->getValue('username') == '' || $form_state->getValue('email') == '') {
      $msg = t('<strong>Username and Email are required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_module';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    //$config = \Drupal::config('config_module.settings')->getEditable();
    $config = \Drupal::service('config.factory')->getEditable('config_module.settings');
    $config->set('user.name', $form_state->getValue('username'));
    $config->set('user.email', $form_state->getValue('email'));
    $config->save();

    drupal_set_message($this->t("@message", ['@message' => 'Configuration Successfully Updated.']));
  }


}
