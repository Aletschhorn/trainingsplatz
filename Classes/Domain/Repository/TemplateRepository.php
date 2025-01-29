<?php
namespace DW\Trainingsplatz\Domain\Repository;

class TemplateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	public function findOne(int $sport, int $intensity, bool $guided): \DW\Trainingsplatz\Domain\Model\Template
	{
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