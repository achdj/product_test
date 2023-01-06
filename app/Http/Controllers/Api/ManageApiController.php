<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\GenerateToken;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ManageApiController extends Controller
{

    /**
     * Login
     * @OA\Post (
     *     path="/api/login",
     *     tags={"Auth"},
     *     operationId="Login",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="password",
     *         in="query",
     *   *      required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example="1"),
     *              @OA\Property(property="firstname", type="string", example="Luc"),
     *              @OA\Property(property="lastname", type="string", example="DuPont"),
     *              @OA\Property(property="email", type="string", example="luc@test.com"),
     *              @OA\Property(property="email_verified_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="password", type="string", example="$Ay102$4T9EWGTDEBuncdLsxqpuG.jvL11o2GMWB.IUxuAdqq6JFT5Qsrq"),
     *              @OA\Property(property="remember_token", type="string", example=""),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="token", type="string", example="Wdf325dfsdwfcsdwfcd@sdwf/|sdfsdwfksjwdnk,n"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="message1", type="string", example="This email does not correspond to any user"),
     *              @OA\Property(property="message2", type="string", example="This email does not correspond to any user with this password"),
     *          ),
     *      )
     * )
    */

    public function login(Request $request){
        $user_connect = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "string", "min:8"]
        ]);

        $user = User::where("email", $user_connect["email"])->first();
        if(!$user) return response(["message" => "This email does not correspond to any user"], 401);
        if(!Hash::check($user_connect["password"], $user->password)){
            return response(["message" => "This email does not correspond to any user with this password"], 401);
        }
        Auth::login($user);
        $tok = GenerateToken::generateLoginToken();
        $token = $user->createToken("$tok")->plainTextToken;
        return response([
            "user" => $user,
            "token" => $token
        ], 200);
    }

    /**
     * Logout
     * @OA\Get (
     *     path="/api/logout",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="Disconnection to perform"),
     *          )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status",
     *     ),
     * )
    */
    public function logout(Request $request){
        if(!(auth('sanctum')->check())){
            return response(["message" => "Authorization required"], 404);
        }
        $user = auth('sanctum')->user();
        $user->tokens()->delete();
        return response(["message" => "Deconnexion effectuer"], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get Product list",
     *     operationId="findPetsByStatus",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Jessica"),
     *              @OA\Property(property="description", type="string", example="The best product"),
     *              @OA\Property(property="price", type="string", example=1500),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *         )
     *
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status"
     *     ),
    * )
    */

    public function getProduct(Request $request) {
        if(!(auth('sanctum')->check())){
            return response(["message" => "Authorization required"], 404);
        }
        else {
            $l = Product::get();
            if(count($l) <= 0) {
                return response(["message" => "No products available"], 200);
            }
            return $l;
        }

    }

    /**
     * @OA\Get(
     *     path="/api/product_variants",
     *     tags={"Products"},
     *     summary="Get Product variant list",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Boy Brow"),
     *              @OA\Property(property="price", type="string", example=250),
     *              @OA\Property(property="product", type="string", example= {
     *                      "id": 1,
     *                      "name": "Jessica",
     *                      "description": "The best product",
     *                      "price": 1500
     *                  }
     *              ),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status"
     *     ),
    * )
    */

    public function getProductVariant(Request $request) {
        if(!(auth('sanctum')->check())){
            return response(["message" => "Authorization required"], 404);
        }
        else {
            $l = ProductVariant::get();
            if(count($l) <= 0) {
                return response(["message" => "No product variant available"], 200);
            }
            return $l;
        }

    }
}
