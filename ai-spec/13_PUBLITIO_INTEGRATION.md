# Publitio Integration Specification

## Purpose
This document defines how Smart Brains Media Hub integrates with Publitio as its **primary and only production media storage provider**.

Publitio replaces all local file storage for images and videos in production environments.

---

## Core Principles

1. The Media Hub **does not store binary media files locally** in production.
2. All images and videos are stored and delivered via Publitio.
3. All public media URLs must use the branded media domain: https://media.media.smartbrainskenya.com
4. Direct Publitio CDN URLs (e.g. publit.io domains) must **never** be stored or exposed.

---

## Storage Responsibility Split

| Layer | Responsibility |
|-----|---------------|
| Laravel Application | Metadata, UI, access control |
| Publitio | Media storage, CDN delivery |
| DNS | Domain masking and zero-rating |
| Media Hub | Discovery, preview, embed |

---

## Authentication & Configuration

Publitio credentials must be stored via environment variables:
- `PUBLITIO_API_KEY`
- `PUBLITIO_API_SECRET`

No credentials should be hardcoded.

---

## Media URL Rules

- The database stores **only** the canonical public URL: https://media.media.smartbrainskenya.com/file/{filename}
- The application must not generate media URLs from its own domain.
- URL normalization is mandatory before persistence.

---

## Upload Sources

Publitio uploads may originate from:
- Direct admin file uploads
- Import-by-link workflow (defined separately)

Students never upload media.

---

## Error Handling

- Failed uploads must not create database records.
- Errors should be logged internally.
- Public users must never see storage-related errors.

---

## Out of Scope

- Local disk storage in production
- CDN configuration details
- Video transcoding customization
- Media deletion policies at Publitio level
