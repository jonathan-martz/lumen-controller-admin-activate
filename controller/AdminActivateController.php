<?php

namespace App\Http\Controllers;

use App\Model\User;
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

        if($this->request->user()->getRoleName() == 'admin') {
            $this->addMessage('success', 'Your admin');
        }
        else {
            $this->addMessage('error', 'Your not an admin.');
        }

        // is Admin
        // User exists
        // activate user

        return $this->getResponse();
    }

    public function select()
    {
        $validation = $this->validate($this->request, []);

        if($this->request->user()->getRoleName() == 'admin') {
            $users = DB::table('users')
                ->where('RID', '<>', $this->request->user()->getAttribute('RID'))
                ->where('active', '=', '0');

            $user = [];
            foreach($users->get() as $key => $data) {
                $user[] = new User($data);
            }

            $this->addResult('users', $user);
        }
        else {
            $this->addMessage('error', 'Your not an admin.');
        }

        return $this->getResponse();
    }
}
