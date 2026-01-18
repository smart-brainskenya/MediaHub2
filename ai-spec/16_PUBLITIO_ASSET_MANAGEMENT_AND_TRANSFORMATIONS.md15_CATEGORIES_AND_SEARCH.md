# Publitio Asset Management & Transformations

## Purpose

This document defines how Smart Brains Media Hub leverages Publitio’s built-in asset
management and transformation capabilities to support:

- Media uploads
- Folder and category organization
- Renaming and deletion
- Automatic thumbnail generation
- Responsive image usage

This specification ensures all media handling remains centralized in Publitio while
the Media Hub manages metadata, presentation, and access rules.

---

## Core Principles

1. Publitio is the **single source of truth** for media files.
2. Laravel does not process or transform media files directly.
3. All transformations are URL-based and handled by Publitio’s CDN.
4. Media Hub stores only:
   - Canonical public URL
   - Publitio file identifier
   - Display metadata (name, category, type)

---

## Asset Operations (Admin Only)

### Upload Media
Admins can:
- Upload images or videos via file upload
- Import media via URL (see `14_IMPORT_BY_LINK.md`)

On upload:
- Files are sent directly to Publitio via API
- Publitio returns a file ID and metadata
- Media Hub stores the canonical public URL

---

### Rename Media
Admins can rename media assets.

Rules:
- Renaming affects:
  - Display name in Media Hub
  - Title/metadata in Publitio (if supported)
- Renaming does NOT change:
  - File ID
  - Public delivery URL

---

### Delete Media
Admins can delete media assets.

Behavior:
- Deletion request removes the file from Publitio
- Corresponding Media Hub database record is removed
- Public URLs must become invalid after deletion

Soft deletes are out of scope.

---

## Folder & Category Organization

### Publitio Folders
Publitio folders may be used internally to:
- Group assets by type (images/videos)
- Separate imported vs uploaded content

Rules:
- Folder structure is **internal to Publitio**
- Folder paths are NOT exposed to students
- Media Hub does not rely on folder paths for access control

---

### Media Hub Categories
Categories are defined and managed **inside Media Hub**, not Publitio.

Rules:
- Categories are metadata only
- Categories do not map to folders
- Each media asset may belong to one category

(See `15_CATEGORIES_AND_SEARCH.md`)

---

## Thumbnail Generation (Automatic)

### Images
Publitio’s URL-based transformations must be used to generate thumbnails.

Rules:
- No thumbnails are generated or stored manually
- Thumbnail URLs are derived dynamically from the original media URL

Example (conceptual):
