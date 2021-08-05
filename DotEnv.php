<?php
namespace Luwake\Env;

class DotEnv implements \ArrayAccess
{

    public function __construct($path = '')
    {
        $this->load($path);
    }

    public function load($path)
    {
        if ($path && file_exists($path)) {
            $arr = parse_ini_file($path, true);
            
            foreach ($arr as $name => $value) {
                $this->set($name, $value);
            }
            return $this;
        }
    }

    public function exists($name)
    {
        return array_key_exists($name, $_SERVER) || array_key_exists($name, $_ENV);
    }

    public function get($name)
    {
        return getenv($name);
    }

    public function set($name, $value)
    {
        if (! $this->exists($name)) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    putenv(sprintf('%s.%s=%s', $name, $k, $v));
                }
            } else {
                putenv(sprintf('%s=%s', $name, $value));
            }
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
        return $this;
    }

    public function unset($name)
    {
        unset($_ENV[$name]);
        unset($_SERVER[$name]);
        return $this;
    }

    public function offsetExists($offset)
    {
        return $this->exists($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->unset($offset);
    }

    public function __isset($name)
    {
        return $this->exists($name);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function __unset($name)
    {
        $this->unset($name);
    }
}
