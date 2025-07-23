
# ✅ CheckMyDomain

A lightweight and developer-friendly Laravel package for verifying domain ownership using **DNS TXT records**.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Laravel](https://img.shields.io/badge/laravel-8%20%7C%209%20%7C%2010%20%7C%2011-brightgreen)

---

## 🚀 Features

- 🔐 Verifies domain ownership via DNS TXT records.
- ⚙️ Easily configurable and customizable.
- 🔗 Prefix-based hashing for safe and unique TXT records.
- ⚡ Simple to integrate into any Laravel project.

---

## 📦 Installation

```bash
composer require sysborg/check-my-domain
````

---

## 🛠️ Configuration

Optionally publish the configuration file:

```bash
php artisan vendor:publish --tag=check-my-domain-config
```

This will publish the file to:
`config/checkMyDomain.php`

### Example config (`config/checkMyDomain.php`)

```php
return [

    'prefix' => 'sbv',

    'settings' => [
        'use-domain' => true,
    ],
];
```

| Key          | Description                                                |
| ------------ | ---------------------------------------------------------- |
| `prefix`     | Prefix used in the TXT record name/value (e.g., `sbv=...`) |
| `use-domain` | If `true`, includes the domain name in the generated hash  |

---

## 🧠 Usage

### Injecting the Service

```php
use Facades\Sysborg\CheckMyDomain\Lib\Domain;

$domainService = Domain::methodName(...parameters);
```

### Generating a TXT Record

```php
$record = Domain::generateTxtRecord('example.com', 'user-123');

// Output: sbv=4f8a3bd9eabf3c22bb9a5e2dd5c03f4c8ae6d2ef9f709137b20a2fd4e9d1
```

### Validating Against DNS

```php
$isVerified = Domain::compareTxtRecord('example.com', $record);

if ($isVerified) {
    echo '✅ Domain verified successfully!';
} else {
    echo '❌ Domain verification failed.';
}
```

---

## 🧪 Testing

```bash
composer test
```

Or use PHPUnit directly if configured:

```bash
./vendor/bin/phpunit
```

---

## 📁 Directory Structure

```
src/
├── config/
│   └── checkMyDomain.php
├── Exceptions/
│   ├── InvalidDomainException.php
│   └── InvalidPrefixException.php
├── Lib/
│   └── Domain.php
├── Providers/
│   └── CheckMyDomainProvider.php
```

---

## 📚 How It Works

1. The package generates a unique hash based on your prefix, user ID, domain, and timestamp.
2. The user adds the TXT record to their DNS zone (e.g. `sbv=abcdef123456...`).
3. You use `compareTxtRecord()` to query the domain and validate if the correct TXT record is present.

This makes it easy to verify domain ownership for:

* User-generated domains
* SaaS onboarding
* API clients or webhook callbacks

---

## 🧩 Integration Ideas

* 🔗 Connect to onboarding flows (verify user domains).
* 🛡️ Add protection to webhook registration or integrations.
* ⚙️ Automate DNS verification with APIs like Cloudflare.

---

## 👥 Credits

Maintained by [Sysborg](https://sysborg.com.br)
Created by [Anderson Arruda](mailto:andmarruda@gmail.com)

---

## 📄 License

MIT License. See [LICENSE](LICENSE) file for details.
