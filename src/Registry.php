<?php

namespace Nrgone\Registry;

class Registry implements RegistryInterface
{
    /**
     * @var array
     */
    private $data = [];

    public function set($key, $value, bool $force = false): void
    {
        if ($this->has($key) && !$force) {
            throw new \RuntimeException(sprintf('Key [%s] already exists in registry.', $key));
        }
        $this->data[$key] = $value;
    }

    public function remove($key): void
    {
        if ($this->has($key)) {
            unset($this->data[$key]);
        }
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return $this->data[$key];
        }
        return null;
    }
}
