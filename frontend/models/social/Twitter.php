<?php

namespace frontend\models\social;

class Twitter
{
    public $key;
    public $secret;
    public $request_token_url;
    public $authorizate_url;
    public $acces_token_url;
    public $accaunt_data_url;
    public $calback_url;
    public $url_separator;


    public function __construct (){
        $this->key = 'WyDPQsplbVYftAs2ghSVNXD7b';
        $this->secret = 'iUh4iSEFanCHeeQyDH4MGvOLa1stUF2ZDsN6zZ56JD0M8nk4vm';
        $this->request_token_url = 'https://api.twitter.com/oauth/request_token';
        $this->authorizate_url = 'https://api.twitter.com/oauth/authorize';
        $this->acces_token_url = 'https://api.twitter.com/oauth/access_token';
        $this->accaunt_data_url = 'https://api.twitter.com/1.1/users/show.json';
        $this->calback_url = 'http://front1.org/registration?provider=twitter';
        $this->url_separator = '&';
    }
    public function startGetData(){
        $this->key = 'WyDPQsplbVYftAs2ghSVNXD7b';
        $this->secret = 'iUh4iSEFanCHeeQyDH4MGvOLa1stUF2ZDsN6zZ56JD0M8nk4vm';
        $this->request_token_url = 'https://api.twitter.com/oauth/request_token';
        $this->authorizate_url = 'https://api.twitter.com/oauth/authorize';
        $this->acces_token_url = 'https://api.twitter.com/oauth/access_token';
        $this->accaunt_data_url = 'https://api.twitter.com/1.1/users/show.json';
        $this->calback_url = 'http://front1.org/registration?provider=twitter';
        $this->url_separator = '&';
        $oauth_nonce = md5(uniqid(rand(), true));
        $oauth_timestamp = time();
        $params = array(
            'oauth_callback=' . urlencode($this->calback_url) . $this->url_separator,
            'oauth_consumer_key=' . $this->key . $this->url_separator,
            'oauth_nonce=' . $oauth_nonce . $this->url_separator,
            'oauth_signature_method=HMAC-SHA1' . $this->url_separator,
            'oauth_timestamp=' . $oauth_timestamp . $this->url_separator,
            'oauth_version=1.0'
        );
        $oauth_base_text = implode('', array_map('urlencode', $params));
        $key = $this->secret . $this->url_separator;
        $oauth_base_text = 'GET' . $this->url_separator . urlencode($this->request_token_url) . $this->url_separator . $oauth_base_text;
        $oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));
        $params = array(
            $this->url_separator . 'oauth_consumer_key=' . $this->key,
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature=' . urlencode($oauth_signature),
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_version=1.0'
        );
        $url = $this->request_token_url . '?oauth_callback=' . urlencode($this->calback_url) . implode('&', $params);
        $response = file_get_contents($url);
        parse_str($response, $response);
        $oauth_token = $response['oauth_token'];
        $oauth_token_secret = $response['oauth_token_secret'];
        $link = $this->authorizate_url . '?oauth_token=' . $oauth_token;
        return $link;
    }
    public function authenticate(){
        if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
            $oauth_nonce = md5(uniqid(rand(), true));
            $oauth_timestamp = time();
            $oauth_token = $_GET['oauth_token'];
            $oauth_verifier = $_GET['oauth_verifier'];
            $oauth_base_text = "GET&";
            $oauth_base_text .= urlencode($this->acces_token_url)."&";
            $params = array(
                'oauth_consumer_key=' . $this->key . $this->url_separator,
                'oauth_nonce=' . $oauth_nonce . $this->url_separator,
                'oauth_signature_method=HMAC-SHA1' . $this->url_separator,
                'oauth_token=' . $oauth_token . $this->url_separator,
                'oauth_timestamp=' . $oauth_timestamp . $this->url_separator,
                'oauth_verifier=' . $oauth_verifier . $this->url_separator,
                'oauth_version=1.0'
            );
            $key = $this->secret . $this->url_separator . $oauth_token_secret;
            $oauth_base_text = 'GET' . $this->url_separator . urlencode($this->acces_token_url) . $this->url_separator . implode('', array_map('urlencode', $params));
            $oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));
            $params = array(
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_consumer_key=' . $this->key,
            'oauth_token=' . urlencode($oauth_token),
            'oauth_verifier=' . urlencode($oauth_verifier),
            'oauth_signature=' . urlencode($oauth_signature),
            'oauth_version=1.0'
            );
            $url = $this->acces_token_url . '?' . implode('&', $params);
            $response = file_get_contents($url);
            parse_str($response, $response);
            $oauth_nonce = md5(uniqid(rand(), true));
            $oauth_timestamp = time();
            $oauth_token = $response['oauth_token'];
            $oauth_token_secret = $response['oauth_token_secret'];
            $screen_name = $response['screen_name'];
            $params = array(
                'oauth_consumer_key=' . $this->key . $this->url_separator,
                'oauth_nonce=' . $oauth_nonce . $this->url_separator,
                'oauth_signature_method=HMAC-SHA1' . $this->url_separator,
                'oauth_timestamp=' . $oauth_timestamp . $this->url_separator,
                'oauth_token=' . $oauth_token . $this->url_separator,
                'oauth_version=1.0' . $this->url_separator,
                'screen_name=' . $screen_name
            );
            $oauth_base_text = 'GET' . $this->url_separator . urlencode($this->accaunt_data_url) . $this->url_separator . implode('', array_map('urlencode', $params));

            $key = $this->secret . '&' . $oauth_token_secret;
            $signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));
            $params = array(
            'oauth_consumer_key=' . $this->key,
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature=' . urlencode($signature),
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_token=' . urlencode($oauth_token),
            'oauth_version=1.0',
            'screen_name=' . $screen_name
            );
            $url = $this->accaunt_data_url . '?' . implode($this->url_separator, $params);
            $response = file_get_contents($url);
            $user_data = json_decode($response);
            return $user_data;
        }
    }
}