<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['pivot'];
    protected $table = 'category';
    protected $fillable = ['name',];

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'course_category', 'category_id', 'course_id');

    }

    public function allCategories(){
        return self::with('courses')->get();
    }

    public function getCategory($id){
        return self::with('courses')->get()->find($id);
    }

    public function createOrUpdate( $request ) {
        
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

    public function deleteCategory($id) {
        return self::find($id)->delete();
    }
}
