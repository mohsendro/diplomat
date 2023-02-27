<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('untdovr_add_gateway')) {

    add_filter('unitedover_sms_gateways', 'untdovr_add_gateway');
    function untdovr_add_gateway($gateways)
    {
        return array_merge($gateways, untdovr_additional_gateways_list());
    }

    function untdovr_additional_gateways_list()
    {
        return array(
            'SMS123' => array(
                'value' => 130,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                ),
            ),
            'OperSMS' => array(
                'value' => 34,
                'require_addon' => 1,
                'inputs' => array(
                    __('Login') => array('text' => true, 'name' => 'login'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                ),
            ),
            'SparrowSMS' => array(
                'value' => 35,
                'require_addon' => 1,
                'inputs' => array(
                    __('Token') => array('text' => true, 'name' => 'token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'ADPDIGITAL' => array(
                'value' => 37,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Spryng' => array(
                'value' => 38,
                'inputs' => array(
                    __('Bearer Token') => array('text' => true, 'name' => 'bearer_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Karix' => array(
                'value' => 39,
                'require_addon' => 1,
                'inputs' => array(
                    __('UID') => array('text' => true, 'name' => 'uid'),
                    __('Token') => array('text' => true, 'name' => 'token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Bandwidth' => array(
                'value' => 40,
                'inputs' => array(
                    __('API Secret') => array('text' => true, 'name' => 'uid'),
                    __('API Token') => array('text' => true, 'name' => 'token'),
                    __('Application ID') => array('text' => true, 'name' => 'application_id'),
                    __('Account ID') => array('text' => true, 'name' => 'account_id'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'CDYNE' => array(
                'value' => 41,
                'require_addon' => 1,
                'inputs' => array(
                    __('License Key') => array('text' => true, 'name' => 'license_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'EngageSpark' => array(
                'value' => 42,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Organization ID') => array('text' => true, 'name' => 'organization_id'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'KAPSystem' => array(
                'value' => 43,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Telestax' => array(
                'value' => 44,
                'require_addon' => 1,
                'inputs' => array(
                    __('Account SID') => array('text' => true, 'name' => 'account_sid'),
                    __('Auth Token') => array('text' => true, 'name' => 'auth_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TTAGSystems' => array(
                'value' => 45,
                'require_addon' => 1,
                'inputs' => array(
                    __('User') => array('text' => true, 'name' => 'user'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Wavecell' => array(
                'value' => 46,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Token') => array('text' => true, 'name' => 'api_token'),
                    __('Subaccount ID') => array('text' => true, 'name' => 'subaccount_id'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSAero' => array(
                'value' => 47,
                'require_addon' => 1,
                'inputs' => array(
                    __('Email') => array('text' => true, 'name' => 'email'),
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'GatewayAPI' => array(
                'value' => 48,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('API Secret') => array('text' => true, 'name' => 'api_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'AgileTelecom' => array(
                'value' => 49,
                'require_addon' => 1,
                'inputs' => array(
                    __('SMS User') => array('text' => true, 'name' => 'sms_user'),
                    __('SMS Password') => array('text' => true, 'name' => 'sms_password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'GreenText' => array(
                'value' => 50,
                'require_addon' => 1,
                'inputs' => array(
                    __('Client ID') => array('text' => true, 'name' => 'client_id'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'MNotify' => array(
                'value' => 51,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSBroadcast' => array(
                'value' => 52,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSGatewayHub' => array(
                'value' => 53,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'ThaiBulkSMS' => array(
                'value' => 54,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSCountry' => array(
                'value' => 55,
                'require_addon' => 1,
                'inputs' => array(
                    __('User') => array('text' => true, 'name' => 'user'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TextMagic' => array(
                'value' => 56,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'QSMS' => array(
                'value' => 57,
                'require_addon' => 1,
                'inputs' => array(
                    __('User') => array('text' => true, 'name' => 'user'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSFactor' => array(
                'value' => 58,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Token') => array('text' => true, 'name' => 'api_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'ESMS' => array(
                'value' => 59,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('API Secret') => array('text' => true, 'name' => 'api_secret'),
                    __('Brandname') => array('text' => true, 'name' => 'brandname'),
                ),
            ),
            'ISMS' => array(
                'value' => 60,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TEXTPLODE' => array(
                'value' => 61,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'RouteSMS' => array(
                'value' => 62,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Skebby' => array(
                'value' => 63,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SendHub' => array(
                'value' => 64,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                ),
            ),
            'Proovl' => array(
                'value' => 132,
                'require_addon' => 1,
                'inputs' => array(
                    __('User') => array('text' => true, 'name' => 'user'),
                    __('Token') => array('text' => true, 'name' => 'token'),
                ),
            ),
            'Tyntec' => array(
                'value' => 65,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'BulkSMSNigeria' => array(
                'value' => 66,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Token') => array('text' => true, 'name' => 'api_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'BulkSMS' => array(
                'value' => 67,
                'require_addon' => 1,
                'inputs' => array(
                    __('Token ID') => array('text' => true, 'name' => 'token_id'),
                    __('Token Secret') => array('text' => true, 'name' => 'token_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Esendex' => array(
                'value' => 68,
                'inputs' => array(
                    __('Account reference ') => array('text' => true, 'name' => 'account_reference'),
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'WebSMS' => array(
                'value' => 69,
                'require_addon' => 1,
                'inputs' => array(
                    __('Access Token ') => array('text' => true, 'name' => 'access_token'),
                ),
            ),
            'SMSGlobal' => array(
                'value' => 70,
                'require_addon' => 1,
                'inputs' => array(
                    __('User') => array('text' => true, 'name' => 'user'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'FortyTwo' => array(
                'value' => 71,
                'inputs' => array(
                    __('Authorization Token') => array('text' => true, 'name' => 'authorization_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Primotexto' => array(
                'value' => 72,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Spirius' => array(
                'value' => 73,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'ExpertTexting' => array(
                'value' => 74,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Jusibe' => array(
                'value' => 75,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Access Token') => array('text' => true, 'name' => 'token'),
                    __('Sender') => array('text' => true, 'name' => 'sender'),
                ),
            ),
            'Mensatek' => array(
                'value' => 76,
                'require_addon' => 1,
                'inputs' => array(
                    __('Email') => array('text' => true, 'name' => 'email'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SpeedSMS' => array(
                'value' => 77,
                'require_addon' => 1,
                'inputs' => array(
                    __('Access token') => array('text' => true, 'name' => 'access_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSMISR' => array(
                'value' => 78,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'JazzCMT' => array(
                'value' => 79,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'MoceanSMS' => array(
                'value' => 80,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('API Secret') => array('text' => true, 'name' => 'api_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SendSMS247' => array(
                'value' => 81,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SmscUA' => array(
                'value' => 82,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'CPSMS' => array(
                'value' => 83,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('API Token') => array('text' => true, 'name' => 'api_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            '1s2u' => array(
                'value' => 84,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TextAnywhere' => array(
                'value' => 85,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMS77' => array(
                'value' => 86,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Verimor' => array(
                'value' => 87,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'LabsMobile' => array(
                'value' => 88,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Unisender' => array(
                'value' => 89,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Aruba' => array(
                'value' => 90,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Comilio' => array(
                'value' => 91,
                'require_addon' => 1,
                'inputs' => array(
                    __('Authorization token') => array('text' => true, 'name' => 'authorization_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSHosting' => array(
                'value' => 92,
                'require_addon' => 1,
                'inputs' => array(
                    __('Authorization key') => array('text' => true, 'name' => 'auth_key'),
                    __('Authorization secret') => array('text' => true, 'name' => 'auth_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Gateway' => array(
                'value' => 93,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'UwaziiMobile' => array(
                'value' => 94,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SureSMS' => array(
                'value' => 95,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'EasysendSMS' => array(
                'value' => 96,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Sinch' => array(
                'value' => 97,
                'inputs' => array(
                    __('Bearer token') => array('text' => true, 'name' => 'bearer_token'),
                    __('Service plan id') => array('text' => true, 'name' => 'service_plan_id'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSAla' => array(
                'value' => 98,
                'require_addon' => 1,
                'inputs' => array(
                    __('API ID') => array('text' => true, 'name' => 'api_id'),
                    __('API Password') => array('text' => true, 'name' => 'api_password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSEmpresa' => array(
                'value' => 99,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Semaphore' => array(
                'value' => 100,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Wavy' => array(
                'value' => 101,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Authentication token') => array('text' => true, 'name' => 'authentication_token'),
                ),
            ),
            'SMSTo' => array(
                'value' => 102,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Token') => array('text' => true, 'name' => 'api_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Telnyx' => array(
                'value' => 103,
                'require_addon' => 1,
                'inputs' => array(
                    __('Profile secret') => array('text' => true, 'name' => 'profile_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TeleSign' => array(
                'value' => 104,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'D7Networks' => array(
                'value' => 105,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'ISMSIndonesia' => array(
                'value' => 106,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SendPK' => array(
                'value' => 107,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'MimSMS' => array(
                'value' => 108,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('API Token') => array('text' => true, 'name' => 'api_token', 'optional' => 1),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                    __('Portal') => array('select' => true, 'name' => 'portal', 'options' => array('BRAND SMS' => 'brand_sms', 'BD PORTAL' => 'bd_portal')),

                ),
            ),
            'OpenMarket' => array(
                'value' => 109,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'MobyT' => array(
                'value' => 110,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TM4B' => array(
                'value' => 111,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SwiftSMSGateway' => array(
                'value' => 112,
                'require_addon' => 1,
                'inputs' => array(
                    __('Account key') => array('text' => true, 'name' => 'account_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            '2Factor' => array(
                'value' => 113,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'GupShup' => array(
                'value' => 114,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Digimiles' => array(
                'value' => 115,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'CallFire' => array(
                'value' => 116,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'NowSMS' => array(
                'value' => 117,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                ),
            ),
            'Releans' => array(
                'value' => 118,
                'require_addon' => 1,
                'inputs' => array(
                    __('API key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'ZipWhip' => array(
                'value' => 119,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                ),
            ),
            'MessageMedia' => array(
                'value' => 120,
                'require_addon' => 1,
                'inputs' => array(
                    __('API key') => array('text' => true, 'name' => 'api_key'),
                    __('API secret') => array('text' => true, 'name' => 'api_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'TheSMSWorks' => array(
                'value' => 121,
                'require_addon' => 1,
                'inputs' => array(
                    __('API key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Mogreet' => array(
                'value' => 122,
                'require_addon' => 1,
                'inputs' => array(
                    __('Client ID') => array('text' => true, 'name' => 'client_id'),
                    __('Token') => array('text' => true, 'name' => 'token'),
                    __('Campaign ID') => array('text' => true, 'name' => 'campaign_id'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            '46elks' => array(
                'value' => 123,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SlickText' => array(
                'value' => 124,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Private key') => array('text' => true, 'name' => 'private_key'),
                ),
            ),
            'SMSIdea' => array(
                'value' => 125,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Tatango' => array(
                'value' => 126,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                ),
            ),
            'SMSEdge' => array(
                'value' => 127,
                'require_addon' => 1,
                'inputs' => array(
                    __('API key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'SMSMasivos' => array(
                'value' => 128,
                'require_addon' => 1,
                'inputs' => array(
                    __('API key') => array('text' => true, 'name' => 'api_key'),
                    __('Country code') => array('text' => true, 'name' => 'country_code'),
                ),
            ),
            'CommzGate' => array(
                'value' => 129,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                ),
            ),
            'SMS.RU' => array(
                'value' => 131,
                'require_addon' => 1,
                'inputs' => array(
                    __('API ID') => array('text' => true, 'name' => 'api_id'),
                    __('From') => array('text' => true, 'name' => 'from', 'optional' => 1),
                ),
            ),
            'Messente' => array(
                'value' => 133,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),
            'Text Marketer' => array(
                'value' => 134,
                'require_addon' => 1,
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Orig') => array('text' => true, 'name' => 'orig'),
                ),
            ),
            'Spring Edge' => array(
                'value' => 135,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),

            'Signalwire' => array(
                'value' => 136,
                'require_addon' => 1,
                'inputs' => array(
                    __('Space URL') => array('text' => true, 'name' => 'space_url'),
                    __('Project ID') => array('text' => true, 'name' => 'project_id'),
                    __('API Token') => array('text' => true, 'name' => 'api_token'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),

            'Camoo' => array(
                'value' => 137,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('API Secret') => array('text' => true, 'name' => 'api_secret'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1),
                ),
            ),

            'CM.com' => array(
                'value' => 138,
                'require_addon' => 1,
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('From') => array('text' => true, 'name' => 'from', 'optional' => 1),
                )
            ),

            'Ooredoo Sms' => array(
                'value' => 139,
                'require_addon' => 1,
                'inputs' => array(
                    __('Mobile') => array('text' => true, 'name' => 'mobile'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1)
                )
            ),
            
            'payam_resan' => array(
                'value' => 141,
                'require_addon' => 1,
                'label' => 'Payam Resan',
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'uname'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1)
                )
            ),
            'foxglove' => array(
                'value' => 142,
                'require_addon' => 1,
                'label' => 'Foxglove Connect',
                'inputs' => array(
                    __('User') => array('text' => true, 'name' => 'user'),
                    __('Account Type') => array('select' => true, 'name' => 'account_type',
                        'options' => array(
                            'Service/Transaction SMS' => '1',
                            'Promotional SMS' => '2',
                            'International SMS' => '3',
                            'OTP SMS' => '6',
                            'Other SMS' => '7',
                        )),
                    __('Sender') => array('text' => true, 'name' => 'sender', 'optional' => 1)
                )
            ),
            'txtsync' => array(
                'value' => 143,
                'require_addon' => 1,
                'label' => 'TxtSync',
                'inputs' => array(
                    __('API Key') => array('text' => true, 'name' => 'api_key'),
                    __('From') => array('text' => true, 'name' => 'from', 'optional' => 1)
                )
            ),
            'serwersms' => array(
                'value' => 144,
                'require_addon' => 1,
                'label' => 'SerwerSMS.pl',
                'inputs' => array(
                    __('Username') => array('text' => true, 'name' => 'username'),
                    __('Password') => array('text' => true, 'name' => 'password'),
                    __('From') => array('text' => true, 'name' => 'from', 'optional' => 1)
                )
            ),
        );
    }


}