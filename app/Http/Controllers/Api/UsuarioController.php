<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\UsuarioStoreRequest;
use App\Http\Requests\Usuario\UsuarioUpdateRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index(){
        try {
            $response = [
                'success' => true,
                'data'    => UsuarioResource::collection(Usuario::get()),
                'message' => 'Usuarios obtenidos',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data'    => 'Error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id){
        try {
            $response = [
                'success' => true,
                'data'    => new UsuarioResource(Usuario::find($id)),
                'message' => 'Usuario obtenido',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data'    => 'Error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(UsuarioStoreRequest $request){
        try {
            $Usuario = Usuario::create([ 
                'usu_name' => $request->name,
                'usu_email' => $request->email,
                'usu_password' => Hash::make($request->password),
            ]);
    
            $response = [
                'success' => true,
                'data'    => $Usuario,
                'message' => 'Usuario creado',
            ];
    
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data'    => 'Error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(UsuarioUpdateRequest $request, $id){
        try {
            $Usuario = Usuario::findOrFail($id);
            $Usuario->usu_name = is_null($request->name) ? $Usuario->usu_name : $request->name;
            $Usuario->usu_email = is_null($request->email) ? $Usuario->usu_email : $request->email;
            $Usuario->usu_password = is_null($request->password) ? $Usuario->usu_password : Hash::make($request->password);
            $Usuario->save();
    
            $response = [
                'success' => true,
                'data'    => $Usuario,
                'message' => 'Usuario actualizado.',
            ];
    
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data'    => 'Error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id){
        try {
            if ($id == 1) {
                $response = [
                    'success' => true,
                    'data'    => 'Error',
                    'message' => 'No puede eliminar este usuario',
                ];
                return response()->json($response, 401);
            }
            $Usuario = Usuario::findOrFail($id)->delete();

            $response = [
                'success' => true,
                'data'    => $Usuario,
                'message' => 'Usuario eliminado',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data'    => 'Error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
