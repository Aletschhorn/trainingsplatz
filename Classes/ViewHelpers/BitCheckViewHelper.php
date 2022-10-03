<?php
namespace DW\Trainingsplatz\ViewHelpers;

// Checks bit-wise content of a value

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class BitCheckViewHelper extends AbstractViewHelper {

	use CompileWithRenderStatic;
    protected $escapeOutput = false;

    public function initializeArguments() {
        $this->registerArgument('value', 'integer', 'Value to be analyzed', false);
        $this->registerArgument('bit', 'integer', 'Bit value', true);
    }

	public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$value = $arguments['value'] ?? intval($renderChildrenClosure());
		$bit = $arguments['bit'];
		if ($value > 0 && $bit > 0) {
			if ($value & $bit) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

?>