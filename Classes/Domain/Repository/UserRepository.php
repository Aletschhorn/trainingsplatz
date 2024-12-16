<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Repository;

class UserRepository extends \In2code\Femanager\Domain\Repository\UserRepository {
	
    /**
     * Find FE_Users by their group
     *
     * @param int $uid fe_groups UID
     * @return QueryResult
     */
    public function findByUsergroup($uid) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->contains('usergroup', $uid));
		$query->setOrderings(array('name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        return $query->execute();
    }

     /**
     * findInfomail
     *
     * @return QueryResult
     */
    public function findInfomail() {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('txTrainingsplatzInfomail', 1));
        return $query->execute();
    }

     /**
     * findInfomailSlice
     *
     * @param int $limit Limit
     * @param int $offset Offset
     * @return QueryResult
     */
    public function findInfomailSlice($limit = 100, $offset = 0) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('txTrainingsplatzInfomail', 1));
		if ($offset > 0) {
			$query->setOffset($offset);
		}
        return $query->setLimit($limit)->execute();
    }

    /**
     * Find users with contest extra points
     *
     * @return QueryResult
     */
    public function findContestExtraPoints() {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->greaterThan('txTrainingsplatzContestExtra', 0));
        return $query->execute();
    }

    /**
     * Find users having birthday today + n days
     *
     * @param int $offset
	 * @param array $usergroups
     * @return QueryResult
     */
    public function findBirthdayToday($offset = 0, $usergroups = array()) {
		date_default_timezone_set('Europe/Berlin');
		$date = new \DateTime ('+'.intval($offset).' days');
		
		$allUsers = parent::findAll();
		
		$result = array ();
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