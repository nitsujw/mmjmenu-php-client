
<?php


class Mmjmenu {
    private $domain = 'https://mmjmenu.com/api/v1';

    private $active_api_key;
    private $active_domain;

    private $username;
    private $password;
  
    public function __construct($api_key, $active_domain = null, $active_api_key = null) {
        $this->setActiveDomain($this->domain, $api_key);
    }

    public function setActiveDomain($active_domain, $active_api_key) {
        $this->active_domain = $active_domain;
        $this->active_api_key = $active_api_key;
        $this->username = $this->active_api_key;
        $this->password = 'x';
    }
  
    private function sendRequest($uri, $method = 'GET', $data = '') {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://mmjmenu.com/api/v1" . $uri);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);

        $method = strtoupper($method);
        if($method == 'POST')
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        else if ($method == 'PUT')
        {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        else if($method != 'GET')
        {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $result = new StdClass();
        $result->response = curl_exec($ch);
        $result->code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result->meta = curl_getinfo($ch);
        
        $curl_error = ($result->code > 0 ? null : curl_error($ch) . ' (' . curl_errno($ch) . ')');

        curl_close($ch);
        
        if ($curl_error) {
            //print('ERROR');
        }

        return $result;
    }

    /****************************************************
    ********************* MENU ITEMS ********************
    ****************************************************/

    public function menuItems() {
        $base_url = '/menu_items';
        $menuItems = $this->sendRequest($base_url);
        return $menuItems->response;
    }
    
    public function menuItem($id) {
        $base_url = "/menu_items/$id";
        $menuItem = $this->sendRequest($base_url);
        return $menuItem->response;
    }
}
?>
