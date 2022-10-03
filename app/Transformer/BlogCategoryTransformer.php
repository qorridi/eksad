<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\BlogCategory;
use App\Models\Category;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class BlogCategoryTransformer extends TransformerAbstract
{
    public function transform(BlogCategory $blogCategory){

        try{
            $createdDate = Carbon::parse($blogCategory->created_at)->format('d M Y');
//            $updatedDate = Carbon::parse($blogCategory->updated_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info mr-2 pr-3' href='blogcategory/edit/".$blogCategory->id."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp;";
            $action .= "<a class='delete-modal btn btn-xs btn-danger ' data-id='". $blogCategory->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

//            //Check if got any parent
//            if($category->parent_id != null){
//                $temp = Category::find($category->parent_id);
//                $parent = $temp->name;
//            }
//            else{
//                $parent = "-";
//            }

            return[
                'id'              => $blogCategory->id,
                'name'              => $blogCategory->description,
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
