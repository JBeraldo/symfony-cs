<?php

namespace App\Http\Controller;

use App\Domain\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
}