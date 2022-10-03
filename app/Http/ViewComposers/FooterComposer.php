<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class FooterComposer
{

    public $solutions;


    public function __construct(){

        $this->solutions = DB::table('solution_categories')->where('status_id', 1)->skip(0)->take(6)->orderBy('created_at', 'asc')->get();

    }

    public function compose(View $view){
        $data = [
            'solutions' => $this->solutions,
        ];

        $view->with($data);
    }
}
