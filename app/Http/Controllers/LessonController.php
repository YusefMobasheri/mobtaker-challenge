<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonCreateRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new LessonResource(Lesson::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LessonCreateRequest $request)
    {
        $lesson = Lesson::create($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(LessonUpdateRequest $request, int $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        return $lesson->delete();
    }
}
