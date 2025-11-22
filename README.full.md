# 📘 Maatify Data Fakes

**Full Project Documentation**
**Project:** `maatify/data-fakes`
**Maintained by:** Maatify.dev
**Purpose:** Complete in-memory simulation toolkit for MySQL, DBAL, Redis, and MongoDB adapters — used for testing, fixtures, and adapter-agnostic repository validation.

---

# 📚 Overview

`maatify/data-fakes` provides a **deterministic, fully in-memory simulation layer** for all Maatify data adapters.
Its primary mission is to allow:

* Testing repositories **without real databases**
* Running CI pipelines **without external services**
* Achieving identical behavior between **fake adapters** and **real adapters**

The library depends fundamentally on two core interfaces:

### 🔑 Core Interfaces

1. **AdapterInterface**
   `Maatify\Common\Contracts\Adapter\AdapterInterface`

2. **ResolverInterface**
   `Maatify\DataAdapters\Contracts\ResolverInterface`

Every Fake Adapter **fully implements AdapterInterface** and is **routed using ResolverInterface**, ensuring 1:1 compatibility with real adapters.

---

# 🧱 Architecture Summary

The architecture is built around:

### 🧩 FakeStorageLayer

A deterministic, isolated in-memory store powering all fake adapters.
Provides:

* Table/collection memory mapping
* Auto-increment IDs
* Reset/Drop
* Deterministic read/write operations
* Query helpers for MySQL/Redis/Mongo

### 🧩 Fake Adapters (per technology)

* Fake MySQL Adapter
* Fake MySQL DBAL Adapter
* Fake Redis Adapter
* Fake Mongo Adapter

Each adapter behaves the same as its real counterpart in the Maatify ecosystem.

### 🧩 Fake Resolver

Routes requests (`mysql:main`, `redis:cache`, `mongo:default`) to the correct Fake Adapter.

---

# 🧪 Testing Philosophy

The library is designed so repositories can be tested:

* With **real adapters**
* With **fake adapters**
* Using the **same test cases**

This guarantees API-level consistency across the entire Maatify ecosystem.

---

# 🚀 Versioned Development Phases

Below are all phases, merged, organized, and ready for `README.full.md`.

---

# Phase 1 — Project Bootstrap & Core Architecture

**Version:** 1.0.0  
**Project:** maatify/data-fakes

---

## 🎯 Objective

Establish the foundational architecture for the entire project.
This includes:

* Base storage engine
* Base contracts
* Base resolver contract
* Initial testing bootstrap
* Compliance with core Maatify policies

The phase is entirely dependent on:

* `AdapterInterface`
* `ResolverInterface`

These guarantee compatibility between fake adapters and real adapters.

---

## 📦 Deliverables

### Contracts

```
src/Contracts/FakeAdapterInterface.php
src/Contracts/FakeRepositoryInterface.php
src/Contracts/FakeResolverInterface.php
```

### Core Storage Layer

```
src/Storage/FakeStorageLayer.php
```

### Base Adapter

```
src/Adapters/Base/AbstractFakeAdapter.php
```

### Bootstrap Files

```
composer.json
phpunit.xml
README.md
```

### Tests

```
tests/bootstrap.php
tests/Storage/FakeStorageLayerTest.php
```

---

## 🧩 Architecture Summary

* Introduces the core storage system
* Defines fake adapter & repository contracts
* Sets deterministic behavior for all fake drivers
* Establishes full test isolation

---

## 🧪 Test Setup Highlights

* PHPUnit bootstrap
* Deterministic memory layer
* CRUD operations validated

---

# Phase 2 — Fake MySQL & DBAL Adapter

**Version:** 1.0.0 
**Completed:** 2025-11-22

---

## 🎯 Goals

* Implement a complete fake MySQL engine
* Create DBAL wrapper (Doctrine-style)
* Provide filters, ordering, limiting
* Implement full AdapterInterface lifecycle
* Integrate traits:

    * NormalizesInputTrait
    * QueryFilterTrait
* Expand FakeStorageLayer to support SQL-like behavior
* Provide 90%+ test coverage

---

## 📁 Deliverables

### Adapters

