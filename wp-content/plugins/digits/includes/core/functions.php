<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once('functionUnicode.php');
require_once('dig_geo.php');
require_once('phandler.php');

require_once 'enqueue/enqueue_scripts.php';
require_once 'enqueue/gateway_scripts.php';


function digits_update_mobile($user_id, $countrycode, $phone)
{
    update_user_meta($user_id, 'digt_countrycode', $countrycode);
    update_user_meta($user_id, 'digits_phone_no', $phone);
    update_user_meta($user_id, 'digits_phone', $countrycode . $phone);
}

function digits_delete_mobile($user_id)
{
    delete_user_meta($user_id, 'digt_countrycode');
    delete_user_meta($user_id, 'digits_phone_no');
    delete_user_meta($user_id, 'digits_phone');
}

function getCountryList()
{
    return array(
        "Afghanistan" => "93",
        "Albania" => "355",
        "Algeria" => "213",
        "American Samo" => "1",
        "Andorra" => "376",
        "Angola" => "244",
        "Anguilla" => "1",
        "Antigua" => "1",
        "Argentina" => "54",
        "Armenia" => "374",
        "Aruba" => "297",
        "Australia" => "61",
        "Austria" => "43",
        "Azerbaijan" => "994",
        "Bahrain" => "973",
        "Bangladesh" => "880",
        "Barbados" => "1",
        "Belarus" => "375",
        "Belgium" => "32",
        "Belize" => "501",
        "Benin" => "229",
        "Bermuda" => "1",
        "Bhutan" => "975",
        "Bolivia" => "591",
        "Bonaire, Sint Eustatius and Saba" => "599",
        "Bosnia and Herzegovina" => "387",
        "Botswana" => "267",
        "Brazil" => "55",
        "British Indian Ocean Territory" => "246",
        "British Virgin Islands" => "1",
        "Brunei" => "673",
        "Bulgaria" => "359",
        "Burkina Faso" => "226",
        "Burundi" => "257",
        "Cambodia" => "855",
        "Cameroon" => "237",
        "Canada" => "1",
        "Cape Verde" => "238",
        "Cayman Islands" => "1",
        "Central African Republic" => "236",
        "Chad" => "235",
        "Chile" => "56",
        "China" => "86",
        "Colombia" => "57",
        "Comoros" => "269",
        "Cook Islands" => "682",
        "Ivory Coast" => "225",
        "Costa Rica" => "506",
        "Croatia" => "385",
        "Cuba" => "53",
        "Curaçao" => "599",
        "Cyprus" => "357",
        "Czech Republic" => "420",
        "Democratic Republic of the Congo" => "243",
        "Denmark" => "45",
        "Djibouti" => "253",
        "Dominica" => "1",
        "Dominican Republic" => "1",
        "Ecuador" => "593",
        "Egypt" => "20",
        "El Salvador" => "503",
        "Equatorial Guinea" => "240",
        "Eritrea" => "291",
        "Estonia" => "372",
        "Ethiopia" => "251",
        "Falkland Islands" => "500",
        "Faroe Islands" => "298",
        "Federated States of Micronesia" => "691",
        "Fiji" => "679",
        "Finland" => "358",
        "France" => "33",
        "French Guiana" => "594",
        "French Polynesia" => "689",
        "Gabon" => "241",
        "Georgia" => "995",
        "Germany" => "49",
        "Ghana" => "233",
        "Gibraltar" => "350",
        "Greece" => "30",
        "Greenland" => "299",
        "Grenada" => "1",
        "Guadeloupe" => "590",
        "Guam" => "1",
        "Guatemala" => "502",
        "Guernsey" => "44",
        "Guinea" => "224",
        "Guinea-Bissau" => "245",
        "Guyana" => "592",
        "Haiti" => "509",
        "Honduras" => "504",
        "Hong Kong" => "852",
        "Hungary" => "36",
        "Iceland" => "354",
        "India" => "91",
        "Indonesia" => "62",
        "Iran" => "98",
        "Iraq" => "964",
        "Ireland" => "353",
        "Isle Of Man" => "44",
        "Israel" => "972",
        "Italy" => "39",
        "Jamaica" => "1",
        "Japan" => "81",
        "Jersey" => "44",
        "Jordan" => "962",
        "Kazakhstan" => "7",
        "Kenya" => "254",
        "Kiribati" => "686",
        "Kuwait" => "965",
        "Kyrgyzstan" => "996",
        "Laos" => "856",
        "Latvia" => "371",
        "Lebanon" => "961",
        "Lesotho" => "266",
        "Liberia" => "231",
        "Libya" => "218",
        "Liechtenstein" => "423",
        "Lithuania" => "370",
        "Luxembourg" => "352",
        "Macau" => "853",
        "Macedonia" => "389",
        "Madagascar" => "261",
        "Malawi" => "265",
        "Malaysia" => "60",
        "Maldives" => "960",
        "Mali" => "223",
        "Malta" => "356",
        "Marshall Islands" => "692",
        "Martinique" => "596",
        "Mauritania" => "222",
        "Mauritius" => "230",
        "Mayotte" => "262",
        "Mexico" => "52",
        "Moldova" => "373",
        "Monaco" => "377",
        "Mongolia" => "976",
        "Montenegro" => "382",
        "Montserrat" => "1",
        "Morocco" => "212",
        "Mozambique" => "258",
        "Myanmar" => "95",
        "Namibia" => "264",
        "Nauru" => "674",
        "Nepal" => "977",
        "Netherlands" => "31",
        "New Caledonia" => "687",
        "New Zealand" => "64",
        "Nicaragua" => "505",
        "Niger" => "227",
        "Nigeria" => "234",
        "Niue" => "683",
        "Norfolk Island" => "672",
        "North Korea" => "850",
        "Northern Mariana Islands" => "1",
        "Norway" => "47",
        "Oman" => "968",
        "Pakistan" => "92",
        "Palau" => "680",
        "Palestine" => "970",
        "Panama" => "507",
        "Papua New Guinea" => "675",
        "Paraguay" => "595",
        "Peru" => "51",
        "Philippines" => "63",
        "Poland" => "48",
        "Portugal" => "351",
        "Puerto Rico" => "1",
        "Qatar" => "974",
        "Republic of the Congo" => "242",
        "Romania" => "40",
        "Runion" => "262",
        "Russia" => "7",
        "Rwanda" => "250",
        "Saint Helena" => "290",
        "Saint Kitts and Nevis" => "1",
        "Saint Pierre and Miquelon" => "508",
        "Saint Vincent and the Grenadines" => "1",
        "Samoa" => "685",
        "San Marino" => "378",
        "Sao Tome and Principe" => "239",
        "Saudi Arabia" => "966",
        "Senegal" => "221",
        "Serbia" => "381",
        "Seychelles" => "248",
        "Sierra Leone" => "232",
        "Singapore" => "65",
        "Sint Maarten" => "1",
        "Slovakia" => "421",
        "Slovenia" => "386",
        "Solomon Islands" => "677",
        "Somalia" => "252",
        "South Africa" => "27",
        "South Korea" => "82",
        "South Sudan" => "211",
        "Spain" => "34",
        "Sri Lanka" => "94",
        "St. Lucia" => "1",
        "Sudan" => "249",
        "Suriname" => "597",
        "Swaziland" => "268",
        "Sweden" => "46",
        "Switzerland" => "41",
        "Syria" => "963",
        "Taiwan" => "886",
        "Tajikistan" => "992",
        "Tanzania" => "255",
        "Thailand" => "66",
        "The Bahamas" => "1",
        "The Gambia" => "220",
        "Timor-Leste" => "670",
        "Togo" => "228",
        "Tokelau" => "690",
        "Tonga" => "676",
        "Trinidad and Tobago" => "1",
        "Tunisia" => "216",
        "Turkey" => "90",
        "Turkmenistan" => "993",
        "Turks and Caicos Islands" => "1",
        "Tuvalu" => "688",
        "U.S. Virgin Islands" => "1",
        "Uganda" => "256",
        "Ukraine" => "380",
        "United Arab Emirates" => "971",
        "United Kingdom" => "44",
        "United States" => "1",
        "Uruguay" => "598",
        "Uzbekistan" => "998",
        "Vanuatu" => "678",
        "Venezuela" => "58",
        "Vietnam" => "84",
        "Wallis and Futuna" => "681",
        "Western Sahara" => "212",
        "Yemen" => "967",
        "Zambia" => "260",
        "Zimbabw" => "263"
    );

}

