<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Product test Api",
 *      description="Product test api documentation by Achille DJ",
 *      @OA\Contact(
 *          email="achilledjegnon@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Product test api 1.0",
 *         url=""
 *     )
 * )
 * 
 *
* @OA\Server(
*      url="",
*      description="Demo API Server"
* )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
