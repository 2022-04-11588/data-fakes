<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Liberary    maatify/data-fakes
 * @Project     maatify:data-fakes
 * @author      Mohamed Abdulalim (megyptm)
 * @since       2025-11-22 03:01
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/data-fakes
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\DataFakes\Storage;

/**
 * FakeStorageLayer
 *
 * Unified in-memory engine powering all FakeAdapters (MySQL, DBAL, Redis, Mongo, …).
 * - Deterministic behaviour for testing
 * - Fully isolated per-test (no global state)
 * - Supports auto-increment IDs
 * - Table-level read/write/reset operations
 */
class FakeStorageLayer
{
    /** @var array<string, array<int, array<string, mixed>>> */
    private array $tables = [];

    /** @var array<string, int> */
    private array $autoIds = [];

    /**
     * Read all rows of a table.
     *
     * @param string $table
     * @return array<int, array<string, mixed>>
     */
    public function read(string $table): array
    {
        return $this->tables[$table] ?? [];
    }

    /**
     * Insert a new row and return it after applying auto-increment.
     *
     * @param string               $table
     * @param array<string, mixed> $row
     *
     * @return array<string, mixed>
     */
    public function write(string $table, array $row): array
    {
        // Initialize table if not exists
        if (!isset($this->tables[$table])) {
            $this->tables[$table] = [];
            $this->autoIds[$table] = 1;
        }

        // Auto-increment if missing
        if (!isset($row['id'])) {
            $row['id'] = $this->autoIds[$table]++;
        } else {
            // Safe convert id to integer
            $id = is_numeric($row['id']) ? (int)$row['id'] : 0;
            // Keep auto increment counter always ahead
            $this->autoIds[$table] = max($this->autoIds[$table], $id + 1);
            $row['id'] = $id;
        }

        $this->tables[$table][$row['id']] = $row;

        return $row;
    }

    /**
     * Replace an entire table.
     *
     * @param string                           $table
     * @param array<int, array<string, mixed>> $rows
     */
    public function writeTable(string $table, array $rows): void
    {
        $this->tables[$table] = $rows;

        // Recalculate auto-increment
        $max = 0;
        foreach ($rows as $id => $_row) {
            $intId = (int) $id;
            $max = max($max, $intId);
        }

        $this->autoIds[$table] = $max + 1;
    }

    /**
     * Delete a whole table.
     */
    public function drop(string $table): void
    {
        unset($this->tables[$table], $this->autoIds[$table]);
    }

    /**
     * Reset full storage — used between tests.
     */
    public function reset(): void
    {
        $this->tables  = [];
        $this->autoIds = [];
    }

    /**
     * Return raw state (for debugging/testing).
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    public function export(): array
    {
        return $this->tables;
    }
}
