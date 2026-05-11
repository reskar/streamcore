# ADR-0001: Initial stack

- Status: Accepted
- Date: 2026-05-11

## Context

Стек для проекта стримингового бэкенда. Нужны высокий RPS, кэширование
на нескольких уровнях, OLAP-аналитика и строгие архитектурные границы
с первого дня.

## Decision

- **PHP 8.4**, везде `declare(strict_types=1)`
- **Laravel 13** + **Octane на FrankenPHP** (worker mode)
- **PostgreSQL 16** — основное OLTP (GIN, JSONB, FTS из коробки)
- **Redis 7** — кэш, очереди, rate limiting
- **ClickHouse** — viewing analytics (подключится в соответствующей фазе)
- **MeiliSearch** — каталог с фасетным поиском (подключится позже)
- **Hexagonal + DDD-tactical**: `Src\Domain` (PHP-only), `Src\Application`
  (use cases), `App\Infrastructure` (адаптеры, в т.ч. Eloquent)
- **Pest 4** + arch-тесты, **PHPStan max** + larastan + strict-rules,
  **PHP-CS-Fixer** с PER-CS 2.0, **Rector** с PHP 8.4 + Laravel 13 sets,
  **Deptrac** для архитектурных границ
- **CaptainHook**: pre-commit cs-fixer на staged файлы, commit-msg
  Conventional Commits
- **`composer ci`** = cs + stan + rector + arch + test, обязательно
  зелёный для каждого коммита
- **GitHub Actions**: `composer audit` + `composer ci`
- **Docker Compose** для локальной разработки

## Consequences

- Eloquent живёт только в `App\Infrastructure`, домен — чистый PHP
- Deptrac и Pest arch-тесты в CI запрещают нарушение слоёв
- TDD строго Red → Green → Refactor, отдельными коммитами на стадию

## Когда пересмотреть

- Октан упирается в специфическую проблему (state leak, утечки памяти)
  → ADR с переходом на RoadRunner и бенчмарком до/после
- Hexagonal-границы мешают там, где они избыточны → ADR с послаблениями
  для конкретных слоёв
