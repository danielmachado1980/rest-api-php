<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(title="Next SI - API", version="1.0")
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Autenticação via JWT",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth",
 * )
 */
abstract class Controller
{
    //
}
