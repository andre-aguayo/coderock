<?php

namespace App\Traits;

use \Illuminate\Http\JsonResponse;

trait ApiResponse
{
    private $actionName;

    public function run(callable $fn): JsonResponse
    {
        try {
            $response = $fn();

            return response()->json([
                'success' => true,
                'jsonData' => $response
            ]);
        } catch (\Exception $exception) {
            $errors = [
                'success' => false,
                'error' =>
                [
                    'exception_message' => $exception->getMessage(),
                    'exception_code' => $exception->getCode()
                ]
            ];
            return response()->json($errors)->withHeaders($errors);
        }
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message, array $data, int $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' =>
            [
                'action_name' => $message,
                'exception_message' => $data,
                'exception_code' => $code
            ]
        ]);
    }
}
