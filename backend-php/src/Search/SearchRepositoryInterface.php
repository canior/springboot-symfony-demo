<?php
namespace App\Search;

use Doctrine\ORM\QueryBuilder;

interface SearchRepositoryInterface
{
    public function search(?SearchDto $searchDto = null): QueryBuilder;
}
