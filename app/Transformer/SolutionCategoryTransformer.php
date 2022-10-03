<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\SolutionCategory;
use App\Models\Solution;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class SolutionCategoryTransformer extends TransformerAbstract
{
    public function transform(SolutionCategory $SolutionCategory){

        try{
            $createdDate = Carbon::parse($SolutionCategory->created_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info mr-2 pr-3' href='solutioncategory/edit/".$SolutionCategory->id."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp;";
            $action .= "<a class='delete-modal btn btn-xs btn-danger ' data-id='". $SolutionCategory->id ."' ><i class='fas fa-xs fa-times  '></i></a>";
//            $action .= "<button type='button' class='btn-delete btn btn-xs btn-danger' data-id='". $SolutionCategory.php->id ."'><i class='fas fa-trash'></i></button>";

//            //Check if got any parent
//            if($category->parent_id != null){
//                $temp = Category::find($category->parent_id);
//                $parent = $temp->name;
//            }
//            else{
//                $parent = "-";
//            }

            return[
                'id'              => $SolutionCategory->id,
                'name'              => $SolutionCategory->name,
//                'slug'              => $category->slug,
//                'parent'            => $parent,
//                'meta_title'        => $category->meta_title,
//                'meta_description'  => $category->meta_description,
                'created_at'        => $createdDate,
//                'updated_at'        => $updatedDate,
                'action'            => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}
