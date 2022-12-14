<?php
namespace DW\Trainingsplatz\ViewHelpers;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\ViewHelpers\Form\HiddenViewHelper as OriginalHiddenViewHelper;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Daniel Widmer
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
 * Class TextfieldViewHelper
 *
 * @package In2code\Femanager\ViewHelpers\Form
 */
class HiddenViewHelper extends OriginalHiddenViewHelper
{

    /**
     * Get the value of this form element (changed to prefill from TypoScript)
     * Either returns arguments['value'], or the correct value for Object Access.
     *
     * @return mixed Value
     */
    protected function getValue($convertObjects = true)
    {
        $value = parent::getValue($convertObjects);

        // prefill value from TypoScript
        if (empty($value) && $this->getValueFromTypoScript()) {
            $value = $this->getValueFromTypoScript();
        }

        return $value;
    }

    /**
     * Read value from TypoScript
     *
     * @return string Value from TypoScript
     */
    protected function getValueFromTypoScript()
    {
        $controllerName = strtolower($this->renderingContext->getRequest()->getControllerName());
        $contentObject = $this->configurationManager->getContentObjectRenderer();
        $typoScript = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );
        $prefillTypoScript = $typoScript['plugin.']['tx_femanager.']['settings.'][$controllerName . '.']['prefill.'];
        $value = $contentObject->cObjGetSingle(
            $prefillTypoScript[$this->arguments['property']],
            $prefillTypoScript[$this->arguments['property'] . '.']
        );
        return $value;
    }
}
