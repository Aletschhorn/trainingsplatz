<?php
namespace DW\Trainingsplatz\ViewHelpers;

class InArrayViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper {

    public function initializeArguments() {
        $this->registerArgument('needle', 'string', 'Item to be looked for', true);
        $this->registerArgument('haystack', 'mixed', 'Array to be looked in', true);
        parent::initializeArguments();
    }
	
    protected static function evaluateCondition($arguments = NULL) {
		$needle = $arguments['needle'];
		$haystack = $arguments['haystack'];

		if ($needle === NULL) {
			return false;
		}
		if (is_string($haystack)) {
			$haystack = t3lib_div::trimExplode(',', $in, true);
		}
		if (is_object($haystack) and $haystack instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
			$haystack = $haystack->toArray();
		}
        return is_array($haystack) && in_array($needle, $haystack);
    }
}
?>