<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class Motivation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	protected $title = '';

	public function getTitle(): string 
	{
		return $this->title;
	}

	public function setTitle(string $title): void 
	{
		$this->title = $title;
	}

}