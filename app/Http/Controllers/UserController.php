<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAssignLessonRequest;
use App\Http\Requests\UserAssignSupporterRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRevokeSupporterRequest;
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
     * @return UserResource
     */
    public function revokeLesson(UserAssignLessonRequest $request)
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::find($data['user_id']);
        $user->lessons()->where('lesson_id', $data['lesson_id'])->delete();

        return new UserResource($user->refresh());
    }

    /**
     * Assign supporter to specified user.
     *
     * @param UserAssignSupporterRequest $request
     * @return UserResource
     */
    public function assignSupporter(UserAssignSupporterRequest $request)
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::find($data['user_id']);
        $user->supporter_id = $data['supporter_id'];
        $user->save();

        return new UserResource($user);
    }

    /**
     * Revoke supporter from specified user.
     *
     * @param UserRevokeSupporterRequest $request
     * @return UserResource
     */
    public function revokeSupporter(UserRevokeSupporterRequest $request)
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::find($data['user_id']);
        $user->supporter_id = null;
        $user->save();

        return new UserResource($user);
    }
}
