<?php declare(strict_types=1);  namespace Velocious\controllers\MobileApp;

use Velocious\core\Exception;


class AuthToken
{
    /**
     * Create new AuthToken
     * @return string
     */
    public function createAuthToken () {
        return \sha1(\time() . $_SERVER["REMOTE_ADDR"] . 'vay66442TB' . rand(56723,86745) . '46b7b6373563' . rand(324467,9788452) . '8rn9nsssyav' . rand(34355,6735425));
    }

    /**
     * Create new AppToken
     * @return string
     */
    public function createAppToken () {
        return \sha1(\time() . $_SERVER["REMOTE_ADDR"] . 'B5Y6UUNFCF' . rand(64447,75222) . 'vfr3rvrhqcd' . rand(232645,5463452) . 'g9s78dfgyqesd' . rand(21441,984522));
    }
}
