<?php

namespace App\Domain\Event;

use App\Domain\Common\ValueObject;
use Doctrine\ORM\Mapping as ORM;
use Assert\Assert;

/**
 * @ORM\Embeddable
 */
final class EventId extends ValueObject
{
    /**
     * The identifier of an allotment.
     *
     * @ORM\Id
     * @ORM\Column(name="event_id", type="guid")
     * @ORM\GeneratedValue(strategy="NONE")
     * @var  string  $eventId
     */
    protected $eventId;

    /**
     * Build an event identifier from string.
     *
     * @param  string  $eventId
     * @return self
     */
    public static function build($eventId)
    {
        return new self($eventId);
    }

    /**
     * Constructor.
     *
     * @param  string  $eventId
     * @return void
     */
    public function __construct($eventId)
    {
        Assert::that($eventId)->uuid();

        $this->eventId = $eventId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}
