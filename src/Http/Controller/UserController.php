<?php

namespace App\Http\Controller;

use App\Domain\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(private UserService $service)
    {
    }
    #[Route('/usuario', name: 'user_current', methods: ['GET'])]
    public function currentUser(Request $request)
    {
        $user = $this->service->currentUser();

        return $this->json($user);
    }
    #[Route('/usuario', name: 'user_delete', methods: ['DELETE'])]
    public function destroy(Request $request)
    {
        $user = $this->service->destroy();

        return new JsonResponse(["message"=>"usuário excluído"],Response::HTTP_OK);
    }
}