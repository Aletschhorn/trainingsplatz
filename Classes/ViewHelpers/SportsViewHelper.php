<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\ViewHelpers;

// Lists the sports given in the user record

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class SportsViewHelper extends AbstractViewHelper {

    protected $escapeOutput = false;

    public function initializeArguments(): void {
        $this->registerArgument('user', 'object', 'User object', true);
        $this->registerArgument('separator', 'string', 'Separator characters in-between sports list', false, ', ');
    }

	public function render(): string {
		$userSports = $this->arguments['user']->getTxTrainingsplatzSports();
		$sports = array ();
		if ($userSports & 1) { $sports[] = 'Joggen'; }
		if ($userSports & 2) { $sports[] = 'Inlineskaten'; }
		if ($userSports & 4) { $sports[] = 'Velofahren'; }
		if ($userSports & 8) { $sports[] = 'Mountainbiken'; }
		if ($userSports & 16) { $sports[] = 'Schwimmen'; }
		return implode ($this->arguments['separator'], $sports);
	}
}
?>