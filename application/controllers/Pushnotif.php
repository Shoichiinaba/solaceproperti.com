<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\VAPID;

class Pushnotif extends CI_Controller
{
    public $load;
    public $db;
    public $input;
    public $M_pushnotif;
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_pushnotif');
    }
    public function send_notifications()
    {
        // Load necessary models and libraries
        // $this->load->database();
        // require_once APPPATH . 'libraries/web-push/vendor/autoload.php'; // Adjust the path as needed
        // var_dump(VAPID::createVapidKeys());
        // die;
        // Your VAPID keys
        $publicKey = "BArB1CCO00pkMSnndFT0CB2ZzVW31oIXiQI5Nqd9T3HyrbXAqKf1Ikn-auY-dHqHVp8KFUrmJ8ZpT-TY-D5Jj8Y";
        $privateKey = "TNdpQKEdR9MRr_Mck8kLY8_PAC0hpVMFhZX9wxCGXOY";

        // Notification message
        $title = $this->input->post('title-notif');
        $info = $this->input->post('info-notif');
        $url = $this->input->post('url-notif');

        $message = json_encode([
            'title' => $title,
            'body' => $info,
            'icon' => base_url('assets/img/') . 'download.png',
            'badge' => base_url('assets/img/') . 'logo-pt-kanpa-2.png',
            'extraData' => $url
        ]);
        echo $message;
        // die;
        // Query subscribers from database
        $time = time();
        $query = $this->db->query("SELECT * FROM `push_subscribers` WHERE `expirationTime` = 0 OR `expirationTime` > '{$time}'  AND id = '62'");

        if ($query->num_rows() > 0) {
            $auth = [
                'VAPID' => [
                    'subject' => 'https://thintake.in',
                    'publicKey' => $publicKey,
                    'privateKey' => $privateKey,
                ],
            ];
            $webPush = new WebPush($auth);

            foreach ($query->result_array() as $subscriber) {
                $subscription = Subscription::create([
                    "endpoint" => $subscriber['endpoint'],
                    "keys" => [
                        'p256dh' => $subscriber['p256dh'],
                        'auth' => $subscriber['authKey']
                    ]
                ]);
                $webPush->queueNotification($subscription, $message);
            }

            foreach ($webPush->flush() as $report) {
                $endpoint = $report->getRequest()->getUri()->__toString();

                if ($report->isSuccess()) {
                    // echo "Message sent successfully for {$endpoint}.<br>";
                } else {
                    echo "Message failed to sent for {$endpoint}: {$report->getReason()}.";
                    echo '<br>';
                    $this->M_pushnotif->m_delete_subscribers($endpoint);
                }
            }
        } else {
            echo "No Subscribers";
        }
    }
}
