<?php declare(strict_types = 1);

namespace Rix\CzechPost\Http;

use Rix\CzechPost\Exception\Runtime\RequestException;
use Psr\Http\Message\ResponseInterface;

interface HttpClient
{

	/**
	 * @param mixed[] $options
	 * @throws RequestException
	 */
	public function request(string $method, string $uri, array $options = []): ResponseInterface;

}
