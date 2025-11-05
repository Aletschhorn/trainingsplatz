<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\ViewHelpers;

// Checks bit-wise content of a value

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class BitCheckViewHelper extends AbstractViewHelper {

    protected $escapeOutput = false;

    public function initializeArguments(): void {
        $this->registerArgument('value', 'integer', 'Value to be analyzed', false);
        $this->registerArgument('bit', 'integer', 'Bit value', true);
    }

	public function render(): bool {
		$value = $this->arguments['value'] ?? intval($this->renderChildren());
		$bit = $this->arguments['bit'];
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