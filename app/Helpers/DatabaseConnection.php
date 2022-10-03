<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DatabaseConnection
{
    public static function setConnection($params)
    {
        config(['database.connections.onthefly' => [
            'driver'    => $params->db_type,
            'host'      => $params->db_connection,
            'username'  => $params->db_user,
            'password'  => $params->db_pass,
            'port'      => $params->db_port,
            'database'  => $params->db_name
        ]]);

        return DB::connection('onthefly');
    }
}
