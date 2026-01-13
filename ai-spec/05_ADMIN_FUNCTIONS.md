# 05: Admin Functions

## Purpose of This Document

This document defines the specific capabilities and access rules for **Administrators** (internal staff). These functions provide complete control over the media assets available to students. The goal is to create a secure and functional management interface.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## Access Control

-   **Authentication is Mandatory:** All administrative functions must be protected by a login system. No write operations (create, update, delete) are possible without a valid, authenticated session.
-   **Separate Interface:** The admin dashboard must be a distinct area of the application, separate from the public-facing student galleries.

---

## Core Administrative Capabilities

Administrators have full Create, Read, Update, and Delete (CRUD) permissions on all media assets. The dashboard must provide an interface for the following actions.

### 1. Media Uploads

-   **Function:** Admins can upload new media assets (images and videos) directly from their local machine.
-   **Process:** An upload form will allow the admin to select a file, give it a display name, and submit it to the system. The system will then process and store the file appropriately.

### 2. Media Imports

-   **Function:** Admins can import media from an external URL. This is a powerful feature for easily adding content without requiring a local download first.
-   **Process:** An import form will allow the admin to paste a URL to a video or image. The Laravel backend will be responsible for downloading the file from the given URL, storing it on the internal infrastructure, and creating a new `MediaAsset` record.
-   **Constraint:** This functionality is strictly for admins. The system must never expose this capability to students or the public.

### 3. Media Management

-   **Function:** Admins can view and manage the entire library of assets.
-   **Interface:** A central dashboard should list all media assets, showing key information like name, type (image/video), and creation date.
-   **Actions:** From this list, an admin must be able to:
    -   **Preview:** View the image or watch the video.
    -   **Rename:** Change the user-facing display name of the asset.
    -   **Replace:** Upload a new version of an asset's file while retaining its existing record and ID. This is useful for correcting or updating media without breaking existing student embeds.
    -   **Delete:** Permanently remove an asset from the system. This action should require confirmation.

---

## AI Improvement Suggestions (Flagged)

-   **Suggestion:** Implement a "soft delete" feature. When an admin deletes an asset, it is marked as inactive instead of being permanently removed from the database. This allows for accidental deletions to be reversed. Public-facing galleries would only show active assets.
-   **Suggestion:** For the URL import feature, add validation to check for supported MIME types and reasonable file sizes before initiating the download to prevent server resource abuse.
