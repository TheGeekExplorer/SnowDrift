<?php declare(strict_types=1);  namespace Velocious\controllers\MobileApp\auth;

use Velocious\core\Exception;
use Velocious\core\Memory;
use Velocious\controllers\MobileApp\AuthToken;


class LoginWithCredentials extends AuthToken
{
    protected $username;
    protected $password;

    /**
     * Constructor
     * @param string $username
     * @param string $password
     */
    public function __construct ($state=[])
    {
        if (isset($state['username']) and isset($state['password'])) {
            $this->username = (string) $state['username'];
            $this->password = (string) $state['password'];
        }
    }

    /**
     * Perform authentication checks
     * @return bool
     */
    public function doAuth ()
    {
        # Check credentials are not empty
        if (empty($this->username) and empty($this->password))
            return false;

        # Check credentials validity
        if ($this->checkCredentials()) {
            $app_token  = $this->createAppToken();
            $auth_token = $this->createAuthToken();

            # Store Tokens in Memory Cache
            Memory::createCache($app_token, $auth_token, 36000);

            # Return auth object
            return [
                'app_token'  => $app_token,
                'auth_token' => $auth_token
            ];
        }
        return false;
    }

    /**
     * Check the validity of the supplied Login Credentials
     * @return bool
     */
    protected function checkCredentials () : bool
    {
        if ($this->username == "mark" and $this->password == "Pickle31+")
            return true;
        return false;
    }
}