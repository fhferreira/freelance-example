<?php

namespace App\Domain\Entities;

use App\Domain\Events\Client\ClientRegistered;
use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Email;

/**
 * @ORM\Entity()
 */
final class Client extends EntityWithEvents
{
    /**
     * @var Email
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Email", columnPrefix = false)
     */
    private $email;

    protected function __construct(Email $email)
    {
        parent::__construct();

        $this->email = $email;

        $this->record(new ClientRegistered($this->getId()));
    }

    public static function register(Email $email): Client
    {
        return new Client($email);
    }
}