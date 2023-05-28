<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\LocalList;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\MachineToMachineList;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\MobileList;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\NationalList;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\SharedCostList;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\TollFreeList;
use Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\VoipList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string countryCode
 * @property string country
 * @property string uri
 * @property boolean beta
 * @property array subresourceUris
 */
class AvailablePhoneNumberCountryInstance extends InstanceResource {
    protected $_local = null;
    protected $_tollFree = null;
    protected $_mobile = null;
    protected $_national = null;
    protected $_voip = null;
    protected $_sharedCost = null;
    protected $_machineToMachine = null;

    /**
     * Initialize the AvailablePhoneNumberCountryInstance
     * 
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid A 34 character string that uniquely identifies
     *                           this resource.
     * @param string $countryCode The country_code
     * @return AvailablePhoneNumberCountryInstance
     */
    public function __construct(Version $version, array $payload, $accountSid, $countryCode = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'countryCode' => Values::array_get($payload, 'country_code'),
            'country' => Values::array_get($payload, 'country'),
            'uri' => Values::array_get($payload, 'uri'),
            'beta' => Values::array_get($payload, 'beta'),
            'subresourceUris' => Values::array_get($payload, 'subresource_uris'),
        );

        $this->solution = array(
            'accountSid' => $accountSid,
            'countryCode' => $countryCode ?: $this->properties['countryCode'],
        );
    }

    /**
     * Fetch a AvailablePhoneNumberCountryInstance
     *
     * @return AvailablePhoneNumberCountryInstance Fetched
     *                                             AvailablePhoneNumberCountryInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AvailablePhoneNumberCountryContext Context for this AvailablePhoneNumberCountryInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new AvailablePhoneNumberCountryContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['countryCode']
            );
        }

        return $this->context;
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.AvailablePhoneNumberCountryInstance ' . implode(' ', $context) . ']';
    }

    /**
     * Access the local
     *
     * @return LocalList
     */
    protected function getLocal() {
        return $this->proxy()->local;
    }

    /**
     * Access the tollFree
     *
     * @return TollFreeList
     */
    protected function getTollFree() {
        return $this->proxy()->tollFree;
    }

    /**
     * Access the mobile
     *
     * @return MobileList
     */
    protected function getMobile() {
        return $this->proxy()->mobile;
    }

    /**
     * Access the national
     *
     * @return NationalList
     */
    protected function getNational() {
        return $this->proxy()->national;
    }

    /**
     * Access the voip
     *
     * @return VoipList
     */
    protected function getVoip() {
        return $this->proxy()->voip;
    }

    /**
     * Access the sharedCost
     *
     * @return SharedCostList
     */
    protected function getSharedCost() {
        return $this->proxy()->sharedCost;
    }

    /**
     * Access the machineToMachine
     *
     * @return MachineToMachineList
     */
    protected function getMachineToMachine() {
        return $this->proxy()->machineToMachine;
    }
}