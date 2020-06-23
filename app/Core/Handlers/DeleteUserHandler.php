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
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeleteUserHandler implements Handler
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $user = User::find($this->id);
        if (!$user) {
            throw new \Exception("User data not found", 422);
        }
        if ($user->deleted_at) {
            throw new \Exception("User already deleted", 422);
        }
        $user->deleted_at = Carbon::now();
        unset($user['email']);
        $user->save();
        return $user;
    }
}
