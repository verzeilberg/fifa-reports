<?php

namespace Result\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Service\defaultService;

/*
 * Entities
 */
use Result\Entity\Result;

class resultService extends defaultService implements resultServiceInterface {

    /**
     * Set the columns for searching
     */
    private $searchColumns = [];
    /**
     * EntityManager for doctrine
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        parent::setEntityManager($entityManager);
        parent::setEntity('Result\Entity\Result');
        parent::setSearchColumns($this->searchColumns);
        $this->entityManager = $entityManager;
    }

    /**
     * Get games result voor specific season
     *
     * @var $seasonId id of that specific season
     *
     * @return array
     */
    public function getResultsBySeason($seasonId) {
        $qb = $this->entityManager->getRepository(Result::class)->createQueryBuilder('r');
        $qb->select('c.id as competitionId, '
                . 'p.id as playerId, '
                . 'p.surName as surName, '
                . 'p.lastNamePrefix as lastNamePrefix, '
                . 'p.lastName as lastName, '
                . 'SUM(r.goals) as totalGoals, '
                . 'SUM(r.goalsAgainst) as totalAgainstGoals, '
                . '(SUM(r.goals) - SUM(r.goalsAgainst)) as targetBalance, '
                . 'COUNT(r.id) as totalGames, '
                . 'SUM(r.points) as totalPoints, '
                . 'SUM(CASE WHEN r.points = 3 THEN 1 ELSE 0 END) AS gamesWon, '
                . 'SUM(CASE WHEN r.points = 0 THEN 1 ELSE 0 END) AS gamesLost, '
                . 'SUM(CASE WHEN r.points = 1 THEN 1 ELSE 0 END) AS gamesDraw '
                );
        $qb->leftJoin('r.season', 's');
        $qb->leftJoin('r.player', 'p');
        $qb->leftJoin('r.competition', 'c');
        $qb->where('s.id = :seasonId');
        $qb->groupBy('r.player');
        $qb->addGroupBy('r.competition');
        $qb->orderBy('totalPoints', 'DESC');
        $qb->addOrderBy('r.player', 'ASC');
        $qb->setParameter('seasonId', $seasonId);
        $query = $qb->getQuery();
        $result = $query->getResult();
        
        $resultsByCompetition = [];
        foreach($result as $index => $result){
            $resultsByCompetition[$result['competitionId']][$result['playerId']] = $result;
        }
        return $resultsByCompetition;
    }

}
