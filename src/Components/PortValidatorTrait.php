<?php
/**
 * League.Url (http://url.thephpleague.com)
 *
 * @package   League.uri
 * @author    Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @copyright 2013-2015 Ignace Nyamagana Butera
 * @license   https://github.com/thephpleague/uri/blob/master/LICENSE (MIT License)
 * @version   4.0.0
 * @link      https://github.com/thephpleague/uri/
 */
namespace League\Uri\Components;

use InvalidArgumentException;
use League\Uri\Interfaces\Port as PortInterface;

/**
 * Value object representing a URI port component.
 *
 * @package League.uri
 * @author  Ignace Nyamagana Butera <nyamsprod@gmail.com>
 * @since   4.0.0
 */
trait PortValidatorTrait
{
    /**
     * Validate a Port number
     *
     * @param mixed $port the port number
     *
     * @throws InvalidArgumentException If the port number is invalid
     *
     * @return null|int
     */
    protected function validatePort($port)
    {
        if (is_bool($port)) {
            throw new InvalidArgumentException('The submitted port is invalid');
        }

        if (in_array($port, [null, ''])) {
            return null;
        }
        $res = filter_var($port, FILTER_VALIDATE_INT, ['options' => [
            'min_range' => PortInterface::MINIMUM,
            'max_range' => PortInterface::MAXIMUM,
        ]]);
        if (false === $res) {
            throw new InvalidArgumentException('The submitted port is invalid');
        }

        return $res;
    }
}