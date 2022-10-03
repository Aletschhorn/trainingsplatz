<?php
namespace DW\Trainingsplatz\ViewHelpers;

// Transforms stores route to string for drawing route on Google Maps

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CoordinatesViewHelper extends AbstractViewHelper {

	use CompileWithRenderStatic;
    protected $escapeOutput = false;

    public function initializeArguments() {
        $this->registerArgument('map', 'object', 'Map object', true);
    }

	public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$coordinates = explode(';', $arguments['map']->getRoute());
		foreach ($coordinates as $key => $value) {
			$coordinates[$key] = 'new google.maps.LatLng'.$value;
		}
		return implode(', ',$coordinates);
	}
}

?>