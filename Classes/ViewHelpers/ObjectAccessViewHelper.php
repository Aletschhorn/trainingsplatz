<?php
namespace DW\Trainingsplatz\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ObjectAccessViewHelper extends AbstractViewHelper {

	use CompileWithRenderStatic;
    protected $escapeOutput = false;

    public function initializeArguments() {
        $this->registerArgument('needle', 'string', 'Item to be looked for', true);
        $this->registerArgument('haystack', 'mixed', 'Array or object to be looked in', true);
        $this->registerArgument('methodPrefix', 'string', 'Method prefix for needle in haystack object', false, NULL);
    }

	public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$haystack = $arguments['haystack'];
		$needle = $arguments['needle'];
		if (is_array($haystack)) {
			if (array_key_exists($needle, $haystack)) {
				return $haystack[$needle];
			} else {
				return NULL;
			}
		} elseif (is_object($haystack)) {
			$methodPrefix = $arguments['methodPrefix'];
			if (isset($haystack->$needle) || property_exists($haystack, $needle)) {
				return $haystack->$needle;
			} elseif (method_exists($haystack, $methodPrefix . $needle)) {
				return $haystack->{$methodPrefix . $needle}();
			}
		} else {
			return NULL;
		}
	}
}
?>