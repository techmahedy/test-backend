<?php

namespace App\Helper;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

trait HasApiResponse 
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpCreated($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }
   
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpInternalServerError($message)
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpNotFoundError($error, $errorMessages = [])
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpUnauthorizedError(string $error)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, Response::HTTP_UNAUTHORIZED);
    }

     /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpSuccess($message, $user)
    {
    	$response = [
            'success' => true,
            'message' => $message,
            'data' => $user
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}