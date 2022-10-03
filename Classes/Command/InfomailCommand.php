<?php
namespace DW\Trainingsplatz\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use In2code\Femanager\Domain\Repository\UserRepository;

/**
 * InfomailCommandController
 */
class InfomailCommand extends Command {

    /**
     * Configure the command
     */
    protected function configure() {
        $this->setDescription('Send Training InfoMails');
        $this->setHelp('Sends InfoMails for defined trainings to users');
		$this->addArgument('limit',InputArgument::OPTIONAL,'Number of e-mails sent per run. Default: 50');
		$this->addArgument('suppress',InputArgument::OPTIONAL,'Boolean. Suppress sending e-mails.');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

		$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$infomailRepository = $objectManager->get(InfomailRepository::class);
		$userRepository = $objectManager->get(UserRepository::class);
		$limit = intval($input->getArgument('limit'));
		$suppressMails = intval($input->getArgument('suppress'));
		if ($limit == 0) {
			$limit = 50;
		}
		$UTC = new \DateTimeZone('UTC');
		
		$infomail = $infomailRepository->findFutureByStatus(4)->getFirst();
		if ($infomail) {
			$mail = GeneralUtility::makeInstance(MailMessage::class);
			$mail->from(new Address('info@freizeitsportler.ch', 'freizeitsportler.ch'));
			$mail->subject($infomail->getMailSubject());
			$mail->text($infomail->getMailBody());
			$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$infomail->getMailBody()).'</div>');
			$received = $infomail->getSendReceiver();
			$recipients = $userRepository->findInfomailSlice($limit, $received);
			$newReceived = $received + $recipients->count();
			$infomail->setSendReceiver($newReceived);
			if ($recipients->count() < $limit) {
				// completed
				$now = new \DateTime('now',$UTC);
				$infomail->setStatusDate($now);
				$infomail->setStatus(1);
			}
			$infomailRepository->update($infomail);
			$persistenceManager->persistAll();
			
			$counter = 0;
			foreach ($recipients as $recipient) {
				if ($recipient->getEmail() and $recipient->getName()) {
					if ($mail->to(new Address($recipient->getEmail(), $recipient->getName()))) {
						if ($suppressMails) {
							$counter++;
						} else {
							if ($mail->send()) {
								$counter++;
							}
						}
					}
				}
			}
			
		} else {
			$infomail = $infomailRepository->findFutureByStatus(3)->getFirst();
			if ($infomail) {
				$mail = GeneralUtility::makeInstance(MailMessage::class);
				$mail->from(new Address('info@freizeitsportler.ch', 'freizeitsportler.ch'));
				$mail->subject($infomail->getMailSubject());
				$mail->text($infomail->getMailBody());
				$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$infomail->getMailBody()).'</div>');
				$recipients = $userRepository->findInfomailSlice($limit, 0);
				$newReceived = $received + $recipients->count();
				$infomail->setSendReceiver($newReceived);
				$infomail->setStatus(4);
				if ($recipients->count() < $limit) {
					// completed
					$now = new \DateTime('now',$UTC);
					$infomail->setStatusDate($now);
					$infomail->setStatus(1);
				}
				$infomailRepository->update($infomail);
				$persistenceManager->persistAll();
				
				if ($suppressMails) {
					$counter = count($recipients);
				} else {
					$counter = 0;
					foreach ($recipients as $recipient) {
						if ($recipient->getEmail() and $recipient->getName()) {
							if ($mail->to(new Address($recipient->getEmail(), $recipient->getName()))) {
								if ($mail->send()) {
									$counter++;
								}
							}
						}
					}
				}
			}
		}
		return Command::SUCCESS;
	}

}