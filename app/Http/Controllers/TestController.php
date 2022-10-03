<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseConnection;
use App\Models\Company;

class TestController extends Controller
{
    public function getTableStructure($companyCode, $tableName){
        try {
//            phpinfo();
            $tmpCompany = Company::where('code', $companyCode)->first();
            $dbConn = DatabaseConnection::setConnection($tmpCompany);

            $table = $dbConn->table($tableName)
                ->first();

            dd($table);
        }
        catch (\Exception $ex){
            dd($ex);
        }
    }
}
