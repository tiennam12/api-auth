<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @OA\GET(
     *     path="/api/users",
     *     tags={"Authentication"},
     *     summary="List all User",
     *     description="List all User Profile",
     *     @OA\Response(response=200, description="Success" ),
     * )
     */
    function listUser() {
        $users = User::all();

        return response()->json($users, 200);
    }
    /**
     * @OA\GET(
     *     path="/api/logs",
     *     tags={"Authentication"},
     *     summary="list all logs",
     *     description="list all logs",
     *     @OA\Response(response=200, description="Success" ),
     * )
     */
    function listLog() {
        $logs = Log::all();

        return response()->json($logs, 200);
    }
    /**
     * @OA\GET(
     *     path="/api/deleteUser/$id",
     *     tags={"Authentication"},
     *     summary="delete user",
     *     description="delete specifi user",
     *     @OA\Response(response=200, description="Success" ),
     * )
     */
    function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json('', 200);
    }
    /**
     * @OA\POST(
     *     path="/api/log",
     *     tags={"Authentication"},
     *     summary="save log when active system",
     *     description="",
     *     @OA\Response(response=200, description="Success" ),
     * )
     */
    function saveLog(Request $request) {
            $params = $request->json()->all();
            $log = new Log;
            $log->name = $params['name'];
            $log->system = $params['system'];
            $log->action = $params['action'];
            $log->save();
            return response()->json('', 200);
    }
}
