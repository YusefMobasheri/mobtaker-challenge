<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolCreateRequest;
use App\Http\Requests\SchoolUpdateRequest;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Illuminate\Http\JsonResponse;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new SchoolResource(School::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolCreateRequest $request)
    {
        $school = School::create($request->validated());

        return new SchoolResource($school);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return new SchoolResource($school);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolUpdateRequest $request, int $id)
    {
        $school = School::findOrFail($id);
        $school->update($request->validated());

        return new SchoolResource($school);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        return $school->delete();
    }
}
