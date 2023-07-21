<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Config\Services;
use CodeIgniter\API\ResponseTrait;

class Middleware implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */

    use ResponseTrait;
    protected $response;
    protected $request;
    public function __construct()
    {
        $this->response = service('Response');
        $this->request = service('request');
    }


    public function before(RequestInterface $request, $arguments = null)
    {


        $apiKey = $_ENV['API_KEY'];

        $authHeader = $request->getServer('HTTP_AUTHORIZATION');

        if ($authHeader) {
            try {
                $apiKey = explode('Bearer ', $authHeader)[1];
                // lakukan validasi apakah API key yang diberikan valid
                if ($apiKey !== $apiKey) {
                    return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
                }
            } catch (\Throwable $th) {
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
                //throw $th;
            }
        } else {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
