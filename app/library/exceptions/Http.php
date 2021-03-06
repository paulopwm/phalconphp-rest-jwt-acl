<?php
namespace PhalconRestJWT\Exceptions;

use PhalconRestJWT\Constants\ErrorCodes;
use PhalconRestJWT\Http\Response;

/**
 * Class Http
 * @package PhalconRestJWT
 */

class Http extends \Exception{
	
    /**
     * Developer Error Message
     * @var string
     */

	public $devMessage;
	
    /**
     * Error Header Code
     * @var string
     */
	public $errorCode;

    /**
     * Error Reports from Message and Dev
     * @var array
     */
	private $error;

    /**
     * Error Codes
     * @var array
     */
    protected $errors = [

        // General
        ErrorCodes::GENERAL_SYSTEM => [
            'statusCode' => 500,
            'message' => 'General: System Error'
        ],

        ErrorCodes::GENERAL_NOT_IMPLEMENTED => [
            'statusCode' => 500,
            'message' => 'General: Not Implemented'
        ],

        ErrorCodes::GENERAL_NOT_FOUND => [
            'statusCode' => 404,
            'message' => 'General: Not Found'
        ],

        // Authentication
        ErrorCodes::AUTH_INVALID_ACCOUNT_TYPE => [
            'statusCode' => 400,
            'message' => 'Authentication: Invalid Account Type'
        ],

        ErrorCodes::AUTH_LOGIN_FAILED => [
            'statusCode' => 401,
            'message' => 'Authentication: Login Failed'
        ],

        ErrorCodes::AUTH_TOKEN_INVALID => [
            'statusCode' => 401,
            'message' => 'Authentication: Login Failed'
        ],

        ErrorCodes::AUTH_SESSION_EXPIRED => [
            'statusCode' => 401,
            'message' => 'Authentication: Session Expired'
        ],

        ErrorCodes::AUTH_SESSION_INVALID => [
            'statusCode' => 401,
            'message' => 'Authentication: Session Invalid'
        ],

        // Access Control
        ErrorCodes::ACCESS_DENIED => [
            'statusCode' => 403,
            'message' => 'Access: Denied'
        ],

        // Data
        ErrorCodes::DATA_FAILED => [
            'statusCode' => 500,
            'message' => 'Data: Failed'
        ],

        ErrorCodes::DATA_NOT_FOUND => [
            'statusCode' => 404,
            'message' => 'Data: Not Found'
        ],

        ErrorCodes::POST_DATA_NOT_PROVIDED => [
            'statusCode' => 400,
            'message' => 'Postdata: Not provided'
        ],

        ErrorCodes::POST_DATA_INVALID => [
            'statusCode' => 400,
            'message' => 'Postdata: Invalid'
        ]
    ];

    /**
     * Constructor recieves parameters and passed on to the Response Class
     *
     * @param array $code
     * @param string $message
     * @param array $devError
     *
     * @return void
     *
     */
	public function __construct($code, $message, $devError){

		$code = !isset($this->errors[$code]) ? 1010 : $code;

		$this->error = array(
			'errorHeader' => $this->errors[$code]
		);

		$this->error['errorMessage'] = $message;
		$this->error['errorDev'] = $devError;

		// Put Save error to custom log file
	}

    /**
     * Get compiled error
     *
     * @return array
     *
     */
	public function getError(){
		return $this->error;
	}
}
