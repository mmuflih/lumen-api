<?php

/**
 * Created by Muhammad Muflih Kholidin
 * https://github.com/mmuflih
 * muflic.24@gmail.com
 * at: 25/03/20 10.51
 **/

namespace App\Core\Readers;

use App\Core\Reader;
use App\User;

class GetUserReader implements Reader
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function read()
    {
        $user = User::find($this->id);
        if (!$user) {
            throw new \Exception("User data not found", 422);
        }
        return $user;
    }
}
