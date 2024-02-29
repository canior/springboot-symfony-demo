<?php
namespace App\Controller;


use App\Dto\AccountSearchDto;
use App\Search\SearchRepositoryInterface;
use App\Service\SearchService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AccountController extends AbstractController
{
    private SearchRepositoryInterface $searchRepository;
    private SearchService $searchService;
    private SerializerInterface $serializer;

    /**
     * @param SearchRepositoryInterface $searchRepository
     * @param SearchService $searchService
     * @param SerializerInterface $serializer
     */
    public function __construct(SearchRepositoryInterface $searchRepository, SearchService $searchService, SerializerInterface $serializer)
    {
        $this->searchRepository = $searchRepository;
        $this->searchService = $searchService;
        $this->serializer = $serializer;
    }

    #[Route('/account', name: 'account')]
    public function search(#[MapQueryString] ?AccountSearchDto $accountSearchDto = null): JsonResponse
    {
        $accounts = $this->searchService->search($this->searchRepository, $accountSearchDto);
        $data = $this->serializer->serialize($accounts, 'json', ['groups' => 'account']);
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/account/pagination', name: 'account_pagination')]
    public function searchWithPagination(Request $request,
                                         PaginatorInterface $paginator,
                                         #[MapQueryString] ?AccountSearchDto $accountSearchDto = null): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $size = $request->query->getInt('size', 10);
        $accounts = $this->searchService->searchWithPagination($this->searchRepository, $paginator, $page,
            $size, $accountSearchDto);
        $data = $this->serializer->serialize($accounts, 'json', ['groups' => 'account']);
        return new JsonResponse($data, 200, [], true);
    }
}
