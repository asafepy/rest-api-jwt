<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Response;


class CategoryController extends Controller
{
    protected $category = null;

    public function __construct(Category $category)
    {
        return $this->category = $category;
    }

    public function allCategories()
    {    
        return $this->category->allCategories();
    }

    public function getCategory($id)
    {    
        return $this->category->getCategory($id);
    }

    public function saveCategory( Request $request )
    {
        DB::beginTransaction();

        if ($this->category->createOrUpdate($request)) {

            DB::commit();
            return Response::json($this->category, 200);

        } else {

            DB::rollBack();
            return Response::json(['response' => 'Erro ao cadastrar!'], 400);

        }
    }


    public function updateCategory(Request $request, $id)
    {

        $category = $this->category->getCategory($id);
        if(is_null($category)) return Response::json(['response' => 'Curso não encontrado!'], 404);
            
        DB::beginTransaction();

        if( $category->createOrUpdate( $request ) ) {

            DB::commit();
            return Response::json($category, 200);

        } else {

            DB::rollBack();
            return Response::json(['response' => 'Erro ao atualizar!'], 400);

        }

    }

    public function deleteCategory($id)
    {
        if( $this->category->deleteCategory($id) ) return Response::json("Curso deletado com sucesso!", 202);
    }

}
