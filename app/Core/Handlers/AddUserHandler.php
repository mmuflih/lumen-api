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

class AddUserHandler implements Handler
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $user = new User();
        $user->fill($this->request->all());
        $user->password = app('hash')->make($this->request->get('password'));
        $user->save();
        return $user;
    }
}
