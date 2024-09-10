<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="User",
 *     required={"name", "email", "password", "document", "profile"},
 *     @OA\Property(property="id", type="integer", readOnly="true"),
 *     @OA\Property(property="name", type="string", description="Nome do usuário"),
 *     @OA\Property(property="email", type="string", format="email", description="Email do usuário"),
 *     @OA\Property(property="password", type="string", description="Senha do usuário"),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly="true"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly="true"),
 *     @OA\Property(property="document", type="string", description="Documento do usuário"),
 *     @OA\Property(property="phone_number", type="string", description="Telefone do usuário 9999-9999 ou (99)9999-9999 ou (99) 9999-9999"),
 *     @OA\Property(property="profile", type="string", description="Perfil do usuário (R=Regular / A=Admin)")
 * )
 */
class UserController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Listar todos os usuários",
     *     description="Retorna uma lista de todos os usuários",
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     ),
     *     @OA\Response(response=401, description="Não autorizado")
     * )
     */
    public function index()
    {
        return User::all();
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Criar um novo usuário",
     *     description="Cria um novo usuário no sistema",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response=201, description="Usuário criado"),
     *     @OA\Response(response=401, description="Não autorizado"),
     *     @OA\Response(response=403, description="Não autorizado"),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erros de validação."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(ValidateRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        return response()->json($user, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obter um usuário",
     *     description="Retorna as informações de um usuário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do usuário",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Sucesso"),
     *     @OA\Response(response=404, description="Usuário não encontrado"),
     *     @OA\Response(response=401, description="Não autorizado")
     * )
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Atualizar um usuário",
     *     description="Atualiza as informações de um usuário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do usuário",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response=200, description="Usuário atualizado"),
     *     @OA\Response(response=404, description="Usuário não encontrado"),
     *     @OA\Response(response=401, description="Não autorizado"),
     *     @OA\Response(response=403, description="Não autorizado"),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erros de validação."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function update(ValidateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return response()->json($user, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Deletar um usuário",
     *     description="Deleta um usuário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do usuário",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=403, description="Não autorizado"),
     *     @OA\Response(response=204, description="Usuário deletado"),
     *     @OA\Response(response=404, description="Usuário não encontrado"),
     *     @OA\Response(response=401, description="Não autorizado")
     * )
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
