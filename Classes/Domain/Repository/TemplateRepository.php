<?php
namespace DW\Trainingsplatz\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Templates
 */
class TemplateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* findOne
	*
    * @param int $sports
    * @param int $intensity
    * @param boolean $guided
	* @return
	*/
	public function findOne ($sport, $intensity, $guided) {

		$query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
		$constraints = [
			$query->equals('sport',$sport),
			$query->equals('intensity',$intensity),
			$query->equals('guided',$guided)
		];
		return $query->matching($query->logicalAnd($constraints))->execute()->getFirst();
	}

}