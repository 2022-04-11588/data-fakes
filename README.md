![Maatify.dev](https://www.maatify.dev/assets/img/img/maatify_logo_white.svg)

---

[![Version](https://img.shields.io/packagist/v/maatify/data-fakes?label=Version&color=4C1)](https://packagist.org/packages/maatify/data-fakes)
[![PHP](https://img.shields.io/packagist/php-v/maatify/data-fakes?label=PHP&color=777BB3)](https://packagist.org/packages/maatify/data-fakes)
[![Build](https://github.com/Maatify/data-fakes/actions/workflows/test.yml/badge.svg?label=Build&color=brightgreen)](https://github.com/Maatify/data-fakes/actions/workflows/test.yml)

[![Monthly Downloads](https://img.shields.io/packagist/dm/maatify/data-fakes?label=Monthly%20Downloads&color=00A8E8)](https://packagist.org/packages/maatify/data-fakes)
[![Total Downloads](https://img.shields.io/packagist/dt/maatify/data-fakes?label=Total%20Downloads&color=2AA9E0)](https://packagist.org/packages/maatify/data-fakes)

[![Stars](https://img.shields.io/github/stars/Maatify/data-fakes?label=Stars&color=FFD43B&cacheSeconds=3600)](https://github.com/Maatify/data-fakes/stargazers)
[![License](https://img.shields.io/github/license/Maatify/data-fakes?label=License&color=blueviolet)](LICENSE)
[![Status](https://img.shields.io/badge/Status-Stable-success?style=flat-square)]()
[![Code Quality](https://img.shields.io/codefactor/grade/github/Maatify/data-fakes/main?color=brightgreen)](https://www.codefactor.io/repository/github/Maatify/data-fakes)

[![PHPStan](https://img.shields.io/badge/PHPStan-Level%206-4E8CAE)](https://phpstan.org/)
[![Coverage](https://img.shields.io/badge/Coverage-92%25-9C27B0)](#)

[![Changelog](https://img.shields.io/badge/Changelog-View-blue)](CHANGELOG.md)
[![Security](https://img.shields.io/badge/Security-Policy-important)](SECURITY.md)

---

# 📘 Maatify Data Fakes

**In-Memory Fake Adapters for MySQL, Redis, and MongoDB**
**Version:** 1.0.0
**Project:** `maatify/data-fakes`
**Author:** Maatify.dev

---

## 🚀 Overview

`maatify/data-fakes` is a lightweight, deterministic **in-memory data simulation engine** compatible with all official Maatify Data Adapters.

It allows any repository or service to be tested **without real databases**, providing:

* Fake MySQL Adapter
* Fake MySQL DBAL Adapter
* Fake Redis Adapter
* Fake MongoDB Adapter
* Fully deterministic test isolation
* Zero external services required (ideal for CI)

All Fake Adapters follow the exact same contracts used by real adapters.

---

## 🔑 Core Dependencies

The entire library depends on two interfaces:

1. `Maatify\Common\Contracts\Adapter\AdapterInterface`
2. `Maatify\DataAdapters\Contracts\ResolverInterface`

This ensures 1:1 behavior between **fake** and **real** data layers.

---

## 🧩 Features

* In-memory table/collection simulation
* Auto-increment support
* MQL-like operators for fake Mongo
* Redis-like lists, hashes, counters, TTL
* SQL-like filtering, ordering, limit/offset
* Adapter lifecycle support:

    * `connect()`, `disconnect()`
    * `healthCheck()`
    * `isConnected()`
    * `getDriver()`
* Test isolation using a shared `FakeStorageLayer`

---

## 📦 Installation

```bash
composer require maatify/data-fakes --dev
```

This library is intended for **testing environments**, not production.

---

## 🧪 Basic Usage

### Use Fake Resolver

```php
use Maatify\DataFakes\Resolvers\FakeResolver;

$resolver = new FakeResolver();
$db = $resolver->resolve('mysql:main', true);

$rows = $db->select('users', ['id' => 1]);
```

### Reset Between Tests

```php
FakeStorageLayer::reset();
```

---

## 📁 Fake Adapters Included

* `FakeMySQLAdapter`
* `FakeMySQLDbalAdapter`
* `FakeRedisAdapter`
* `FakeMongoAdapter`
* `FakeResolver`

---

## 📝 Documentation

For full implementation details, see:

👉 **[`README.full.md`](README.full.md)**

This includes:

* Architecture design
* Phase breakdown
* API Map
* Class overview
* Tests summary
* Internal notes

---

## 🪪 License

**[MIT license](LICENSE)** © [Maatify.dev](https://www.maatify.dev)  
You’re free to use, modify, and distribute this library with attribution.

---
## 👤 Author
**© 2025 Maatify.dev**  
Engineered by **Mohamed Abdulalim ([@megyptm](https://github.com/megyptm))** — https://www.maatify.dev

📘 Full documentation & source code:  
https://github.com/Maatify/data-fakes

## 🤝 Contributors
Special thanks to the Maatify.dev engineering team and open-source contributors.

---

<p align="center">
  <sub><span style="color:#777">Built with ❤️ by <a href="https://www.maatify.dev">Maatify.dev</a> — Unified Ecosystem for Modern PHP Libraries</span></sub>
</p>

