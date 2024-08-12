<?php

declare(strict_types=1);

namespace Conquest\Upload\Concerns;

use InvalidArgumentException;

trait HasGenerator
{
    const Name = 'name';
    const Uuid = 'uuid';
    const Ulid = 'ulid';
    const Id = 'id';
    const UserId = 'user_id';

    protected string $generator = config('conquest-upload.generator');

    /**
     * Alias for generator
     */
    public function as(string $generator): static
    {
        return $this->generator($generator);
    }
    
    /**
     * Set how the filename is to be generated
     * 
     * @param string $generator
     * @return static
     * @throws InvalidArgumentException
     */
    public function generator(string $generator): static
    {
        $this->setGenerator($generator);
    
        return $this;
    }

    /**
     * Set how the filename is to be generated
     * 
     * @param string|null $generator
     * @throws InvalidArgumentException
     */
    public function setGenerator(string|null $generator): void
    {
        if (is_null($generator)) {
            return;
        }

        if (!in_array($generator, [self::Name, self::Uuid, self::Ulid, self::Id, self::UserId])) {
            throw new InvalidArgumentException('Provided file name method is not supported.');
        }

        $this->generator = $generator;
    }

    public function getGenerator(): string
    {
        return $this->generator;
    }

    public function uuid(): static
    {
        return $this->as(self::Uuid);
    }

    public function ulid(): static
    {
        return $this->as(self::Ulid);
    }

    public function id(): static
    {
        return $this->as(self::Id);
    }

    public function userId(): static
    {
        return $this->as(self::UserId);
    }

    public function name(): static
    {
        return $this->as(self::Name);
    }
}
