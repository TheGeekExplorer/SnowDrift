<?php declare(strict_types=1);  namespace Velocious\controllers\MobileApp\auth;

use Velocious\core\Exception;
use Velocious\core\Memory;
use Velocious\controllers\MobileApp\AuthToken;


class LoginWithToken extends AuthToken
{
    protected $auth_token;
    protected $app_token;

    /**
     * Constructor
     * @param string $app_token
     * @param string $auth_token
     */
    public function __construct ($state=[]) {
        if (isset($state['app_token']) and isset($state['auth_token'])) {
            $this->app_token  = (string) $state['app_token'];
            $this->auth_token = (string) $state['auth_token'];
        }
    }

    /**
     * Perform authentication checks
     * @return bool
     */
    public function doAuth () {
        # Check that auth_token supplied is not null
        if (empty($this->app_token) or empty($this->auth_token))
            return false;

        # User auth_token is correct
        if($this->checkAuthToken()) {
            return [
                "app_token"  => $this->app_token,
                "auth_token" => $this->auth_token
            ];
        }
        return false;
    }

    /**
     * Check the validity of the supplied Auth Token
     * @return bool
     */
    protected function checkAuthToken () : bool {

        # Check that credentials are empty, and auth_token is not empty
        if ((!empty($this->username) or !empty($this->password)) or empty($this->auth_token))
            return false;

        # Get stores details from memory
        $auth_token = Memory::readCache($this->app_token);

        # Check that auth_token is valid
        if ($this->auth_token == $auth_token)
            return true;
        return false;
    }
}