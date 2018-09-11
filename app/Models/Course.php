<?php

namespace App\Models;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;


class Course extends Model
{
    protected $hidden = ['pivot'];
    protected $table = 'course';
    protected $fillable = ['name',];

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'course_category', 'course_id', 'category_id');

    }

    public function allCourses() {
        return self::with('categories')->paginate(5);
    }

    public function getCourse( $course_id ) {
        return self::with('categories')->get()->find( $course_id );
    }

    public function createOrUpdate( $request ) {
    	$result = false;

    	if( $this->id == null ) {

	        if ( $this->fill( $request->all() )->save() ) {

                $request['course_id'] = $this->id;
                $course_category = new CourseCategory();

                if( !$course_category->createOrUpdate($request) ) $result = false;

                $result = true;
            } 
            
    	} else {

            if( $this->fill( $request->all() )->save() ) {
                $result = true;
            }
        }
        
    	return $result;
    }

    public function deleteCourse($id) {
        try {
            return self::find($id)->delete();
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
        
    }

    public function deleteCouseCategory($course_id, $category_id) {   
        
        $course_category = CourseCategory::where('course_id', $course_id)
        ->where('category_id', $category_id);

        if( is_null($course_category) ) return false;
        if( $course_category->delete() ) return true;
    }

}
