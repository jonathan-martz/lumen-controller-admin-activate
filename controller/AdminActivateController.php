<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class AdminActivateController
 * @package App\Http\Controllers
 */
class AdminActivateController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ValidationException
     */
    public function activate()
    {
        $validation = $this->validate($this->request, [
            'id' => 'required|integer'
        ]);

        if($this->request->user()->getRoleName() == 'admin') {
            $user = DB::table('users')
                ->where('id', '=', $this->request->input('id'))
                ->where('active', '=', '0');

            if($user->count() === 1) {
                $result = DB::table('users')->where('active', '=', '0')->update(['active' => '1']);

                if($result) {
                    $this->addMessage('success', 'Users activated.');
                }
                else {
                    $this->addMessage('error', 'Your does not exists or is already activated.');
                }
            }
            else {
                $this->addMessage('error', 'Your does not exists or is already activated.');
            }


        }
        else {
            $this->addMessage('error', 'Your not an admin.');
        }

        // User exists
        // activate user

        return $this->getResponse();
    }

    /**
     * @return JsonResponse
     * @throws ValidationException
     */
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
