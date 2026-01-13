# 06: Data Model

## Purpose of This Document

This document defines the high-level data structures and database schema for the Smart Brains Media Hub. The model is intentionally simple, reflecting the focused nature of the application. Its purpose is to guide database-level implementation and migrations.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## Core Tables

The database will consist of two primary tables: one for managing media assets and one for administrative users.

### 1. `media_assets` Table

This table is the central repository for all information related to the images and videos served by the platform.

| Column Name     | Data Type             | Nullable | Description                                             |
| --------------- | --------------------- | -------- | ------------------------------------------------------- |
| `id`            | `bigint`, `unsigned`, PK | No       | Unique identifier for the asset.                        |
| `name`          | `varchar(255)`        | No       | The user-facing display name of the asset.              |
| `type`          | `enum('image', 'video')` | No       | The type of media asset.                                |
| `file_path`     | `varchar(255)`        | No       | The relative path to the asset file in internal storage. |
| `mime_type`     | `varchar(100)`        | No       | The MIME type of the file (e.g., `image/jpeg`, `video/mp4`). |
| `created_at`    | `timestamp`           | Yes      | Timestamp of when the record was created.               |
| `updated_at`    | `timestamp`           | Yes      | Timestamp of when the record was last updated.          |

### 2. `users` Table

This is a standard Laravel `users` table, used exclusively for authenticating administrators. No modifications are needed for student access, as they are anonymous.

| Column Name         | Data Type             | Nullable | Description                                  |
| ------------------- | --------------------- | -------- | -------------------------------------------- |
| `id`                | `bigint`, `unsigned`, PK | No       | Unique identifier for the user.              |
| `name`              | `varchar(255)`        | No       | The administrator's name.                    |
| `email`             | `varchar(255)`, `unique`| No       | The administrator's login email.             |
| `email_verified_at` | `timestamp`           | Yes      | Timestamp for email verification.            |
| `password`          | `varchar(255)`        | No       | The hashed password for the administrator.   |
| `remember_token`    | `varchar(100)`        | Yes      | Token for "remember me" functionality.       |
| `created_at`        | `timestamp`           | Yes      | Timestamp of when the user was created.      |
| `updated_at`        | `timestamp`           | Yes      | Timestamp of when the user was last updated. |

---

## Excluded Data Structures

To adhere to the principle of simplicity and the project's non-goals, the data model will **explicitly not** include tables or fields for:

-   Categories, tags, or topics
-   Curriculum metadata
-   Student accounts or profiles
-   Comments, ratings, or view counts
-   Any form of analytics tracking

The data model must remain flat and focused on asset and admin management only.

---

## AI Improvement Suggestions (Flagged)

-   **Suggestion:** Add a `size` column (integer) to the `media_assets` table to store the file size in bytes. This could be useful for administrative reporting and monitoring storage usage.
-   **Suggestion:** Add an `alt_text` column (string) to the `media_assets` table for images. This would allow admins to specify descriptive alt text to be included in the generated `<img>` tags, improving accessibility.
