<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Response;

class CourseController extends Controller
{
    protected $course = null;

    public function __construct(Course $course) {
        return $this->course = $course;
    }

    public function allCourses() {
        return $this->course->allCourses();
    }

    public function getCourse($id) {
        return $this->course->getCourse($id);
    }


    public function saveCourse( Request $request ) {
        DB::beginTransaction();

        if ($this->course->createOrUpdate($request)) {

            DB::commit();
            return Response::json($this->course, 200);

        } else {

            DB::rollBack();
            return Response::json(['response' => 'Erro ao cadastrar!'], 400);
        }
    }


    public function updateCourse(Request $request, $id) {
        $course = $this->course->getCourse($id);
        if(is_null($course)) return Response::json(['response' => 'Curso não encontrado!'], 404);
            
        DB::beginTransaction();

        if( $course->createOrUpdate( $request ) ) {

            DB::commit();
            return Response::json($course, 200);

        } else {

            DB::rollBack();
            return Response::json(['response' => 'Erro ao atualizar!'], 400);

        }

    }

    public function deleteCourse($id) {

        if( $this->course->deleteCourse($id) ) return Response::json("Curso deletado com sucesso!", 202);
        return Response::json("Curso não encontrado", 404);

    }

    public function deleteCouseCategory( $course_id, $category_id ) {

        if( $this->course->deleteCouseCategory( $course_id, $category_id ) ) return Response::json("Categoria removida com sucesso!", 202);
        return Response::json("Categoria não encontrada", 404);
        
    }
}
