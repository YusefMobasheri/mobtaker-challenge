<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAssignLessonRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserLessonResource;
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
     * @return JsonResponse
     */
    public function index()
    {
        return UserResource::collection(User::where('type', '!=', UserTypeMapper::SUPER_ADMIN)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
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
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $user->delete();
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
        $userLesson = UserLesson::where('user_id', $data['user_id'])
            ->where('lesson_id', $data['lesson_id'])
            ->first();

        if($userLesson)
            $userLesson->delete();

        return new UserResource($userLesson->user);
    }
}
