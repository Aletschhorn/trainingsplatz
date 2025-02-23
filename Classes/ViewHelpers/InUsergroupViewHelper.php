<?php
namespace DW\Trainingsplatz\ViewHelpers;

class InUsergroupViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper {

	public function initializeArguments() {
		$this->registerArgument('role', 'string', 'Usergroup (either the usergroup uid or its title)');
		$this->registerArgument('user', '\DW\Trainingsplatz\Domain\Model\User', 'Frontend user');
	}
	
	protected static function evaluateCondition($arguments = null) {
		$role = $arguments['role'];
		$feuser = $arguments['user'];

		$groups = $feuser->getUsergroup();
		$groupId = array();
		$groupTitle = array();
		self::getGroups($groups, $groupId, $groupTitle);

		if (is_numeric($role)) {
			return in_array($role, $groupId);
		} else {
			return in_array($role, $groupTitle);
		}
	}
   
	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $groups Array of usergroups
	 * @param array $groupId
	 * @param array $groupTitle
	 * @return
	 */
	protected static function getGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $groups, &$groupId, &$groupTitle) {
		foreach ($groups as $group) {
			$groupId[] = $group->getUid();
			$groupTitle[] = $group->getTitle();
			$subgroups = $group->getSubgroup();
			if ($subgroups) {
				self::getGroups($subgroups, $groupId, $groupTitle);
			}
		}
		return true;
	}
}

?>