<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tryCatch($param, $callback)
    {
        try {
            $results = call_user_func($callback, $param);

            return $this->jsonSuccess($results);
        } catch (Exception $e) {
            Log::info($e);
            return $this->jsonError($e);
        }
    }

    protected function jsonSuccess($data = [], $messages = [])
    {
        $compacts['success'] = true;
        $compacts['messages'] = $messages;
        $compacts['data'] = $data;

        return response()->json($compacts);
    }

    protected function jsonError($messages = [])
    {
        $compacts['success'] = false;
        $compacts['errors'] = $messages;
        $compacts['data'] = [];

        return response()->json($compacts);
    }
}
