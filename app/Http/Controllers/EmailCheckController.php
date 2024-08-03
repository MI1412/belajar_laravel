<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class EmailCheckController extends Controller
{
/**
* Check if the email exists in the users table.
*
* @param string $email
* @return JsonResponse
*/
public function check(string $email): JsonResponse
{
$exists = DB::table('users')->where('email', $email)->exists();

return response()->json(['exists' => $exists]);
}
}