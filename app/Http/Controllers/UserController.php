<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAssignLessonRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Mappers\UserTypeMapper;
use App\Models\User;
use App\Models\UserLesson;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::where('type', '!=', UserTypeMapper::SUPER_ADMIN)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return UserResource
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        return response()->json(['data' => $user->delete()]);
    }

    /**
     * Assign lesson to specified user.
     *
     * @param UserAssignLessonRequest $request
     * @return UserResource
     */
    public function assignLesson(UserAssignLessonRequest $request)
    {
        $data = $request->validated();
        $userLesson = UserLesson::create($data);

        return new UserResource($userLesson->user);
    }

    /**
     * Revoke lesson from specified user.
     *
     * @param UserAssignLessonRequest $request
     * @return JsonResponse
     */
    public function revokeLesson(UserAssignLessonRequest $request)
    {
        $data = $request->validated();
        $userLesson = UserLesson::where('user_id', $data['user_id'])
            ->where('lesson_id', $data['lesson_id'])
            ->delete();

        return response()->json(['data' => $userLesson]);
    }
}
