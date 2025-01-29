<?php
namespace DW\Trainingsplatz\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class UserRepository extends \In2code\Femanager\Domain\Repository\UserRepository {
	
    public function findByUsergroup(int $uid): QueryResultInterface 
	{
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->contains('usergroup', $uid));
		$query->setOrderings(array('name' => QueryInterface::ORDER_ASCENDING));
        return $query->execute();
    }

    public function findInfomail(): QueryResultInterface 
	{
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('txTrainingsplatzInfomail', 1));
        return $query->execute();
    }

    public function findInfomailSlice(int $limit = 100, int $offset = 0): QueryResultInterface 
	{
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('txTrainingsplatzInfomail', 1));
		if ($offset > 0) {
			$query->setOffset($offset);
		}
        return $query->setLimit($limit)->execute();
    }

    public function findContestExtraPoints(): QueryResultInterface 
	{
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->greaterThan('txTrainingsplatzContestExtra', 0));
        return $query->execute();
    }

    public function findBirthdayToday(int $offset = 0, array $usergroups = []): QueryResultInterface 
	{
		date_default_timezone_set('Europe/Berlin');
		$date = new \DateTime ('+'.intval($offset).' days');
		
		$allUsers = parent::findAll();
		
		$result = [];
		foreach ($allUsers as $key => $user) {
			$currentgroups = array();
			foreach ($user->getUsergroup() as $group) {
				$currentgroups[] = $group->getUid();
			}
			if ($user->getDateOfBirth() and array_intersect($usergroups, $currentgroups)) {
				if ($user->getDateOfBirth()->format('md') == $date->format('md')) {
					$result[] = $user;
				}
			}
		}
		return $result;
    }

}