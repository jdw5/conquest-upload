<?php

declare(strict_types=1);

namespace Conquest\Upload\Concerns;

trait HasDisk
{
    protected ?string $disk = null;

    public function disk(string $disk): static
    {
        $this->setDisk($disk);

        return $this;
    }

    public function setDisk(?string $disk): void
    {
        if (is_null($disk)) {
            return;
        }
        $this->disk = $disk;
    }

    public function hasDisk(): bool
    {
        return ! $this->lacksDisk();
    }

    public function lacksDisk(): bool
    {
        return is_null($this->disk);
    }

    public function getDisk(): string
    {
        return $this->disk ?? config('conquest-upload.disk');
    }
}
