<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Permission\AssignPermissionRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request){

        try {

            $user = User::create([
                'id_card_user' => $request->id_card_user,
                'surname_user' => $request->surname_user,
                'name' => $request->name,
                'email' => $request->email,
                'cod_modular_ie' => $request->cod_modular_ie,
                'password' => Hash::make($request->id_card_user),
            ]);

            return ApiResponse::success('Usuario registrado correctamente', 200, $user);

        } catch (ValidationException $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request){

        try {

            // get credentials
            $credentials = $request->only('email', 'password');

            // verify token if credentials is successfully
            $token = Auth::guard('api')->attempt($credentials);

            // verify if exists token
            if (!$token) {
                return ApiResponse::success('Email y/o password inválido', 401, null);
            }

            $user = Auth::guard('api')->user();

            $authorization = [
                'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                ]
            ];

            return ApiResponse::success('Bienvenido al sistema ' . $user->name, 200, $authorization);
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function checkUser(Request $request)
    {
        try {

            $userAuth = $request->userAuthenticated;

            $userAuth['token'] = $request->token;

            return ApiResponse::success('Usuario verificado '.$userAuth->name, 200, $userAuth);

        } catch (ValidationException $e){
            return ApiResponse::error($e->getMessage(),500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }

    public function getUsers()
    {
        try {

            $users = User::with('roles.permissions')->paginate(10);

            return ApiResponse::success('Lista de usuarios del sistema', 200, $users);

        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function getRoles()
    {
        try {

            $roles = Role::get();

            return ApiResponse::success('Lista de roles del sistema', 200, $roles);

        } catch (InternalErrorException $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function getPermissions()
    {
        try {

            $permissions = Permission::get();

            return ApiResponse::success('Lista de permisos del sistema', 200, $permissions);

        } catch (InternalErrorException $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {

            Auth::guard('api')->logout();
            return ApiResponse::success('Sesión cerrada correctamente', 200);

        } catch (InternalErrorException $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }


    public function refresh()
    {
        try {
            return response()->json([
                'status' => 'success',
                'user' => Auth::guard('api')->user(),
                'authorisation' => [
                    'token' => 'test',
                    // 'token' => Auth::guard('api')->refresh(),
                    'type' => 'bearer',
                ]
            ]);
        } catch (ValidationException $e){
            return ApiResponse::error($e->getMessage(),500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function assignUserRole(AssignPermissionRequest $request, $id){

        try {

            $get_roles = $request->input('role');

            $get_permissions = array_map(function($permission) {
                return $permission['name'];
            }, $request->input('permission'));

            $user = User::findOrFail($id);

            // Eliminar todos los roles y permisos existentes del usuario
            $user->syncRoles([]);
            $user->syncPermissions([]);

            foreach ($get_roles as $role_name) {
                $role = Role::where('name', $role_name)->first();
                $role->syncPermissions($get_permissions);
                $user->assignRole($role->id);
            }

            $userWithRolesAndPermissions = User::where('id', $id)->with('roles.permissions')->get();

            return ApiResponse::success('Se asignaron los roles y permisos correctamente al usuario', 200, $userWithRolesAndPermissions);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario con ID '.$id.' no encontrado', 404, $e);
        } catch (ValidationException $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
