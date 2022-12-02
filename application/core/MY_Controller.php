<?php

class MY_Controller extends CI_Controller
{

	public $user;
    
    function __construct(){

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('email');

        $this->load->library('upload');   

        $this->load->helper('cookie');
        $this->load->helper('string');
        $this->load->helper('html');

        $this->load->model('Common_model', 'common');

        $this->load->library('cart'); 

        //date_default_timezone_set('UTC');
        date_default_timezone_set('Asia/Kolkata');
    }

    protected function _response($response = array())
    {
        return json_encode($response);
    }

    protected function _isTokenExist($token)
    {
        $query = "select * from tbl_users where token = '".$token."' and is_delete = '1'";
        $result = $this->db->query($query); 
        if($result->num_rows() == 0)
        {
            return 0;
        }
        else
        {
            return 1;
        }

    }

    protected function _userLoginCheck()
    {
        if($this->session->userdata('user_id') == '')
        {
            $next = current_url();

            redirect(base_url().'login?next='.$next);
            exit();
        }
    }

    protected function _isBuyerCheck()
    {
        if($this->session->userdata('user_type') != '1')
        {
            redirect(base_url());
            exit();
        }
    }

    function _adminLoginCheck()
    {
        if($this->session->userdata('admin_id') == '')
        {
            $next = current_url();
            redirect('admin/login?next='.$next);
            exit();
        }
    }

    function _update_last_activity_time()
    {
        if($this->session->userdata('user_id') != '')
        {
            $query = "update tbl_users set last_login = '".date('Y-m-d H:i:s')."' where id = '".$this->session->userdata('user_id')."'";
            $this->db->query($query); 
        }
    }

    function _auto_logout_user()
    {
        if($this->session->userdata('user_id') != '')
        {
            $current_datetime = date('Y-m-d H:i:s');

            $query = "select * from tbl_users where id = '".$this->session->userdata('user_id')."' and last_login >= '".$current_datetime."' - INTERVAL 10 MINUTE ";
            $data = $this->db->query($query); 

            if($data->num_rows() == 0)
            {
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('user_type');
                redirect(base_url());                
            }
        }
    }

    function send_sms_notification($message, $mobile_number)
    {
        // Account details
        $apiKey = urlencode(SMS_API_KEY);
        
        // Message details
        
        $sender = urlencode(SMS_SENDER);
        $message = rawurlencode($message);
     
        $numbers = array($mobile_number);
        $numbers = implode(',', $numbers);
     
        // Prepare data for POST request
        $data = array('apikey' => SMS_API_KEY, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
     
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        // Process your response here
        // print_r($response);
    }

    function sendAndroidPushNotification($fields)
    {
      /*  
      Parameter Example
      $data = array('post_id'=>'12345','post_title'=>'A Blog post');
      $target = 'single tocken id or topic name';
      or
      $target = array('token1','token2','...'); // up to 1000 in one request
      */

      //FCM api URL
      $url = 'https://fcm.googleapis.com/fcm/send';
      //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
      //$server_key = 'AIzaSyCaYo6UydmHrm384zREXzT7ctImGliARUA';
      // $server_key = 'AIzaSyD8iQw84ydBsSSQ9yqL9jpZ68Ut42NMzrc';
      $server_key = 'AAAAbwbo6Hg:APA91bERIgoIoTq3EpQLH32aoqzcjBd20yKlU28laBFl393cQ3Xpc2jlokJDzeq5jgKL67rBcweq06FmettqCyMtmT3W_ueSGOPwTzYpvd-n_RWypDJPLrGUSI9rU4B528TfR5_Y8Mma';

      // $fields = array();
      // $fields['data'] = $data;
      // if(is_array($target)){
      // $fields['registration_ids'] = $target;
      // }else{
      // $fields['to'] = $target;
      // }


      //header with content_type api key
      $headers = array(
      'Content-Type:application/json',
      'Authorization:key='.$server_key);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      if ($result === FALSE) {
      die('FCM Send Error: ' . curl_error($ch));
      }
      curl_close($ch);

      return 1;
    }

    function sendIOSPushNotification($deviceToken, $message)
    {   
      // $apnsHost = 'gateway.sandbox.push.apple.com';
      // $apnsCert = './uploads/pem/kiteffood.pem';
      
      $apnsHost = 'gateway.push.apple.com';
      $apnsCert = './uploads/pem/kiteffood.pem';

      $apnsPort = 2195;
      $apnsPass = '123456';

      $token = $deviceToken;

      //$payload['aps'] = array('alert' => $message["notification"], "booking_id" => $message["booking_id"]);
      $payload['aps'] = $message;
        
      $output = json_encode($payload);
      $token = pack('H*', str_replace(' ', '', $token));
      $apnsMessage = chr(0).chr(0).chr(32).$token.chr(0).chr(strlen($output)).$output;

      $streamContext = stream_context_create();
      stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
      stream_context_set_option($streamContext, 'ssl', 'passphrase', $apnsPass);

      $apns = stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
      fwrite($apns, $apnsMessage);
      fclose($apns);
      
      return 1;

    }
}
