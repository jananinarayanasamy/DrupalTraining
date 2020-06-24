<?php 

namespace Drupal\user_display\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class ContentController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $build = [
      '#markup' => $this->t('Hello Drupal.. This is my 1st custom module!'),
    ];
    return $build;
  }

   public function userDisplay($user) {
	 
	   
	$config = \Drupal::config('user_display.settings');
	
	$userdata=$config->get($user);
	
	if(!empty($userdata))  { 
	
		$build = [
		  '#title' => $this->t("Hello I have displayed the user details Below"),
		  '#markup' => $this->t('<h2>The user name is '.$userdata['username'].' and the email address of the user is '.$userdata['email'].'.</h2>'),
		];
	} else {
		$build = [
			'#title' => $this->t('Error'),
			'#markup' => $this->t('User Not Found'),
		];
	}
	
    return $build;
  }
  
  


}

?>