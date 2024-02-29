<?php
namespace App\Service;

use App\Search\SearchDto;
use App\Search\SearchRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class SearchService
{
    public function search(SearchRepositoryInterface $searchRepository, ?SearchDto $searchDto = null): ArrayCollection {
        $query = $searchRepository->search($searchDto);
        return new ArrayCollection($query->getQuery()->getResult());
    }

    public function searchWithPagination(SearchRepositoryInterface $searchRepository,
                                         PaginatorInterface $paginator, int $page, int $size,
                                         ?SearchDto $searchDto = null): PaginationInterface
    {
        $query = $searchRepository->search($searchDto);
        return $paginator->paginate($query, $page, $size);
    }
}
