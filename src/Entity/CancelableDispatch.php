<?php declare(strict_types = 1);

namespace Rix\CzechPost\Entity;

use Rix\CzechPost\Enum\Status;
use Rix\CzechPost\Exception\Logical\InvalidStateException;

final class CancelableDispatch
{

	/** @var string */
	private $id;

	/** @var int */
	private $status = Status::PENDING;

	/** @var string */
	private $description = '';

	public function __construct(string $id, int $status, string $description)
	{
		$this->id          = $id;
		$this->status      = $status;
		$this->description = $description;
	}

	/**
	 * @param mixed[] $data
	 */
	public static function fromArray(array $data): self
	{
		if (!isset($data['@attributes']) || !isset($data['@attributes']['cislo'])) {
			throw new InvalidStateException('Cannot get consingnment\'s "cislo" from array.');
		}

		return new self(
			$data['@attributes']['cislo'],
			isset($data['stav']) ? (int) $data['stav'] : Status::PENDING,
			$data['popis'] ?? ''
		);
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getStatus(): int
	{
		return $this->status;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

}
