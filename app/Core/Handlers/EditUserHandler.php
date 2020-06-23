<?php

/**
 * Created by Muhammad Muflih Kholidin
 * https://github.com/mmuflih
 * muflic.24@gmail.com
 * at: 25/03/20 10.51
 **/

namespace App\Core\Handlers;

use App\Core\Handler;
use App\User;
use Illuminate\Http\Request;

class EditUserHandler implements Handler
{
    private $id;
    private $request;

    public function __construct($id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    public function handle()
    {
        $user = User::find($this->id);
        if (!$user) {
            throw new \Exception("User data not found", 422);
        }
        $user->fill($this->request->all());
        if ($this->request->get('password')) {
            $user->password = app('hash')->make($this->request->get('password'));
        }
        unset($user['email']);
        $user->save();
        return $user;
    }
}
