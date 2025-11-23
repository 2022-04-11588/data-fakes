# 📘 Maatify Data Fakes

**In-Memory Fake Adapters for MySQL, Redis, MongoDB & Repository Layer**  
**Version:** 1.0.2  
**Project:** `maatify/data-fakes`  
**Maintained by:** Maatify.dev

---

## 📌 TL;DR — Summary

`maatify/data-fakes` is the official **fully deterministic in-memory testing engine**
for the Maatify ecosystem. It simulates MySQL, DBAL, Redis, and MongoDB adapters
with zero external services required.

### ✨ Instant Highlights
- Fake MySQL Adapter (filters, sort, limit, transactions via snapshots)
- Fake DBAL Adapter (Doctrine-like API)
- Fake Mongo Adapter with query operators
- Fake Redis Adapter (strings, lists, hashes, counters, TTL)
- Shared deterministic memory engine
- FakeRepository & FakeCollection layer
- **Snapshot Engine + Unit of Work (Phase 6)**
- **Fixtures Loader + FakeEnvironment (Phase 7)**
- Test isolation with auto-reset
- 100% compatible with real adapters in `maatify/data-adapters`

> Built for PHPUnit, CI pipelines, fast tests, and full repository simulation.

## 🚀 Overview

`maatify/data-fakes` is a lightweight and deterministic **in-memory simulation layer**
designed for testing repositories, services, and adapters across the Maatify ecosystem.
It recreates the behavior of MySQL, DBAL, Redis, and MongoDB drivers — using the same
contracts as real adapters — while keeping everything inside memory.

This enables:
- Testing without databases
- Running CI without Docker
- Fast and isolated PHPUnit tests
- Simulating multi-adapter workflows
- Snapshot-based rollback
- Complex test data scenarios via fixtures

All adapters behave identically to real adapters, ensuring seamless transition between
fake and production environments.


---

## 🔑 Core Dependencies

The library fundamentally relies on:

1. **AdapterInterface**  
   `Maatify\Common\Contracts\Adapter\AdapterInterface`

2. **ResolverInterface**  
   `Maatify\DataAdapters\Contracts\ResolverInterface`

This ensures **1:1 compatibility** between fake drivers and their real counterparts.

---

## 🧩 Key Features

### 🔌 Fake Adapters
- **FakeMySQLAdapter** — Select, Insert, Update, Delete, filters, ordering, limit/offset
- **FakeMySQLDbalAdapter** — Doctrine-style wrapper
- **FakeMongoAdapter** — Collections with operators (`$in`, `$gt`, `$ne`, `$lte`)
- **FakeRedisAdapter** — Strings, lists, hashes, counters, TTL

### 🧱 Repository Support
- FakeRepository  
- FakeCollection  
- ArrayHydrator  

### 🔄 Transactions & Snapshots (Phase 6)
- Unit-of-Work transaction control
- Nested snapshots
- Rollback support
- Deterministic state restoration

### 📦 Fixtures & Testing (Phase 7)
- JSON fixtures loader
- Array-based dataset loader
- FakeEnvironment with auto-reset
- SQL + Mongo + Redis fixture hydration
- Ideal for integration testing

### ⚙ Adapter Lifecycle
All fake adapters implement:
- `connect()` / `disconnect()`
- `healthCheck()` / `isConnected()`
- `getDriver()`

---

## 📦 Installation

```bash
composer require maatify/data-fakes --dev
```

✔ Recommended for testing & CI  
✘ Not intended for production usage

---

## 🧪 Basic Usage

### Resolve a fake adapter:

```php
$resolver = new FakeResolver();
$db = $resolver->resolve('mysql:main', true);
$rows = $db->select('users', ['id' => 1]);
```

### Reset state:

```php
FakeStorageLayer::reset();
```

### Load fixtures:

```php
$env->loadFixturesFromFile(__DIR__.'/fixtures.json');
```

---

## 📁 Included Components

### 🔹 Adapters
- FakeMySQLAdapter  
- FakeMySQLDbalAdapter  
- FakeRedisAdapter  
- FakeMongoAdapter  

### 🔹 Repository Layer
- FakeRepository  
- FakeCollection  
- ArrayHydrator  

### 🔹 Routing
- FakeResolver  

### 🔹 Snapshot System (Phase 6)
- SnapshotManager  
- SnapshotState  
- FakeUnitOfWork  

### 🔹 Fixtures & Testing (Phase 7)
- FakeFixturesLoader  
- JsonFixtureParser  
- FakeEnvironment  
- ResetState  

---

## 🧩 Architectural Highlights


### FakeStorageLayer
- Central deterministic memory engine
- Shared across all fake adapters
- Supports snapshot export/import
- Auto ID management (incremental + manual)

### Snapshot System (Phase 6)
- Immutable snapshot objects
- Storage-wide state capture
- Full restore support
- Transaction simulation using snapshots

### Unit of Work (Phase 6)
- Stacked snapshots
- Nested begin/commit/rollback
- Transactional helper wrapper
- Adapter-agnostic

## 📦 Fixtures & Test Environment (Phase 7)

### FakeFixturesLoader
- Loads SQL, Mongo, and Redis fixtures  
- From arrays or JSON files  

### FakeEnvironment
- Coordinates all fake adapters  
- Provides auto-reset between tests  

### ResetState
- Toggles auto-reset behavior  

---

## 📚 Development Phases

- **Phase 1:** Project Bootstrap & Core Architecture  
- **Phase 2:** Fake MySQL & DBAL Adapter  
- **Phase 3:** Fake Redis Adapter  
- **Phase 4:** Fake Mongo Adapter  
- **Phase 5:** Repository Layer  
- **Phase 6:** Snapshot Engine + Unit of Work  
- **Phase 7:** Fixtures Loader + FakeEnvironment  

---

## 📘 Full Documentation

Full implementation details:

- Architecture overview
- Development phases (1 → 7)
- API map
- Class reference
- Test behavior and isolation rules
- Adapter lifecycles
- Repository usage

---

## 🪪 License

**[MIT license](LICENSE)** © [Maatify.dev](https://www.maatify.dev)

---

## 👤 Author

Engineered by **Mohamed Abdulalim ([@megyptm](https://github.com/megyptm))**  
https://www.maatify.dev

📘 Full source:  
https://github.com/Maatify/data-fakes

---

<p align="center">
  <sub><span style="color:#777">Built with ❤️ by <a href="https://www.maatify.dev">Maatify.dev</a> — Unified Ecosystem for Modern PHP Libraries</span></sub>
</p>
