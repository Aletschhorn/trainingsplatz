<?php
namespace DW\Trainingsplatz\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use In2code\Femanager\Domain\Repository\UserRepository;

final class InfomailCommand extends Command
{
    public function __construct(
        private readonly InfomailRepository $infomailRepository
    ) {
        parent::__construct();
    }
	
    /**
     * Configure the command
     */
    protected function configure():void 
	{
		$this->addArgument('limit',InputArgument::OPTIONAL,'Number of e-mails sent per run. Default: 50');
		$this->addArgument('suppress',InputArgument::OPTIONAL,'Boolean. Suppress sending e-mails.');
		$this->addArgument('sendOnlyTo',InputArgument::OPTIONAL,'Only one e-mail per execution is sent to this address');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int 
	{
		$limit = intval($input->getArgument('limit'));
		$suppressMails = intval($input->getArgument('suppress'));
		$sendOnlyTo = $input->getArgument('sendOnlyTo');
		if ($limit == 0) {
			$limit = 50;
		}
		$timezone = new \DateTimeZone('Europe/Zurich');
		$now = new \DateTime('now',$timezone);
		$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
		
		$infomail = $this->infomailRepository->findFutureByStatus(4)->getFirst();
		if ($infomail) {
			$mail = GeneralUtility::makeInstance(FluidEmail::class);
			$mail
				->from(new Address('donotreply@freizeitsportler.ch', 'freizeitsportler.ch'))
				->replyTo(new Address('info@freizeitsportler.ch', 'freizeitsportler.ch'))
				->subject($infomail->getMailSubject())
				->format(FluidEmail::FORMAT_BOTH)
				->embed(fopen('https://freizeitsportler.ch/typo3conf/ext/sitepackage_fsch/Resources/Public/Images/logo_full.svg', 'r'), 'logo')
				->setTemplate('Training')
				->assignMultiple([
					'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="76" />',
					'headline' => $infomail->getMailSubject(),
					'content' => $infomail->getMailBody(),
					'contentHtml' => str_replace(chr(10),'<br />',$infomail->getMailBody()),
					'note' => 'Dies ist eine automatisch erstellte Nachricht. Du erhältst sie, weil du in den Einstellungen deines Profils InfoMails aktiviert hast. Bitte nicht auf diese E-Mail antworten.'
				]);
			$received = $infomail->getSendReceiver();
			$userRepository = GeneralUtility::makeInstance(UserRepository::class);
			$recipients = $userRepository->findInfomailSlice($limit, $received);
			$newReceived = $received + $recipients->count();
			$infomail->setSendReceiver($newReceived);
			$infomail->setStatusDate($now);
			if ($recipients->count() < $limit) {
				// completed
				$infomail->setStatus(1);
			}
			$this->infomailRepository->update($infomail);
			$persistenceManager->persistAll();
			
			$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
			if ($suppressMails or $sendOnlyTo) {
				$counter = count($recipients);
			} else {
				$counter = 0;
				foreach ($recipients as $recipient) {
					if ($recipient->getEmail() and $recipient->getName()) {
						if ($mail->to(new Address($recipient->getEmail(), $recipient->getName()))) {
							if ($mailerInterface->send($mail)) {
								$counter++;
							}
						}
					}
				}
			}
			if ($sendOnlyTo) {
				if ($mail->to(new Address($sendOnlyTo))) {
					$mailerInterface->send($mail);
				}
			}
			
		} else {
			$infomail = $this->infomailRepository->findFutureByStatus(3)->getFirst();
			if ($infomail) {
				$mail = GeneralUtility::makeInstance(FluidEmail::class);
				$mail
					->from(new Address('donotreply@freizeitsportler.ch', 'freizeitsportler.ch'))
					->replyTo(new Address('info@freizeitsportler.ch', 'freizeitsportler.ch'))
					->subject($infomail->getMailSubject())
					->format(FluidEmail::FORMAT_BOTH)
					->embed(fopen('https://freizeitsportler.ch/typo3conf/ext/sitepackage_fsch/Resources/Public/Images/logo_full.svg', 'r'), 'logo')
					->setTemplate('Training')
					->assignMultiple([
						'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="76" />',
						'headline' => $infomail->getMailSubject(),
						'content' => $infomail->getMailBody(),
						'contentHtml' => str_replace(chr(10),'<br />',$infomail->getMailBody()),
						'note' => 'Dies ist eine automatisch erstellte Nachricht. Du erhältst sie, weil du in den Einstellungen deines Profils InfoMails aktiviert hast. Bitte nicht auf diese E-Mail antworten.'
					]);
				$userRepository = GeneralUtility::makeInstance(UserRepository::class);
				$recipients = $userRepository->findInfomailSlice($limit, 0);
				$newReceived = $received + $recipients->count();
				$infomail->setSendReceiver($newReceived);
				$infomail->setStatusDate($now);
				$infomail->setStatus(4);
				if ($recipients->count() < $limit) {
					// completed
					$infomail->setStatus(1);
				}
				$this->infomailRepository->update($infomail);
				$persistenceManager->persistAll();
				
				$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
				if ($suppressMails or $sendOnlyTo) {
					$counter = count($recipients);
				} else {
					$counter = 0;
					foreach ($recipients as $recipient) {
						if ($recipient->getEmail() and $recipient->getName()) {
							if ($mail->to(new Address($recipient->getEmail(), $recipient->getName()))) {
								if ($mailerInterface->send($mail)) {
									$counter++;
								}
							}
						}
					}
				}
				if ($sendOnlyTo) {
					if ($mail->to(new Address($sendOnlyTo))) {
						$mailerInterface->send($mail);
					}
				}
			}
		}
		return Command::SUCCESS;
	}

}