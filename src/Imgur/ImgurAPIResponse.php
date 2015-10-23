<?php

namespace Filmr\Imgur;

class ImgurAPIResponse
{
	
	protected $response;

	public function __construct(\GuzzleHttp\Psr7\Response $response)
	{
		$this->response = $response;
	}

	public function statusCode()
	{
		return $this->response->getStatusCode();
	}

	public function getBody()
	{
		$body = $this->response->getBody()->getContents();
		return json_decode($body);
	}


	public function UserLimit()
	{
		return $this->response->getHeader("X-RateLimit-UserLimit");
	}

	public function UserRemaining()
	{
		return $this->response->getHeader("X-RateLimit-UserRemaining");
	}

	public function UserReset()
	{
		return $this->response->getHeader("X-RateLimit-UserReset");
	}

	public function ClientLimit()
	{
		return $this->response->getHeader("X-RateLimit-ClientLimit");
	}

	public function ClientRemaining()
	{
		return $this->response->getHeader("X-RateLimit-ClientRemaining");
	}

}
