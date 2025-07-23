<?php
return [
    /*
    |--------------------------------------------------------------------------
    | TXT Record Prefix
    |--------------------------------------------------------------------------
    |
    | This value is used as a prefix for generating the DNS TXT record
    | required for domain verification. For example, a generated record
    | may look like: "sbv-abc123".
    |
    */
    "prefix" => "sbv",

    /*
    |--------------------------------------------------------------------------
    | Domain Validation Settings
    |--------------------------------------------------------------------------
    |
    | Here you may configure specific settings related to domain verification.
    | You can choose whether to include the domain name in the generated
    | hash to ensure that each validation is unique to the domain.
    |
    */
    "settings" => [
        "use-domain" => true,
    ]
];