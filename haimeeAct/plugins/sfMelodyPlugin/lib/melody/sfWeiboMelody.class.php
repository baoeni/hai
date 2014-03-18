<?php
class sfWeiboMelody extends sfMelody2
{
  protected function initialize($config)
  {

    $this->setRequestAuthUrl('http://api.weibo.com/oauth2/authorize');
    $this->setAccessTokenUrl('http://api.weibo.com/oauth2/access_token');

    //$this->setOutputFormat('json');

    $this->setNamespace('default', 'https://api.weibo.com/2');

  }

  public function initializeFromToken($token)
  {
    if($token && $token->getStatus() == Token::STATUS_ACCESS)
    {
      $this->setAlias('me', 'users/show.json?uid='.$this->getToken()->getParam('uid'));
    }
  }
/*
add
$this->setAccessParameter('grant_type', 'authorization_code');

use:
$params = json_decode($params,true);
instead of OAuthUtil::parse_parameters($params);
*
*/
  public function getAccessToken($verifier, $parameters = array())
          {
            $url = $this->getAccessTokenUrl();
        
            $this->setAccessParameter('client_id', $this->getKey());
            $this->setAccessParameter('client_secret', $this->getSecret());
            $this->setAccessParameter('redirect_uri', $this->getCallback());
            $this->setAccessParameter('grant_type', 'authorization_code');
            $this->setAccessParameter('code', $verifier);
        
            $this->addAccessParameters($parameters);
        
            $params = $this->call($url, $this->getAccessParameters(), 'POST');
        	
			$this->getLogger()->info('----params');
			$this->getLogger()->info($params);
			$this->getLogger()->info('params-----');

            $params = json_decode($params,true);
        
            $access_token = isset($params['access_token'])?$params['access_token']:null;
        
            if(is_null($access_token) && $this->getLogger())
            {
              $error = sprintf('{OAuth} access token failed - %s returns %s', $this->getName(), print_r($params, true));
              $this->getLogger()->err($error);
            }
            elseif($this->getLogger())
            {
              $message = sprintf('{OAuth} %s return %s', $this->getName(), print_r($params, true));
              $this->getLogger()->info($message);
            }
        
            $token = new Token();
            $token->setTokenKey($access_token);
            $token->setName($this->getName());
            $token->setStatus(Token::STATUS_ACCESS);
            $token->setOAuthVersion($this->getVersion());
        
            unset($params['access_token']);
        
            if(count($params) > 0)
            {
              $token->setParams($params);
            }
        
            $this->setExpire($token);
        
            $this->setToken($token);
        
            // get identifier maybe need the access token
            $token->setIdentifier($this->getIdentifier());
        
            $this->setToken($token);
        
            return $token;
          }

  public function getIdentifier()
  {
    $me = $this->getMe();
    if(isset($me->id))
    {
      return $me->id;
    }

    return null;
  }
  
 protected function setExpire(&$token)
  {
    if($token->getParam('expires_in'))
    {
      $token->setExpire(time() + $token->getParam('expires_in'));
    }
  }

}