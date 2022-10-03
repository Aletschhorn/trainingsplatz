<?php
namespace DW\Trainingsplatz\Controller;

class EditInitController {

	/**
	* action initializeUpdate
	*
	* @return void
	*/
	public function initializeUpdateAction() {
		if ($this->arguments->hasArgument('user')) {
			$this->arguments->getArgument('user')->getPropertyMappingConfiguration()->allowProperties('txTrainingsplatzSports'); 
			$this->arguments->getArgument('user')->getPropertyMappingConfiguration()->forProperty('txTrainingsplatzSports')->setTypeConverterOption('DW\Trainingsplatz\Property\TypeConverter\BitConverter', null, null);
		}
	}
}
?>