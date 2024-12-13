<?php
namespace DW\Trainingsplatz\Property\TypeConverter;

class BitConverter extends \TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter {
	protected $sourceTypes = array('array','integer');
	protected $targetType = 'integer';
	protected $priority = 100;

	public function convertFrom($source, $targetType, array $convertedChildProperties = array(), \TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface $configuration = null) {
		$sum = 0;
		if (is_array($source)) {
			foreach ($source as $key => $value) {
				$sum += intval($value);
			}
		} else {
			$sum = intval($source);
		}
		return $sum;
	}
}