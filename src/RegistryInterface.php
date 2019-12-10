<?php

namespace Nrgone\Registry;

interface RegistryInterface
{
    public function set($key, $value, bool $force = false): void;

    public function remove($key): void;

    public function has($key): bool;

    public function get($key);
}
