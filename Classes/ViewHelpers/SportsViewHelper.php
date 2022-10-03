<?php
namespace DW\Trainingsplatz\ViewHelpers;

// Lists the sports given in the user record

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class SportsViewHelper extends AbstractViewHelper {

	use CompileWithRenderStatic;
    protected $escapeOutput = false;

    public function initializeArguments() {
        $this->registerArgument('user', 'object', 'User object', true);
        $this->registerArgument('separator', 'string', 'Separator characters in-between sports list', false, ', ');
    }

	public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$userSports = $arguments['user']->getTxTrainingsplatzSports();
		$sports = array ();
		if ($userSports & 1) { $sports[] = 'Joggen'; }
		if ($userSports & 2) { $sports[] = 'Inlineskaten'; }
		if ($userSports & 4) { $sports[] = 'Velofahren'; }
		if ($userSports & 8) { $sports[] = 'Mountainbiken'; }
		if ($userSports & 16) { $sports[] = 'Schwimmen'; }
		return implode ($arguments['separator'], $sports);
	}
}
?>