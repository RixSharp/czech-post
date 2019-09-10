<?php declare(strict_types = 1);

namespace Tests\Cases\Rix\CzechPost\DI;

use Rix\CzechPost\Client\ConsignmentClient;
use Rix\CzechPost\CpostRootquestor;
use Rix\CzechPost\DI\CzechPostExtension;
use Rix\CzechPost\Http\HttpClient;
use Rix\CzechPost\Requestor\ConsignmentRequestor;
use GuzzleHttp\Client;
use Nette\DI\Compiler;
use Tests\Toolkit\Rix\CzechPost\ContainerTestCase;

class CzechPostClientExtensionTest extends ContainerTestCase
{

	protected function setUpCompileContainer(Compiler $compiler): void
	{
		$compiler->addExtension('contributte.czechpost', new CzechPostExtension());
	}

	public function testServicesRegistration(): void
	{
		// Basic classes
		static::assertInstanceOf(Client::class, $this->container->getService('contributte.czechpost.guzzle.client'));
		static::assertInstanceOf(HttpClient::class, $this->container->getService('contributte.czechpost.http.client'));
		static::assertInstanceOf(CpostRootquestor::class, $this->container->getService('contributte.czechpost.rootquestor'));

		// Clients
		static::assertInstanceOf(ConsignmentClient::class, $this->container->getService('contributte.czechpost.client.consignment'));

		// Requestors
		static::assertInstanceOf(ConsignmentRequestor::class, $this->container->getService('contributte.czechpost.requestor.consignment'));
		static::assertInstanceOf(ConsignmentRequestor::class, $this->container->getService('contributte.czechpost.rootquestor')->consignment);
	}

}
