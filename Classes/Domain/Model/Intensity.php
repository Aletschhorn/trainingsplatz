<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class Intensity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	protected $title = '';

	protected $description = '';

	protected $picture = NULL;

	public function getTitle(): string 
	{
		return $this->title;
	}

	public function setTitle(string $title): void 
	{
		$this->title = $title;
	}

	public function getDescription(): string 
	{
		return $this->description;
	}

	public function setDescription(string $description): void 
	{
		$this->description = $description;
	}

	public function getPicture(): \TYPO3\CMS\Extbase\Domain\Model\FileReference 
	{
		return $this->picture;
	}

	public function setPicture(\TYPO3\CMS\Extbase\Domain\Model\FileReference $picture): void 
	{
		$this->picture = $picture;
	}

}