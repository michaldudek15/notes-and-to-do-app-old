<?php
/**
 * * Note controller.
 * */

namespace App\Controller;

use App\Entity\Note;
use App\Repository\NoteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 *Class NoteController.
 */
#[Route('/note')]
class NoteController extends AbstractController
{
    /**
     * Index action.
     *
     * @param NoteRepository $repository Note repository.
     *
     * @return Response HTTP response.
     */
    #[Route(
        name: 'note_index',
        methods: 'GET'
    )]
    public function index(Request $request, NoteRepository $repository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $repository->queryAll(),
            $request->query->getInt('page', 1),
            NoteRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('note/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param  NoteRepository $repository Note repository.
     * @param  integer        $id         Note identifier.
     * @return Response HTTP response.
     */

    #[Route(
        '/{id}',
        name: 'note_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(NoteRepository $repository, int $id): Response
    {
        $note = $repository->findOneById($id);

        return $this->render(
            'note/show.html.twig',
            ['note' => $note]
        );
    }
}