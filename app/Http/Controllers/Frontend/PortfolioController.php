<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioSolution;
use App\Models\Solution;
use App\Models\SolutionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index(Request $request){
        try{
            $portfolios = DB::table('portfolios')
                ->where('status_id', 1);
            $relatedPortfolios = DB::table('portfolios')
                ->where('status_id', 1)
                ->inRandomOrder()
                ->limit(4)
                ->get();
            $latestPortfolios = DB::table('portfolios')
                ->where('status_id', 1)
                ->latest()
                ->limit(2)
                ->get();

            $filterKeyword = '';
            if($request->keyword !== null){
                $filterKeyword = $request->keyword;
                $portfolios = $portfolios->where('description', 'LIKE', '%'. $filterKeyword. '%');
            }

            $portfolios = $portfolios->paginate(6);
            if(str_contains($request->keyword, '%')){
                $portfolios = [];
            }

            $solutionCategories = SolutionCategory::with('solutions')->where('status_id', 1)->get();
            $solutionId = 0;
            if($request->exists('filter')){
                $solutionId = $request->query('filter');
                $relations = PortfolioSolution::where('solution_id', $solutionId)->get();
                $portfolios = [];
                foreach ($relations as $link){
                    $tmp = DB::table('portfolios')->where('id', $link->portfolio_id)->first();
                    array_push($portfolios, $tmp);
                }
            }

            return view('frontend.portfolio', [
                'portfolios'        => $portfolios,
                'filterKeyword'     => $filterKeyword,
                'relatedPortfolios' => $relatedPortfolios,
                'latestPortfolios'  => $latestPortfolios,
                'solutionCategories' => $solutionCategories,
                'active_filter_id'  => $solutionId
            ]);
        }
        catch (\Exception $ex){
            return $ex;
        }
    }

    public function show($id){
        $portfolio = Portfolio::find($id);
        if(empty($portfolio)){
            return redirect()->back();
        }

        if(empty($portfolio)){
            return 'BAD REQUEST';
        }

        $relatedPortfolios = DB::table('portfolios')
            ->where('status_id', 1)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $solution = DB::table('solutions');
        return view('frontend.portfolio-detail', [
            'portfolio' => $portfolio,
            'relatedPortfolios' => $relatedPortfolios,
            'solution' => $solution,
        ]);
    }
}
