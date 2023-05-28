<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Conference;

use DateTime;
use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string accountSid
 * @property string apiVersion
 * @property string callSid
 * @property string conferenceSid
 * @property DateTime dateCreated
 * @property DateTime dateUpdated
 * @property DateTime startTime
 * @property string duration
 * @property string sid
 * @property string price
 * @property string priceUnit
 * @property string status
 * @property integer channels
 * @property string source
 * @property integer errorCode
 * @property array encryptionDetails
 * @property string uri
 */
class RecordingInstance extends InstanceResource {
    /**
     * Initialize the RecordingInstance
     * 
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The unique sid that identifies this account
     * @param string $conferenceSid The unique id for the conference associated
     *                              with the recording.
     * @param string $sid Fetch by unique recording Sid
     * @return RecordingInstance
     */
    public function __construct(Version $version, array $payload, $accountSid, $conferenceSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'apiVersion' => Values::array_get($payload, 'api_version'),
            'callSid' => Values::array_get($payload, 'call_sid'),
            'conferenceSid' => Values::array_get($payload, 'conference_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'startTime' => Deserialize::dateTime(Values::array_get($payload, 'start_time')),
            'duration' => Values::array_get($payload, 'duration'),
            'sid' => Values::array_get($payload, 'sid'),
            'price' => Values::array_get($payload, 'price'),
            'priceUnit' => Values::array_get($payload, 'price_unit'),
            'status' => Values::array_get($payload, 'status'),
            'channels' => Values::array_get($payload, 'channels'),
            'source' => Values::array_get($payload, 'source'),
            'errorCode' => Values::array_get($payload, 'error_code'),
            'encryptionDetails' => Values::array_get($payload, 'encryption_details'),
            'uri' => Values::array_get($payload, 'uri'),
        );

        $this->solution = array(
            'accountSid' => $accountSid,
            'conferenceSid' => $conferenceSid,
            'sid' => $sid ?: $this->properties['sid'],
        );
    }

    /**
     * Update the RecordingInstance
     *
     * @param string $status The status to change the recording to.
     * @param array|Options $options Optional Arguments
     * @return RecordingInstance Updated RecordingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($status, $options = array()) {
        return $this->proxy()->update($status, $options);
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return RecordingContext Context
     *                                                                    for this
     *                                                                    RecordingInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new RecordingContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['conferenceSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a RecordingInstance
     * 
     * @return RecordingInstance Fetched RecordingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the RecordingInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() {
        return $this->proxy()->delete();
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
        return '[Twilio.Api.V2010.RecordingInstance ' . implode(' ', $context) . ']';
    }
}