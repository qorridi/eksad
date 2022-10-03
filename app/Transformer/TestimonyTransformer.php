<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 13/02/2018
 * Time: 11:34
 */

namespace App\Transformer;


use App\Models\AdminUser;
use App\Models\Testimonial;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class TestimonyTransformer extends TransformerAbstract
{
    public function transform(Testimonial $testimony){

        try{
            $urlShowService = route('admin.testimony.show', ['id' => $testimony->id]);
            $urlEditService = route('admin.testimony.edit', ['id' => $testimony->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowService."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>&nbsp";
            $action .= "<a class='btn btn-xs btn-success' href='". $urlEditService."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-edit'></i></a>&nbsp";
            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $testimony->id ."' ><i class='fas fa-trash'></i></a>";

            return[
                'name'             => $testimony->name,
                'company_name'     => $testimony->company_name,
                'image_path'       => $testimony->image_path,
                'image_path_2'       => $testimony->image_path_2,
                'description'      => $testimony->description,
                'status'           => $testimony->status_id == 1 ? "ACTIVE" : "NONACTIVE",
                'action'           => $action
            ];
        }
        catch (\Exception $exception){
            error_log($exception);
        }
    }
}
