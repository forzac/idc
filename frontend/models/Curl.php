<?php

namespace frontend\models;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\HttpException;

class Curl
{
    public $response = null;
    public $responseCode = null;
    private $_options = array();
    private $_defaultOptions = array(
        CURLOPT_USERAGENT      => 'Yii2-Curl-Agent',
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
    );
    public function get($url, $raw = true)
    {
        return $this->_httpRequest('GET', $url, $raw);
    }
    public function head($url)
    {
        return $this->_httpRequest('HEAD', $url);
    }
    public function post($url, $raw = true)
    {
        return $this->_httpRequest('POST', $url, $raw);
    }
    public function put($url, $raw = true)
    {
        return $this->_httpRequest('PUT', $url, $raw);
    }
    public function delete($url, $raw = true)
    {
        return $this->_httpRequest('DELETE', $url, $raw);
    }
    public function setOption($key, $value)
    {
        $this->_options[$key] = $value;
        return $this;
    }
    public function unsetOption($key)
    {
        if (isset($this->_options[$key])) {
            unset($this->_options[$key]);
        }
        return $this;
    }
    public function unsetOptions()
    {
        if (isset($this->_options)) {
            $this->_options = array();
        }
        return $this;
    }
    public function reset()
    {
        if (isset($this->_options)) {
            $this->_options = array();
        }
        $this->response = null;
        $this->responseCode = null;
        return $this;
    }
    public function getOption($key)
    {
        $mergesOptions = $this->getOptions();
        return isset($mergesOptions[$key]) ? $mergesOptions[$key] : false;
    }
    public function getOptions()
    {
        return $this->_options + $this->_defaultOptions;
    }
    private function _httpRequest($method, $url, $raw = false)
    {
        $body = '';
        $this->setOption(CURLOPT_CUSTOMREQUEST, strtoupper($method));
        if ($method === 'HEAD') {
            $this->setOption(CURLOPT_NOBODY, true);
            $this->unsetOption(CURLOPT_WRITEFUNCTION);
        } else {
            $this->setOption(CURLOPT_WRITEFUNCTION, function ($curl, $data) use (&$body) {
                $body .= $data;
                return mb_strlen($data, '8bit');
            });
        }
        Yii::trace('Start sending cURL-Request: '.$url.'\n', __METHOD__);
        Yii::beginProfile($method.' '.$url.'#'.md5(serialize($this->getOption(CURLOPT_POSTFIELDS))), __METHOD__);
        $curl = curl_init($url);
        curl_setopt_array($curl, $this->getOptions());
        $body = curl_exec($curl);
        if ($body === false) {
            throw new Exception('curl request failed: ' . curl_error($curl) , curl_errno($curl));
        }
        $this->responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $this->response = $body;
        curl_close($curl);
        Yii::endProfile($method.' '.$url .'#'.md5(serialize($this->getOption(CURLOPT_POSTFIELDS))), __METHOD__);
        if ($this->responseCode >= 200 && $this->responseCode < 300) {
            if ($this->getOption(CURLOPT_CUSTOMREQUEST) === 'HEAD') {
                return true;
            } else {
                $this->response = $raw ? $this->response : Json::decode($this->response);
                return true;
//                return $this->response;
            }
        } elseif ($this->responseCode >= 400 && $this->responseCode <= 510) {
            return false;
        } else {
            return true;
        }
    }
}