<?php

declare(strict_types = 1);

namespace App\Http\Controller;

use App\Domain\Service\UserService;
use App\Framework\Resolver\RequestPayloadValueResolver;
use App\Http\Request\User\UpdateUserRequest;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $service,
        private readonly CacheInterface $loginCache,
        private readonly TokenExtractorInterface $tokenExtractor
    )
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
        $this->service->destroy();

        return $this->json(["message"=>"usuário excluído"]);
    }

    #[Route('/usuario', name: 'update',methods: ['PUT'], format: 'json')]
    public function update(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] UpdateUserRequest $userDTO): Response
    {
        $this->service->update($userDTO);
        return $this->json(["mensagem" => "Usuário atualizado com sucesso"], Response::HTTP_OK);
    }

    #[Route('/logout', name: 'user_logout', methods: ['POST'])]
    public function logout(Request $request)
    {
        $token = ($this->tokenExtractor->extract($request));

        $this->loginCache->delete($token);
        return new JsonResponse(["mensagem"=>"Deslogado com sucesso"],Response::HTTP_OK);
    }
}