function getTranslatedCountryName($countryName)
{
    $data = array(
        "Afghanistan" => __("Afghanistan", "digits"),
        "Albania" => __("Albania", "digits"),
        "Algeria" => __("Algeria", "digits"),
        "American Samo" => __("American Samoa", "digits"),
        "Andorra" => __("Andorra", "digits"),
        "Angola" => __("Angola", "digits"),
        "Anguilla" => __("Anguilla", "digits"),
        "Antigua" => __("Antigua", "digits"),
        "Argentina" => __("Argentina", "digits"),
        "Armenia" => __("Armenia", "digits"),
        "Aruba" => __("Aruba", "digits"),
        "Australia" => __("Australia", "digits"),
        "Austria" => __("Austria", "digits"),
        "Azerbaijan" => __("Azerbaijan", "digits"),
        "Bahrain" => __("Bahrain", "digits"),
        "Bangladesh" => __("Bangladesh", "digits"),
        "Barbados" => __("Barbados", "digits"),
        "Belarus" => __("Belarus", "digits"),
        "Belgium" => __("Belgium", "digits"),
        "Belize" => __("Belize", "digits"),
        "Benin" => __("Benin", "digits"),
        "Bermuda" => __("Bermuda", "digits"),
        "Bhutan" => __("Bhutan", "digits"),
        "Bolivia" => __("Bolivia", "digits"),
        "Bonaire, Sint Eustatius and Saba" => __("Bonaire, Sint Eustatius and Saba", "digits"),
        "Bosnia and Herzegovina" => __("Bosnia and Herzegovina", "digits"),
        "Botswana" => __("Botswana", "digits"),
        "Brazil" => __("Brazil", "digits"),
        "British Indian Ocean Territory" => __("British Indian Ocean Territory", "digits"),
        "British Virgin Islands" => __("British Virgin Islands", "digits"),
        "Brunei" => __("Brunei", "digits"),
        "Bulgaria" => __("Bulgaria", "digits"),
        "Burkina Faso" => __("Burkina Faso", "digits"),
        "Burundi" => __("Burundi", "digits"),
        "Cambodia" => __("Cambodia", "digits"),
        "Cameroon" => __("Cameroon", "digits"),
        "Canada" => __("Canada", "digits"),
        "Cape Verde" => __("Cape Verde", "digits"),
        "Cayman Islands" => __("Cayman Islands", "digits"),
        "Central African Republic" => __("Central African Republic", "digits"),
        "Chad" => __("Chad", "digits"),
        "Chile" => __("Chile", "digits"),
        "China" => __("China", "digits"),
        "Colombia" => __("Colombia", "digits"),
        "Comoros" => __("Comoros", "digits"),
        "Cook Islands" => __("Cook Islands", "digits"),
        "Costa Rica" => __("Costa Rica", "digits"),
        "Croatia" => __("Croatia", "digits"),
        "Cuba" => __("Cuba", "digits"),
        "Curaçao" => __("Curaçao", "digits"),
        "Cyprus" => __("Cyprus", "digits"),
        "Czech Republic" => __("Czech Republic", "digits"),
        "Democratic Republic of the Congo" => __("Democratic Republic of the Congo", "digits"),
        "Denmark" => __("Denmark", "digits"),
        "Djibouti" => __("Djibouti", "digits"),
        "Dominica" => __("Dominica", "digits"),
        "Dominican Republic" => __("Dominican Republic", "digits"),
        "Ecuador" => __("Ecuador", "digits"),
        "Egypt" => __("Egypt", "digits"),
        "El Salvador" => __("El Salvador", "digits"),
        "Equatorial Guinea" => __("Equatorial Guinea", "digits"),
        "Eritrea" => __("Eritrea", "digits"),
        "Estonia" => __("Estonia", "digits"),
        "Ethiopia" => __("Ethiopia", "digits"),
        "Falkland Islands" => __("Falkland Islands", "digits"),
        "Faroe Islands" => __("Faroe Islands", "digits"),
        "Federated States of Micronesia" => __("Federated States of Micronesia", "digits"),
        "Fiji" => __("Fiji", "digits"),
        "Finland" => __("Finland", "digits"),
        "France" => __("France", "digits"),
        "French Guiana" => __("French Guiana", "digits"),
        "French Polynesia" => __("French Polynesia", "digits"),
        "Gabon" => __("Gabon", "digits"),
        "Georgia" => __("Georgia", "digits"),
        "Germany" => __("Germany", "digits"),
        "Ghana" => __("Ghana", "digits"),
        "Gibraltar" => __("Gibraltar", "digits"),
        "Greece" => __("Greece", "digits"),
        "Greenland" => __("Greenland", "digits"),
        "Grenada" => __("Grenada", "digits"),
        "Guadeloupe" => __("Guadeloupe", "digits"),
        "Guam" => __("Guam", "digits"),
        "Guatemala" => __("Guatemala", "digits"),
        "Guernsey" => __("Guernsey", "digits"),
        "Guinea" => __("Guinea", "digits"),
        "Guinea-Bissau" => __("Guinea-Bissau", "digits"),
        "Guyana" => __("Guyana", "digits"),
        "Haiti" => __("Haiti", "digits"),
        "Honduras" => __("Honduras", "digits"),
        "Hong Kong" => __("Hong Kong", "digits"),
        "Hungary" => __("Hungary", "digits"),
        "Iceland" => __("Iceland", "digits"),
        "India" => __("India", "digits"),
        "Indonesia" => __("Indonesia", "digits"),
        "Iran" => __("Iran", "digits"),
        "Iraq" => __("Iraq", "digits"),
        "Ireland" => __("Ireland", "digits"),
        "Isle Of Man" => __("Isle Of Man", "digits"),
        "Israel" => __("Israel", "digits"),
        "Italy" => __("Italy", "digits"),
        "Ivory Coast" => __("Côte d'Ivoire", "digits"),
        "Jamaica" => __("Jamaica", "digits"),
        "Japan" => __("Japan", "digits"),
        "Jersey" => __("Jersey", "digits"),
        "Jordan" => __("Jordan", "digits"),
        "Kazakhstan" => __("Kazakhstan", "digits"),
        "Kenya" => __("Kenya", "digits"),
        "Kiribati" => __("Kiribati", "digits"),
        "Kuwait" => __("Kuwait", "digits"),
        "Kyrgyzstan" => __("Kyrgyzstan", "digits"),
        "Laos" => __("Laos", "digits"),
        "Latvia" => __("Latvia", "digits"),
        "Lebanon" => __("Lebanon", "digits"),
        "Lesotho" => __("Lesotho", "digits"),
        "Liberia" => __("Liberia", "digits"),
        "Libya" => __("Libya", "digits"),
        "Liechtenstein" => __("Liechtenstein", "digits"),
        "Lithuania" => __("Lithuania", "digits"),
        "Luxembourg" => __("Luxembourg", "digits"),
        "Macau" => __("Macau", "digits"),
        "Macedonia" => __("Macedonia", "digits"),
        "Madagascar" => __("Madagascar", "digits"),
        "Malawi" => __("Malawi", "digits"),
        "Malaysia" => __("Malaysia", "digits"),
        "Maldives" => __("Maldives", "digits"),
        "Mali" => __("Mali", "digits"),
        "Malta" => __("Malta", "digits"),
        "Marshall Islands" => __("Marshall Islands", "digits"),
        "Martinique" => __("Martinique", "digits"),
        "Mauritania" => __("Mauritania", "digits"),
        "Mauritius" => __("Mauritius", "digits"),
        "Mayotte" => __("Mayotte", "digits"),
        "Mexico" => __("Mexico", "digits"),
        "Moldova" => __("Moldova", "digits"),
        "Monaco" => __("Monaco", "digits"),
        "Mongolia" => __("Mongolia", "digits"),
        "Montenegro" => __("Montenegro", "digits"),
        "Montserrat" => __("Montserrat", "digits"),
        "Morocco" => __("Morocco", "digits"),
        "Mozambique" => __("Mozambique", "digits"),
        "Myanmar" => __("Myanmar", "digits"),
        "Namibia" => __("Namibia", "digits"),
        "Nauru" => __("Nauru", "digits"),
        "Nepal" => __("Nepal", "digits"),
        "Netherlands" => __("Netherlands", "digits"),
        "New Caledonia" => __("New Caledonia", "digits"),
        "New Zealand" => __("New Zealand", "digits"),
        "Nicaragua" => __("Nicaragua", "digits"),
        "Niger" => __("Niger", "digits"),
        "Nigeria" => __("Nigeria", "digits"),
        "Niue" => __("Niue", "digits"),
        "Norfolk Island" => __("Norfolk Island", "digits"),
        "North Korea" => __("North Korea", "digits"),
        "Northern Mariana Islands" => __("Northern Mariana Islands", "digits"),
        "Norway" => __("Norway", "digits"),
        "Oman" => __("Oman", "digits"),
        "Pakistan" => __("Pakistan", "digits"),
        "Palau" => __("Palau", "digits"),
        "Palestine" => __("Palestine", "digits"),
        "Panama" => __("Panama", "digits"),
        "Papua New Guinea" => __("Papua New Guinea", "digits"),
        "Paraguay" => __("Paraguay", "digits"),
        "Peru" => __("Peru", "digits"),
        "Philippines" => __("Philippines", "digits"),
        "Poland" => __("Poland", "digits"),
        "Portugal" => __("Portugal", "digits"),
        "Puerto Rico" => __("Puerto Rico", "digits"),
        "Qatar" => __("Qatar", "digits"),
        "Republic of the Congo" => __("Republic of the Congo", "digits"),
        "Romania" => __("Romania", "digits"),
        "Runion" => __("Runion", "digits"),
        "Russia" => __("Russia", "digits"),
        "Rwanda" => __("Rwanda", "digits"),
        "Saint Helena" => __("Saint Helena", "digits"),
        "Saint Kitts and Nevis" => __("Saint Kitts and Nevis", "digits"),
        "Saint Pierre and Miquelon" => __("Saint Pierre and Miquelon", "digits"),
        "Saint Vincent and the Grenadines" => __("Saint Vincent and the Grenadines", "digits"),
        "Samoa" => __("Samoa", "digits"),
        "San Marino" => __("San Marino", "digits"),
        "Sao Tome and Principe" => __("Sao Tome and Principe", "digits"),
        "Saudi Arabia" => __("Saudi Arabia", "digits"),
        "Senegal" => __("Senegal", "digits"),
        "Serbia" => __("Serbia", "digits"),
        "Seychelles" => __("Seychelles", "digits"),
        "Sierra Leone" => __("Sierra Leone", "digits"),
        "Singapore" => __("Singapore", "digits"),
        "Sint Maarten" => __("Sint Maarten", "digits"),
        "Slovakia" => __("Slovakia", "digits"),
        "Slovenia" => __("Slovenia", "digits"),
        "Solomon Islands" => __("Solomon Islands", "digits"),
        "Somalia" => __("Somalia", "digits"),
        "South Africa" => __("South Africa", "digits"),
        "South Korea" => __("South Korea", "digits"),
        "South Sudan" => __("South Sudan", "digits"),
        "Spain" => __("Spain", "digits"),
        "Sri Lanka" => __("Sri Lanka", "digits"),
        "St. Lucia" => __("St. Lucia", "digits"),
        "Sudan" => __("Sudan", "digits"),
        "Suriname" => __("Suriname", "digits"),
        "Swaziland" => __("Swaziland", "digits"),
        "Sweden" => __("Sweden", "digits"),
        "Switzerland" => __("Switzerland", "digits"),
        "Syria" => __("Syria", "digits"),
        "Taiwan" => __("Taiwan", "digits"),
        "Tajikistan" => __("Tajikistan", "digits"),
        "Tanzania" => __("Tanzania", "digits"),
        "Thailand" => __("Thailand", "digits"),
        "The Bahamas" => __("The Bahamas", "digits"),
        "The Gambia" => __("The Gambia", "digits"),
        "Timor-Leste" => __("Timor-Leste", "digits"),
        "Togo" => __("Togo", "digits"),
        "Tokelau" => __("Tokelau", "digits"),
        "Tonga" => __("Tonga", "digits"),
        "Trinidad and Tobago" => __("Trinidad and Tobago", "digits"),
        "Tunisia" => __("Tunisia", "digits"),
        "Turkey" => __("Turkey", "digits"),
        "Turkmenistan" => __("Turkmenistan", "digits"),
        "Turks and Caicos Islands" => __("Turks and Caicos Islands", "digits"),
        "Tuvalu" => __("Tuvalu", "digits"),
        "U.S. Virgin Islands" => __("U.S. Virgin Islands", "digits"),
        "Uganda" => __("Uganda", "digits"),
        "Ukraine" => __("Ukraine", "digits"),
        "United Arab Emirates" => __("United Arab Emirates", "digits"),
        "United Kingdom" => __("United Kingdom", "digits"),
        "United States" => __("United States", "digits"),
        "Uruguay" => __("Uruguay", "digits"),
        "Uzbekistan" => __("Uzbekistan", "digits"),
        "Vanuatu" => __("Vanuatu", "digits"),
        "Venezuela" => __("Venezuela", "digits"),
        "Vietnam" => __("Vietnam", "digits"),
        "Wallis and Futuna" => __("Wallis and Futuna", "digits"),
        "Western Sahara" => __("Western Sahara", "digits"),
        "Yemen" => __("Yemen", "digits"),
        "Zambia" => __("Zambia", "digits"),
        "Zimbabw" => __("Zimbabwe", "digits"),
    );

    return $data[$countryName];

}


