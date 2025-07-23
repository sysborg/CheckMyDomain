<?php
namespace Sysborg\CheckMyDomain\Lib;

use Sysborg\CheckMyDomain\Exceptions\InvalidDomainException;
use Sysborg\CheckMyDomain\Exceptions\InvalidPrefixException;

class Domain
{
    /**
     * Prefix used in the TXT record.
     *
     * @var string
     */
    protected string $prefix;

    /**
     * Configuration settings.
     *
     * @var array
     */
    protected array $settings;

    /**
     * Constructs the domain instance with settings.
     *
     * @param string $prefix
     * @param array $settings
     */
    public function __construct(string $prefix, array $settings = [])
    {
        if (empty($prefix)) {
            throw new InvalidPrefixException('The prefix cannot be empty.');
        }

        $this->prefix = $prefix;
        $this->settings = $settings;
    }

    /**
     * Generates a DNS TXT record value for domain verification.
     *
     * @param string $domain
     * @param string|null $additional
     * @return string
     */
    public function generateTxtRecord(string $domain, ?string $additional = null): string
    {
        if (empty($domain) || !filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new InvalidDomainException('The provided domain is invalid.');
        }

        $data = ($additional ?? '') . '-' . microtime(true);

        if ($this->settings['use-domain'] ?? false) {
            $data .= '-' . $domain;
        }

        $hash = hash('sha256', $data);

        return $this->prefix . '=' . substr($hash, 0, 60);
    }

    /**
     * Compares an expected TXT record value with actual DNS records from the domain.
     *
     * @param string $domain
     * @param string $expectedRecord
     * @return bool
     */
    public function compareTxtRecord(string $domain, string $expectedRecord): bool
    {
        if (empty($domain) || !filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new InvalidDomainException('The provided domain is invalid.');
        }

        $expectedValue = substr($expectedRecord, strlen($this->prefix) + 1);

        $records = dns_get_record($domain, DNS_TXT);

        foreach ($records as $record) {
            if (isset($record['txt'])) {
                $txt = str_replace('"', '', $record['txt']);

                if (strpos($txt, $this->prefix . '=') === 0) {
                    $value = substr($txt, strlen($this->prefix) + 1);
                    if ($value === $expectedValue) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
