<?php

namespace Max26292\LaravelLazyTools\Helpers;

use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
/**
 * @package LogHelper
 * @static  LogHelper::log(string|array $data, string $message = '', string $type = 'info')
 */
class LogHelper
{
    /**
     * Logs a message with a given type.
     *
     * @param string|array $type the type of the log message (default: 'info')
     * @param string $message the log message (default: '')
     */
    public static function log($data = null,string $message =  null , string $type = 'info')
    {
        $log = new LogHelper();
        $data = $log->logFormat($data);
        switch ($type) {
            case 'error':
                Log::error(__CLASS__.'::'.__FUNCTION__.$message?' '.$message:'', $data);
                break;
            case 'warning':
                Log::warning(__CLASS__.'::'.__FUNCTION__.$message?' '.$message:'', $data);
                break;
            case 'critical':
                Log::critical(__CLASS__.'::'.__FUNCTION__.$message?' '.$message:'', $data);
                break;
            default:
                Log::info(__CLASS__.'::'.__FUNCTION__.$message?' '.$message:'', $data);
                break;
        }
    }

    /**
     * data
     *
     * @param string|array $data
     *
     * @return array
     */
    public function logFormat($data)
    {
        if (is_array($data)) {
            return $data;
        }
        if (is_string($data)) {
            return [
                'message' => $data
            ];
        }
        if (is_object($data)) {
            return [
                'data' => $data
            ];
        }
        if(is_null($data)) {
            return [
            ];
        }
        return [
            'message' => 'data is has wrong format'
        ];
    }
}
