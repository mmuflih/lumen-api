<?php

/**
 * Created by Muhammad Muflih Kholidin
 * https://github.com/mmuflih
 * muflic.24@gmail.com
 * at: 25/03/20 10.51
 **/

namespace App\Http\Controllers;

use App\Core\Handlers\AddUserHandler;
use App\Core\Handlers\DeleteUserHandler;
use App\Core\Handlers\EditUserHandler;
use App\Core\Readers\GetUserReader;
use App\Core\Readers\GetUsersReader;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Validator;

class UserController extends ApiController
{
    public function add(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|unique:users|email',
                'password' => 'required|confirmed',
                'name' => 'required',
            ]);
            $handler = new AddUserHandler($request);
            $data = $handler->handle();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'sometimes|required|confirmed',
                'name' => 'required',
            ]);
            $handler = new EditUserHandler($id, $request);
            $data = $handler->handle();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }

    public function delete($id)
    {
        try {
            $handler = new DeleteUserHandler($id);
            $data = $handler->handle();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }

    public function get($id)
    {
        try {
            $reader = new GetUserReader($id);
            $data = $reader->read();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }

    public function getList(Request $request)
    {
        try {
            $reader = new GetUsersReader($request);
            $data = $reader->paginate();
            return $this->responsePaginate($data);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }
}
