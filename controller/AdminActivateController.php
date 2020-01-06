<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminActivateController extends Controller
{
    /**
     * @return Response
     */
    public function activate()
    {
        $validation = $this->validate($this->request, [
            'id' => 'required|integer'
        ]);

        // is Admin
        // User exists
        // activate user

        return $this->getResponse();
    }

    public function select()
    {
        $validation = $this->validate($this->request, []);

        // is Admin
        // return list of Users which are not activated yet

        return $this->getResponse();
    }
}
