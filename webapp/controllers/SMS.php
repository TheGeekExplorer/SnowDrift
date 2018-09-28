<?php  declare(strict_types=1);

namespace Velocious\controllers;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\services\CURL;


class SMS
{
    protected $state;

    /**
     * Controller constructor.
     * @param array $state
     */
    public function __construct (array $state) {
        $this->state = $state;
    }

    /**
     * Send message to TxtLocal API via Services Server
     * @return string
     */
    public function sendMessage () {

        # Get SMS details
        $data = [
            'recipient' => $this->state['recipient'],
            'message'   => $this->state['message']
        ];

        # Build URL
        $url = "https://localhost:4430/sms/new-message/";

        # Commit to API
        $response = CURL::commit($url, $data);

        # Return results
        return $response;
    }
}
