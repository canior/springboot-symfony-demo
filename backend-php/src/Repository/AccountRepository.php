<?php
namespace App\Repository;

use App\Dto\AccountSearchDto;
use App\Entity\Account;
use App\Search\SearchDto;
use App\Search\SearchRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class AccountRepository implements AccountRepositoryInterface, SearchRepositoryInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function search(AccountSearchDto|SearchDto|null $searchDto = null): QueryBuilder
    {
        $query = $this->entityManager->createQueryBuilder();

        $query->select('a')
            ->from(Account::class, 'a')
            ->leftJoin('a.contacts', 'c')
            ->distinct();

        if (!is_null($searchDto)) {
            if (!is_null($searchDto->getUnassigned())) {
                if ($searchDto->getUnassigned()) {
                    $query->andWhere('c.id IS NULL');
                } else {
                    $query->andWhere('c.id IS NOT NULL');
                }
            }

            if ($searchDto->query) {
                $query->andWhere('c.phoneNumber = :phoneNumber')
                    ->setParameter('phoneNumber', $searchDto->query);
            }
        }

        $query->orderBy('a.id', 'ASC');

        return $query;
    }
}
