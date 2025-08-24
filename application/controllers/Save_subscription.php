<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Save_subscription extends CI_Controller
{
    public $db;
    public function __construct()
    {
        parent::__construct();
        header("Content-type: application/json");
    }

    public function index()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (is_array($data) && isset($data['endpoint'])) {
            $selectId = $this->db->query("SELECT `id` FROM `push_subscribers` WHERE `endpoint` = '{$data['endpoint']}'");

            if ($selectId->num_rows() == 0 && isset($_GET['subscribe'])) {
                // Subscribe
                $data['expirationTime'] = floor($data['expirationTime'] / 1000); // Convert milliseconds to seconds
                $query = $this->db->query("INSERT INTO `push_subscribers` (`endpoint`, `expirationTime`, `p256dh`, `authKey`) VALUES ('{$data['endpoint']}', '{$data['expirationTime']}', '{$data['keys']['p256dh']}', '{$data['keys']['auth']}')");

                if ($query) {
                    echo json_encode(['status' => 'ok', 'message' => 'Subscribed']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Try Again']);
                }
            } elseif (isset($_GET['unsubscribe'])) {
                // Unsubscribe
                $this->db->query("DELETE FROM `push_subscribers` WHERE `endpoint` = '{$data['endpoint']}'");
                echo json_encode(['status' => 'ok', 'message' => 'Unsubscribed']);
            }
        }
    }
}
