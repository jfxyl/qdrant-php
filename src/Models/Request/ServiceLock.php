<?php
/**
 * @since     Apr 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Qdrant\Models\Request;

class ServiceLock implements RequestModel
{
    protected bool $write;
    protected ?string $errorMessage = null;

    public function __construct(bool $write, ?string $errorMessage = null)
    {
        $this->write = $write;
        $this->errorMessage = $errorMessage;
    }

    public function toArray(): array
    {
        return [
            'write' => $this->write,
            'error_message' => $this->errorMessage
        ];
    }
}