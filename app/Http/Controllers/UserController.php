<?php

namespace App\Http\Controllers;

use App\DTO\DeleteUserDTO;
use App\DTO\GetUserDTO;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $dto = $request->dto();

        $result = $this->userService->add($dto);

        return UserResource::make($result)
            ->response(request: $request)
            ->setStatusCode(code: 200);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $dto = GetUserDTO::fromArray(['user' => Auth::user()]);

        $result = $this->userService->get($dto);

        return UserResource::make($result)
            ->response()
            ->setStatusCode(code: 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $dto = $request->dto();

        $result = $this->userService->update($dto);

        return response()->json(['result' => $result],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        $dto = DeleteUserDTO::fromArray(['user' => Auth::user()]);

        $result = $this->userService->delete($dto);

        return response()->json(['result' => $result],200);
    }
}
