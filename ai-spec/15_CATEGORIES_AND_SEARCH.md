# Categories and Search Specification

## Purpose
Defines how media categorization and search operate within the Smart Brains Media Hub to improve discoverability.

These features operate on metadata only and do not affect media storage.

---

## Categories

### Category Model
- id
- name
- slug
- color (optional, UI use)
- icon (optional)
- created_at

Each media asset may belong to **one category**.

---

## Admin Category Management

Admins can:
- Create categories
- Edit category names
- Assign categories to media assets

Students cannot manage categories.

---

## Public Category Browsing

- Categories appear as filter options
- “All” category is always available
- Selecting a category filters visible media

---

## Search

### Search Scope
Search matches against:
- Media name
- Media description (if present)
- Category name

Search does NOT inspect:
- Image content
- Video frames
- Publitio metadata

---

## Search UX Rules

- Search input must be visible on gallery pages
- Search results must be reflected in the URL via query parameters
- Empty states must be friendly and explanatory

Example: /images?category=posters&search=anniversary

---

## Performance Rules

- Search must be database-backed
- No external search services
- No full-text engines required

---

## Out of Scope

- Tags or multi-category assignment
- Student personalization
- Recommendation systems
- Advanced ranking or scoring
