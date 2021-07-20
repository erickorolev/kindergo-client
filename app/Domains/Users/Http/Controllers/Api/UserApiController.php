<?php

declare(strict_types=1);

namespace Domains\Users\Http\Controllers\Api;

use Domains\Users\Actions\DeleteUserAction;
use Domains\Users\Actions\GetAllUsersAction;
use Domains\Users\Actions\GetUserByIdAction;
use Domains\Users\Actions\StoreUserAction;
use Domains\Users\Actions\UpdateUserAction;
use Domains\Users\DataTransferObjects\UserData;
use Domains\Users\Http\Requests\Admin\DeleteUserRequest;
use Domains\Users\Http\Requests\Admin\IndexUserRequest;
use Domains\Users\Http\Requests\Admin\ShowUserRequest;
use Domains\Users\Http\Requests\Api\UserStoreApiRequest;
use Domains\Users\Http\Requests\Api\UserUpdateApiRequest;
use Domains\Users\Models\User;
use Domains\Users\Transformers\UserTransformer;
use Domains\Users\ValueObjects\PasswordValueObject;
use Parents\Controllers\Controller;
use Parents\Serializers\JsonApiSerializer;
use Parents\Traits\RelationTrait;
use Symfony\Component\HttpFoundation\Response;

final class UserApiController extends Controller
{
    use RelationTrait;

    protected string $relationClass = GetUserByIdAction::class;

    public function me(): \Illuminate\Http\JsonResponse
    {
        return fractal(
            auth()->user(),
            new UserTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(User::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function index(IndexUserRequest $request, GetAllUsersAction $action): \Illuminate\Http\JsonResponse
    {
        return fractal(
            $action(),
            new UserTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(User::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function store(UserStoreApiRequest $request): \Illuminate\Http\JsonResponse
    {
        $userData = UserData::fromRequest($request, 'data.attributes.');
        if (!$userData->password) {
            $userData->password = PasswordValueObject::generateRandom();
        }
        $user = StoreUserAction::run($userData);
        return fractal(
            $user,
            new UserTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(User::RESOURCE_NAME)
            ->respondJsonApi(Response::HTTP_CREATED, [
                'Location' => route('api.users.show', [
                    'user' => $user->id
                ])
            ]);
    }

    public function show(ShowUserRequest $request, int $user): \Illuminate\Http\JsonResponse
    {
        /** @var User $userModel */
        $userModel = GetUserByIdAction::run($user);
        return fractal(
            $userModel,
            new UserTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(User::RESOURCE_NAME)
            ->respondJsonApi();
    }

    public function update(UserUpdateApiRequest $request, int $user): \Illuminate\Http\JsonResponse
    {
        $userData = UserData::fromRequest($request, 'data.attributes.');
        $userData->id = $user;
        /** @var User $userModel */
        $userModel = UpdateUserAction::run($userData);

        return fractal(
            $userModel,
            new UserTransformer(),
            new JsonApiSerializer($this->getUrl())
        )->withResourceName(User::RESOURCE_NAME)
            ->respondJsonApi(Response::HTTP_ACCEPTED);
    }

    public function destroy(DeleteUserRequest $request, int $user): \Illuminate\Http\Response
    {
        DeleteUserAction::run($user);

        return response()->noContent();
    }
}