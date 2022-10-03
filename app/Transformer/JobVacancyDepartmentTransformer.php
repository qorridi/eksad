<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\JobVacancy;
use App\Models\JobVacancyDepartment;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class JobVacancyDepartmentTransformer extends TransformerAbstract
{
    public function transform(JobVacancyDepartment $department){

        try{
            $createdDate = Carbon::parse($department->created_at)->format('d M Y');
//            $updatedDate = Carbon::parse($blogCategory->updated_at)->format('d M Y');

            $action = "<a class='btn btn-xs btn-info mr-2 pr-3' href='job_vacancy_department/edit/".$department->id."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp;";
            $action .= "<a class='delete-modal btn btn-xs btn-danger ' data-id='". $department->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

//            //Check if got any parent
//            if($category->parent_id != null){
//                $temp = Category::find($category->parent_id);
//                $parent = $temp->name;
//            }
//            else{
//                $parent = "-";
//            }

            return[
                'id'              => $department->id,
                'name'              => $department->description,
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
