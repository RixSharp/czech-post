<?php declare(strict_types = 1);

namespace Rix\CzechPost\Client;

use Rix\CzechPost\Http\HttpClient;
use Psr\Http\Message\ResponseInterface;

final class ParcelHistoryClient
{

	private const HISTORY_URL = 'https://b2c.cpost.cz/services/ParcelHistory/getDataAsJson?idParcel=%s';

	/** @var HttpClient */
	private $httpClient;

	public function __construct(HttpClient $httpClient)
	{
		$this->httpClient = $httpClient;
	}

	public function history(string $trackingNumber): ResponseInterface
	{
		return $this->httpClient->request(
			'GET',
			sprintf(self::HISTORY_URL, $trackingNumber),
			['verify' => false]
		);
	}

}
