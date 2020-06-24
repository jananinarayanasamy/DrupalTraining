<?php 

namespace Drupal\calculator\Controller;

use Drupal\Core\Controller\ControllerBase;


interface AreaInterface { 
   public  function areaCalculation($heigth,$width); 
}
	
trait msgDisplay{
	public function displayMsg($data) {
		return "Successfully ".$data." !!!"."<br><br>";
	}
  
}

/**
 * An example controller.
 */
class AreaClass extends ControllerBase implements AreaInterface{

  /**
   * Returns a render-able array for a test page.
   */
   
    use msgDisplay;
	
   public function areaCalculation($heigth,$width){ 
		
		$data.="<h2>Input for Area Calculation is  : " .$heigth." & ".$width."</h2><br><br>";
	
		$data.="Area (H*W) is : ". $heigth * $width ."<br>";
		$data.=$this->displayMsg('Calculated Area')."<br>";
			$build = [
      '#markup' => $this->t($data),
    ];
	
    return $build;
	}




}

?>