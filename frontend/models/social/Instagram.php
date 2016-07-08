<?php

namespace frontend\models\social;

class Instagram extends AbstractAdapter
{
    public function __construct($config)
    {
        parent::__construct($config);

        $this->socialFieldsMap = array(
            'socialId'   => 'id',
            'username'       => 'username',
        );

        $this->provider = 'instagram';
    }
    public function getName()
    {
        $result = null;
        if (isset($this->userInfo['user'][$this->socialFieldsMap['username']])) {
            $result = $this->userInfo['user'][$this->socialFieldsMap['username']];
        }
        return $result;
    }
    public function getSocialId()
    {
        $result = null;
        if (isset($this->userInfo['user'][$this->socialFieldsMap['socialId']])) {
            $result = $this->userInfo['user'][$this->socialFieldsMap['socialId']];
        }
        return $result;
    }
    public function authenticate()
    {
        $result = false;
        if (isset($_GET['code'])) {
            $access_token_parameters = array(
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => $this->redirectUri,
                'grant_type'    => 'authorization_code',
                'code'          =>  $_GET['code']
            );
            $userInfo = $this->getInsta('https://api.instagram.com/oauth/access_token', $access_token_parameters);
            if (isset($userInfo['user'][$this->socialFieldsMap['socialId']])) {
               $this->userInfo = $userInfo;
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Prepare params for authentication url
     *
     * @return array
     */
    public function prepareAuthParams()
    {
        return array(
            'auth_url'    => 'https://api.instagram.com/oauth/authorize/',
            'auth_params' => array(
                'redirect_uri'  => $this->redirectUri,
                'response_type' => 'code',
                'client_id'     => $this->clientId,
                // 'scope'         => ''
            )
        );
    }
}