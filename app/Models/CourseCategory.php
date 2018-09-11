<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_category';
    protected $fillable = ['course_id', 'category_id'];

    public function course()
    {
    	return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function getCourseCategory($course_id = null, $category_id = null ){
        
        if($course_id == null or $category_id == null) return false;

        $course_category = self::where('course_id', $course_id)->where('category_id', $category_id);
        
        if( $course_category->delete() ) return true;
        
        return false;


    }

    public function createOrUpdate( $request ) 
    {
    	$result = false;

    	if( $this->id == null ) {

	        if ( $this->fill( $request->all() )->save() ) {
	            $result = true;
            } 
            
    	} else {
            if( $this->fill( $request->all() )->save() ) {
            	$result = true;
            }
        }
        
    	return $result;
    }
}