```
src/Adapters/MySQL/FakeMySQLAdapter.php
src/Adapters/MySQL/FakeMySQLDbalAdapter.php
```

### Traits

```
src/Adapters/Base/Traits/NormalizesInputTrait.php
src/Adapters/Base/Traits/QueryFilterTrait.php
```

### Updated Storage Layer

```
src/Storage/FakeStorageLayer.php
```

### Tests

```
tests/Adapters/FakeMySQLAdapterTest.php
tests/Adapters/FakeMySQLDbalAdapterTest.php
tests/Storage/FakeStorageLayerTest.php
```

---

## 🧪 Tests Summary

| Test Area                 | Status   |
|---------------------------|----------|
| CRUD operations           | ✅ Passed |
| Filters (IN / Contains)   | ✅ Passed |
| Ordering ASC/DESC         | ✅ Passed |
| LIMIT / OFFSET            | ✅ Passed |
| DBAL wrapper              | ✅ Passed |
| Adapter lifecycle         | ✅ Passed |
| Storage layer consistency | ✅ Passed |

* Coverage: **92%**
* PHPStan: **Level 6 (clean)**

---

## ✨ Reflection Summary

### New Classes

* `FakeMySQLAdapter`
* `FakeMySQLDbalAdapter`

### Updated

* `FakeStorageLayer`

### Key Methods

* connect / disconnect / healthCheck
* select / insert / update / delete
* fetchAll / fetchOne

---

# Phase 3 — Fake Redis Adapter

**Version:** 1.0.0  
**Completed:** 2025-11-22

---

## 🎯 Goals

* Provide deterministic Redis simulation
* Support:

    * Strings
    * Hashes
    * Lists
    * Counters
    * TTL
* Implement full AdapterInterface
* Use normalizers + adapter lifecycle
* Ensure Redis cache layers in Maatify can be fully tested

---

## 📁 Deliverables

```
src/Adapters/Redis/FakeRedisAdapter.php
tests/Adapters/FakeRedisAdapterTest.php
```

---

## 🧪 Tests Summary

* get/set/del
* TTL
* hset/hget/hdel
* lpush/rpush/lrange
* incr/decr
* Resolver routing
* All tests passed
* PHPStan level 6 clean

---

## 🔧 Notes

* TTL implemented via monotonic clock
* Behavior matches phpredis/predis patterns
* No mixed types

---

# Phase 4 — Fake MongoDB Adapter

**Version:** 1.0.0
**Completed:** 2025-11-22

---

## 🎯 Goals

* Provide in-memory simulation of Mongo collections
* Support:

    * insertOne / insertMany
    * find / findOne
    * updateOne
    * deleteOne
* Query operators:

    * `$eq`, `$ne`, `$in`, `$nin`
    * `$gt`, `$gte`, `$lt`, `$lte`
* Deterministic behavior
* Full AdapterInterface lifecycle
* Integration with FakeResolver

---

## 📁 Deliverables

```
src/Adapters/Mongo/FakeMongoAdapter.php
tests/Adapters/FakeMongoAdapterTest.php
```

---

## 🧠 Architecture Summary

* Collections stored under `storage['mongo'][collection]`
* Auto-ID insertion
* Deterministic matching logic
* Zero-mixed-type rules
* PHPStan level 6 clean

---

## 🧪 Tests

* Full CRUD
* All operators
* Resolver routing
* Storage determinism

---

# 🗺️ API Map (Phase 1 → Phase 4)

## Contracts

* FakeAdapterInterface
* FakeRepositoryInterface
* FakeResolverInterface

## Storage

* FakeStorageLayer

## Base Adapters

* AbstractFakeAdapter

## MySQL

* FakeMySQLAdapter
* FakeMySQLDbalAdapter

## Redis

* FakeRedisAdapter

## Mongo

* FakeMongoAdapter

---

# 🧩 How To Use

### With Fake Resolver

```php
$resolver = new FakeResolver();
$mysql = $resolver->resolve('mysql:main', true);
$rows = $mysql->select('users', ['id' => 1]);
```

### Reset Between Tests

```php
FakeStorageLayer::reset();
```

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
