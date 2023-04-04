<?php

namespace Drewlabs\Curl\REST\Concerns;

trait Response
{
	/**
	 * Response status code
	 * 
	 * @var int
	 */
	private $status = null;

	/**
	 * Response headers
	 * 
	 * @var array
	 */
	private $headers = [];

	/**
	 * Response reason pharase
	 * 
	 * @var string
	 */
	private $reasonPhrase = null;

	public function getStatus()
	{
		# code...
		return $this->status;
	}

    /**
     * Alias for `getStatus()` method definition
     * 
     * @return int 
     */
    public function getStatusCode()
    {
        return $this->status;
    }

	public function getStatusText()
	{
		return $this->reasonPhrase;
	}

	public function getHeaders()
	{
		# code...
		return $this->headers ?? [];
	}

	public function getReasonPhrase()
	{
		# code...
		return $this->reasonPhrase ?? 'Unknown';
	}
}