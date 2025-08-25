<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserReq;
use App\Http\Requests\UpdateUserReq;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResoucer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $currentPage =  $request->get('current_page') ?? 1;
        $regPerPage = 3;

        $skip = ($currentPage - 1) *  $regPerPage;

        $users = User::skip($skip)
        ->take($regPerPage)
        ->orderByDesc('id')
        ->get();

        return response()->json(new UserCollection($users), 200);
    }

    public function store(StoreUserReq $request)
    {
        $data = $request->validated();

        try {
            $users = new User();
            $users->fill($data);
            $users->password = Hash::make(123);
            $users->save($data);

            return response()->json($users, 201);
        } catch (\Exception $ex) {
           return response()->json(
            [
                'message' => 'Falhar ao inserir o usuario!'
            ],400);
        }
    }

    public function show($id)
    {

        try {
            $users = User::findOrFail($id);
            return response()->json(new UserResoucer($users), 200);
        } catch (\Exception $ex) {
           return response()->json(
            [
                'message' => 'Falha ao buscar usuário!'
            ],404);
        }

    }

    public function update(UpdateUserReq $request, $id)
    {
        $data = $request->validated();

        try {
            $users = User::findOrFail($id);

            $users->update($data);

            return response()->json($users, 200);
        } catch (\Exception $ex) {
           return response()->json(
            [
                'message' => 'Falhar ao alterar o usuario!'
            ],400);
        }
    }

    public function destroy($id)
    {
        try {
            $removed = User::destroy($id);
            if (!$removed){
                throw new Exception();
            }
            return response()->json(null, 204);
        } catch (\Exception $ex) {
           return response()->json(
            [
                'message' => 'Falhar ao remover o usuario!'
            ],400);
        }
    }
}
