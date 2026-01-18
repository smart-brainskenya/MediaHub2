# Import Media by Link (Admin Feature)

## Purpose
Defines the admin-only workflow for importing external media into the Smart Brains Media Hub via a URL.

This feature enables admins to fetch media from the internet and store it permanently in Publitio for offline/zero-data student access.

---

## Feature Scope

- Admin-only
- Supports images and videos
- Publitio is the final storage destination

---

## Backend Workflow (Authoritative)

1. Admin submits a public media URL
2. System validates:
   - URL scheme (http/https)
   - File type (image/video)
   - File size (within limits)
3. System downloads the file server-side (streamed)
4. File is uploaded to Publitio
5. Publitio returns asset metadata
6. System constructs canonical media URL
7. Database record is created

No local file persistence is allowed.

---

## Frontend Workflow (Admin UX)

1. Admin pastes media URL
2. System displays loading / fetching state
3. Media preview is shown after successful upload
4. Admin can rename the media
5. Admin saves the asset

---

## Validation Rules

- Only publicly accessible URLs allowed
- Redirect chains must be resolved safely
- Unsupported formats are rejected
- Large files are rejected gracefully

---

## Security Constraints

- No client-side fetching of external URLs
- No hot-linking
- No direct storage of third-party URLs

---

## Failure Handling

- Failed imports must not appear in public galleries
- Admin receives clear but non-technical feedback
- Errors are logged internally

---

## Out of Scope

- Bulk import
- Scheduled imports
- Background job queues
- Media editing or transformation
