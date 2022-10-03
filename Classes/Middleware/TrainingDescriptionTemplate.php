<?php
namespace DW\Trainingsplatz\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use DW\Trainingsplatz\Domain\Repository\TemplateRepository;

class TrainingDescriptionTemplate implements MiddlewareInterface {
	 /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {		
		if (!isset($request->getQueryParams()['trainingTemplate'])) {
            return $handler->handle($request);
        }
		
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$templateRepository = $objectManager->get(TemplateRepository::class);

		$success = false;
		$data = $request->getQueryParams()['trainingTemplate'];
		$item = explode('-',$data);
		$template = $templateRepository->findOne(intval($item[0]), intval($item[1]), intval($item[2]));
		
		$body = new Stream('php://temp', 'rw');
		if ($template) {
	        $body->write($template->getTemplatetext());
		} else {
	        $body->write('');
		}
		return (new Response())
                ->withHeader('content-type', 'text/plain; charset=utf-8')
                ->withBody($body)
                ->withStatus(200);
	}
}

?>