<?php
namespace DW\Trainingsplatz\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use DW\Trainingsplatz\Domain\Repository\TemplateRepository;

class TrainingDescriptionTemplate implements MiddlewareInterface {
	
	private ?TemplateRepository $templateRepository = NULL;

    public function injectTemplateRepository(TemplateRepository $templateRepository) {
        $this->templateRepository = $templateRepository;
    }

    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {		
		if (!isset($request->getQueryParams()['trainingTemplate'])) {
            return $handler->handle($request);
        }
		
		$success = false;
		$data = $request->getQueryParams()['trainingTemplate'];
		$item = explode('-',$data);
		$template = $this->templateRepository->findOne(intval($item[0]), intval($item[1]), intval($item[2]));
		
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