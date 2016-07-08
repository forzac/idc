<?php

namespace frontend\models\social;

class Linkedin extends AbstractAdapter
{
    public function __construct($config)
    {
        parent::__construct($config);

        $this->socialFieldsMap = array(
            'socialId'   => 'id',
            'email'      => 'emailAddress',
            'name'       => 'firstName',
            'surname'    => 'lastName',
            'socialPage' => 'linkedin',
            'avatar'     => 'picture',
            'sex'        => 'gender'
        );

        $this->provider = 'linkedin';
    }

    /**
     * Get user birthday or null if it is not set
     *
     * @return string|null
     */
    public function getBirthday()
    {
        if (isset($this->_userInfo['birthday'])) {
            $this->_userInfo['birthday'] = str_replace('0000', date('Y'), $this->_userInfo['birthday']);
            $result = date('d.m.Y', strtotime($this->_userInfo['birthday']));
        } else {
            $result = null;
        }
        return $result;
    }

    /**
     * Authenticate and return bool result of authentication
     *
     * @return bool
     */
    public function authenticate()
    {
        $result = false;

        if (isset($_GET['code'])) {
            $params = array(
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => $this->redirectUri,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
            );

            $tokenInfo = $this->post('https://www.linkedin.com/uas/oauth2/accessToken', $params);
            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];
                $userInfo = $this->getLink('https://api.linkedin.com/v1/people/~:(id,email-address,firstName,lastName)?oauth2_access_token='.$tokenInfo['access_token'].'&format=json&email-address=json');
                if($_GET['state'] == 'qwerqwer'){
                    if (isset($userInfo[$this->socialFieldsMap['socialId']])) {
                        $this->userInfo = $userInfo;
                        $result = true;
                    }
                }
            }
        }

        return $result;
    }
    public function getEmail()
    {
        $result = null;
        if (isset($this->userInfo[$this->socialFieldsMap['email']])) {
            $result = $this->userInfo[$this->socialFieldsMap['email']];
        }
        return $result;
    }
    public function getName()
    {
        $result = null;
        if (isset($this->userInfo['firstName']) && isset($this->userInfo['lastName'])) {
            $result = $this->userInfo['firstName'] . ' ' . $this->userInfo['lastName'];
        }
        return $result;
    }


    protected function getLink($url, $parse = true)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($parse) {
            $result = json_decode($result, true);
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
            'auth_url'    => 'https://www.linkedin.com/uas/oauth2/authorization',
            'auth_params' => array(
                'redirect_uri'  => $this->redirectUri,
                'response_type' => 'code',
                'client_id'     => $this->clientId,
                'scope'         => 'r_emailaddress',//, r_basciprofiel',
                'state'         =>'qwerqwer'
            )
        );
    }

}