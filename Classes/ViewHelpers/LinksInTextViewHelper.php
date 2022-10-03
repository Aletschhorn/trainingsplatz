<?php
namespace DW\Trainingsplatz\ViewHelpers;

// Finds links in a text and makes them clickable

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class LinksInTextViewHelper extends AbstractViewHelper {

    protected $escapeOutput = false;

    public function initializeArguments() {
        $this->registerArgument('text', 'string', 'Text with links', false, NULL);
    }

	public static function renderStatic (array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$text = $arguments['text'] ?? $renderChildrenClosure();
		$url_pattern = '/(((http|https)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\:[0-9]+)?(\/\S*)?/';
    	$output = preg_replace_callback ($url_pattern,
			function($matches) {
				$match = $matches[0];
				if (strstr($match, ":") === false) {
					$url = "https://$match";
				} else {
					$url = $match;
				}
				return '<a href="' . $url .'" target="_blank">' . $url . '</a>';
      		},
			$text);
		return $output;
	}
	
}

?>