<?php

/**
 * Created by Muhammad Muflih Kholidin
 * https://github.com/mmuflih
 * muflic.24@gmail.com
 * at: 25/03/20 10.51
 **/

namespace App\Core\Readers;

use App\Core\HasPaginate;
use App\Core\Reader;
use App\User;
use Illuminate\Http\Request;

class GetUsersReader implements Reader
{
    use HasPaginate;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $q = $request->get('q');
        $this->data = User::where(function ($sql) use ($q) {
            $sql->where('name', 'like', "%$q%");
            $sql->orWhere('email', 'like', "%$q%");
        })->whereRaw('deleted_at is null')
        ->orderBy('name', 'asc');
    }

    public function read()
    {

    }
}
