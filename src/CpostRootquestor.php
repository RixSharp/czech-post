<?php declare(strict_types = 1);

namespace Rix\CzechPost;

use Rix\CzechPost\Exception\Logical\InvalidStateException;
use Rix\CzechPost\Requestor\AbstractRequestor;
use Rix\CzechPost\Requestor\ConsignmentRequestor;

/**
 * @property-read ConsignmentRequestor $consignment
 */
class CpostRootquestor
{

	/** @var AbstractRequestor[] */
	private $requestors = [];

	public function add(string $name, AbstractRequestor $requestor): void
	{
		if (isset($this->requestors[$name])) {
			throw new InvalidStateException(sprintf('Requestor "%s" has been already registered.', $name));
		}

		$this->requestors[$name] = $requestor;
	}

	public function __get(string $name): AbstractRequestor
	{
		if (isset($this->requestors[$name])) {
			return $this->requestors[$name];
		}

		throw new InvalidStateException(sprintf('Undefined requestor "%s".', $name));
	}

}
