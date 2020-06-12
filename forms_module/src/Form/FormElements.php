<?php


namespace Drupal\forms_module\Form;


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
class FormElements extends FormBase {


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
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    //$config = \Drupal::config('setting_module.settings');

   
    // Date-time.
    $form['datetime'] = [
      '#type' => 'datetime',
      '#title' => 'Date Time',
      '#date_increment' => 1,
      '#date_timezone' => drupal_get_user_timezone(),
      '#default_value' => drupal_get_user_timezone(),
      '#description' => $this->t('For Date time'),
    ]; 
	
	// Phone.
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('For telepjone'),
    ];


	// Select.
    $form['favorite'] = [
      '#type' => 'select',
      '#title' => $this->t('Favorite color'),
      '#options' => [
        'red' => $this->t('Red'),
        'blue' => $this->t('Blue'),
        'green' => $this->t('Green'),
        'yellow' => $this->t('Yellow'),
        'violet' => $this->t('Violet'),
        'orange' => $this->t('Orange'),
      ],
      '#empty_option' => $this->t('-select color-'),
      '#description' => $this->t('For Select List'),
    ];


    // Details.
    $form['details'] = [
      '#type' => 'details',
      '#title' => $this->t('Details'),
      '#description' => $this->t('For Showing Details'),
    ];


 // URL.
    $form['url'] = [
      '#type' => 'url',
      '#title' => $this->t('URL'),
      '#maxlength' => 255,
      '#size' => 30,
      '#description' => $this->t('For URL'),
    ];

    // Email.
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Email'),
    ];

    // Number.
    $form['quantity'] = [
      '#type' => 'number',
      '#title' => $this->t('Quantity'),
      '#description' => $this->t('Number'),
    ];

    // Password.
    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#description' => 'Password',
    ];

    // Password Confirm.
    $form['password_confirm'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('New Password'),
      '#description' => $this->t('PasswordConfirm'),
    ];

    // Range.
    $form['size'] = [
      '#type' => 'range',
      '#title' => $this->t('Size'),
      '#min' => 10,
      '#max' => 100,
      '#description' => $this->t('Range'),
    ];

    // Radios.
    $form['settings']['active'] = [
      '#type' => 'radios',
      '#title' => $this->t('Shop status'),
      '#options' => [0 => $this->t('Closed'), 1 => $this->t('Active')],
      '#description' => $this->t('Radios'),
    ];

	//Table
	$options = [
      1 => ['first_name' => 'Bat', 'last_name' => 'Man'],
      2 => ['first_name' => 'Darth', 'last_name' => 'Vader'],
      3 => ['first_name' => 'Super', 'last_name' => 'Man'],
    ];

    $header = [
      'first_name' => $this->t('First Name'),
      'last_name' => $this->t('Last Name'),
    ];

    $form['table'] = [
      '#type' => 'tableselect',
      '#title' => $this->t('Users'),
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No users found'),
    ];

//AJAX
	$form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This is an example of AJAX callback.'),
    ];

    
    $form['vehicle'] = [
      '#title' => $this->t('Vehicle'),
      '#type' => 'select',
      '#options' => $this->getVehicles(),
      '#empty_option' => $this->t('- Select a vehicle -'),
      '#ajax' => [
       
        'callback' => '::updateVehicle',
        'wrapper' => 'vehicle-wrapper',
      ],
    ];

    $form['vehicle_wrapper'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'vehicle-wrapper'],
    ];

    
    $veh = $form_state->getValue('vehicle');
    if (!empty($veh)) {
      $form['vehicle_wrapper']['brands'] = [
        '#type' => 'select',
        '#title' => $this->t('Brands'),
        '#options' => $this->getVehiclesByBrand($veh),
      ];
    }



    return $form;
  }



  public function updateVehicle(array $form, FormStateInterface $form_state) {
    return $form['vehicle_wrapper'];
  }

  protected function getVehiclesByBrand($veh) {
    return $this->getVehiclesAll()[$veh]['brand'];
  }

  protected function getVehicles() {
    return array_map(function ($vehicle_data) {
      return $vehicle_data['name'];
    }, $this->getVehiclesAll());
  }

  protected function getVehiclesAll() {
    return [
      'bajaj' => [
        'name' => $this->t('Bajaj'),
        'brand' => [
          'pulsar' => $this->t('Pulsar'),
          'platina' => $this->t('Platina'),
          'dominiar' => $this->t('Dominiar'),
          'avenger' => $this->t('Avenger'),
        ],
      ],
      'tvs' => [
        'name' => $this->t('TVS'),
        'brand' => [
          'pep' => $this->t('Pep'),
          'apache' => $this->t('Apache'),
          'jive' => $this->t('Jive'),
        ],
      ],
    ];
  }

 
  public function getFormId() {
    return 'forms_module';
  }

public function validateForm(array &$form, FormStateInterface $form_state) {
     return 'forms_module';
  }



  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    foreach ($values as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // Many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) {
        $value = array_filter($value);
      }

      // Only display for controls that have titles and values.
      if ($value && $label) {
        $display_value = is_array($value) ? preg_replace('/[\n\r\s]+/', ' ', print_r($value, 1)) : $value;
        $message = $this->t('Value for %title: %value', ['%title' => $label, '%value' => $display_value]);
        $this->messenger()->addMessage($message);
      }
    }
  }

  // /**
  //  * {@inheritdoc}
  //  */
  // protected function getEditableConfigNames() {
  //   return ['config_module.settings'];
  // }


}

















