<?php

if (!function_exists('commonResponse')) {
    function commonResponse($code, $is_success, $message, $payload = null, $data_count = null)
    {
        $response = [
            'success' => $is_success,
            'message' => $message,
            'code' => $code,
            'data' => $payload,
            'count' => $data_count,
        ];
        return response()->json($response, $code);
    }
}
