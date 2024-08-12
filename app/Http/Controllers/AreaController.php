<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\CreateAreaRequest;
use App\Http\Requests\InstitutionTeacher\ParamInstitutionTeacherRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use Dotenv\Exception\ValidationException;
use Exception;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        try{
            $areas = Area::where('status', 1)
            ->paginate(10);
            return ApiResponse::success('Lista de areas registras', 200, $areas);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function get_areas_with_teacher_and_class_unit(ParamInstitutionTeacherRequest $request):JsonResponse
    {
        try{
            $id_ie_teacher = $request->id_ie_teacher;
            $id_unit = $request->id_unit;
            $year = date('Y');

            if($id_unit && $id_ie_teacher) {
                $areas = Area::where('status', 1)
                    ->whereHas('teacher_area', function($query) use ($id_ie_teacher, $year) {
                        $query->where('id_ie_teacher', $id_ie_teacher)
                            ->whereYear('created_at', $year);
                    })
                    ->with([
                        'teacher_area' => function($query) use ($id_ie_teacher, $year, $id_unit) {
                            $query->where('id_ie_teacher', $id_ie_teacher)
                                ->whereYear('created_at', $year)
                                ->with(['class_unit' => function($query) use ($id_unit) {
                                    $query->where('id_unit', $id_unit);
                                }]);
                        },
                        'teacher_area.grade',
                        'teacher_area.section',
                        'teacher_area.institution_teacher.teacher',
                    ])
                    ->paginate(10);

            }else {

                $areas = Area::where('status', 1)
                ->whereHas('teacher_area', function($query) use ($year) {
                    $query->whereYear('created_at', $year);
                })
                ->with([
                    'teacher_area' => function($query) use ($year, $id_unit) {
                        $query->whereYear('created_at', $year)
                            ->with(['class_unit' => function($query) use ($id_unit) {
                                $query->where('id_unit', $id_unit);
                            }]);
                    },
                    'teacher_area.grade',
                    'teacher_area.section',
                    'teacher_area.institution_teacher.teacher',
                ])
                ->paginate(10);
            }

            return ApiResponse::success('Lista de aréas con docentes', 200, $areas);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAreaRequest $request)
    {
        try{
            $area = Area::create($request->all());
            return ApiResponse::success('Nueva área registrada correctamente', 201, $area);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
