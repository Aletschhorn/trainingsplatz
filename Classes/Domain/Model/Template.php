<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class Template extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	protected $guided = FALSE;

	protected $title = '';

	protected $templatetext = '';

	protected $intensity = NULL;

	protected $sport = NULL;

	public function getGuided(): bool 
	{
		return $this->guided;
	}

	public function setGuided(bool $guided): void
	{
		$this->guided = $guided;
	}

	public function isGuided(): bool 
	{
		return $this->guided;
	}

	public function getTitle(): string 
	{
		return $this->title;
	}

	public function setTitle(string $title): void 
	{
		$this->title = $title;
	}

	public function getTemplatetext(): string 
	{
		return $this->templatetext;
	}

	public function setTemplatetext(string $templatetext): void
	{
		$this->templatetext = $templatetext;
	}

	public function getIntensity(): \DW\Trainingsplatz\Domain\Model\Intensity 
	{
		return $this->intensity;
	}

	public function setIntensity(\DW\Trainingsplatz\Domain\Model\Intensity $intensity): void 
	{
		$this->intensity = $intensity;
	}

	public function getSport(): \DW\Trainingsplatz\Domain\Model\Sport 
	{
		return $this->sport;
	}

	public function setSport(\DW\Trainingsplatz\Domain\Model\Sport $sport): void 
	{
		$this->sport = $sport;
	}

}