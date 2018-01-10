<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $status_code = 200;

    public function setStatusCode($status_code) 
    {

      $this->status_code = $status_code;

      // it's critical when chaining php object methods to return the the object at the end of the function or you'll get a fatal error: Call to a member function respond() on null
      return $this;

    }

    public function getStatusCode() 
    {

      return $this->status_code;

    }

    public function respond($data, $headers = []) 
    {

      return response()->json($data, $this->getStatusCode(), $headers);

    }

    /**
     * [404 reponse]
     * @return response [string] 
     * @param  message [string]
     */

    public function respondNotFound($message = 'Not Found') 
    {

      return $this->setStatusCode(404)->respond(
        [
          'error' => [
            'message' => $message,
            'code' => $this->getStatusCode()
          ]
        ]
      );

    }

    /**
     * [200 reponse]
     * @return response [string] 
     * @param  message [string]
     */

    public function respondFound($message = 'Ok') 
    {

      return $this->setStatusCode(200)->respond($message);

    }

    /**
     * [403 reponse]
     * @return response [string] 
     * @param  message [string]
     */

    public function respondForbidden($message = 'Forbidden. Turn Back Now!!!') 
    {

      return $this->setStatusCode(403)->respond($message);

    }
}