function getCountryCode($country)
{

    if ($country == "") {
        return '';
    }
    $countryarray = getCountryList();


    $whiteListCountryCodes = get_option("whitelistcountrycodes");


    if (is_array($whiteListCountryCodes)) {
        $size = sizeof($whiteListCountryCodes);

        if ($size > 0) {
            if (!in_array($country, $whiteListCountryCodes)) {
                $defaultccode = get_option("dig_default_ccode");
                if (!in_array($defaultccode, $whiteListCountryCodes)) {
                    return $countryarray[$whiteListCountryCodes[0]];
                } else {
                    return $countryarray[$defaultccode];
                }
            }
        }

    }

    if (array_key_exists($country, $countryarray)) {
        return $countryarray[$country];
    } else {
        return '';
    }
}

function digCountry()
{

    $countryList = getCountryList();
    $valCon = "";
    $currentCountry = getUserCountryCode();
    $whiteListCountryCodes = get_option("whitelistcountrycodes");
    $blacklistcountrycodes = get_option("dig_blacklistcountrycodes");

    $size = 0;
    if (is_array($whiteListCountryCodes)) {
        $size = sizeof($whiteListCountryCodes);
    }

    $is_mobile = wp_is_mobile();


    foreach ($countryList as $key => $value) {
        $ac = "";


        if (is_array($whiteListCountryCodes) && !empty($whiteListCountryCodes)) {
            if ($size > 0) {
                if (!in_array($key, $whiteListCountryCodes)) {
                    continue;
                }
            }
        }
        if (!empty($blacklistcountrycodes)) {
            if (in_array($key, $blacklistcountrycodes)) {
                continue;
            }
        }


        if ($currentCountry == '+' . $value) {
            $ac = "selected";
        }


        $valCon .= '<li class="dig-cc-visible ' . $ac . '" value="' . $value . '" data-country="' . strtolower($key) . '">(+' . $value . ') ' . getTranslatedCountryName($key) . '</li>';
    }

    $class = '';
    $stype = 'list';
    if ($is_mobile) {
        $stype = 'mobile';
        $class = 'digits-mobile-list';
        $valCon .= '<li class="spacer" disabled=""></li>';
    }


    $list = '<ul class="digit_cs-list digits_scrollbar ' . $class . '" style="display: none;" data-type="' . $stype . '">' . $valCon . '</ul>';

    if ($is_mobile) {
        $search = '<div class="digits-countrycode-search"><div class="digits-hide-countrycode"></div><input type="text" class="countrycode_search regular-text"></div>';
        $list = '<div class="digits-fullscreen">' . $list . $search . '</div>';
    }
    echo $list;
}


function dig_sanitize($input)
{

    // Initialize the new array that will hold the sanitize values
    $new_input = array();

    // Loop through the input and sanitize each of the values
    foreach ($input as $key => $val) {
        $new_input[$key] = sanitize_text_field($val);
    }

    return $new_input;

}


function dig_isWhatsAppEnabled()
{
    $whatsapp_gateway = get_option('digit_whatsapp_gateway', -1);

    return $whatsapp_gateway == -1 ? false : true;
}