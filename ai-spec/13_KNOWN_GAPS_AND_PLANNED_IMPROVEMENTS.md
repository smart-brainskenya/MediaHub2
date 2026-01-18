# 13: Known Gaps and Planned Improvements

## Purpose of This Document

This document lists known limitations in the current UI/UX implementation. It serves to acknowledge missing features that might normally be expected in a media platform but are explicitly deferred or out of scope for the current version.

This document prevents future AI agents from hallucinating these features as "bugs" that need immediate fixing.

---

## 1. Out of Scope (Planned for Future)

The following features are acknowledged as valuable but are **not** to be implemented in the current iteration:

### 1.1 "Import by Link"
-   **Description:** The ability for admins to paste a YouTube or external URL and have the system auto-download the asset.
-   **Status:** **Deferred.** The UI contains a placeholder link or button for this, but the backend implementation is complex (requires queue workers, reliable downloaders).
-   **UI Handling:** If the button exists, it should route to a "Coming Soon" message or be hidden entirely until the backend is ready.

### 1.2 Search Functionality
-   **Description:** A search bar to filter images/videos by name.
-   **Status:** **Deferred.** The current library size is expected to be small enough to browse manually.
-   **UI Handling:** Do not include a search bar in the header.

### 1.3 Categories / Folders
-   **Description:** Organizing media into hierarchical folders or topic tags.
-   **Status:** **Explicit Non-Goal.** The library is intentionally flat to prevent categorization debates.
-   **UI Handling:** Listing pages display a flat chronological or alphabetical grid.

### 1.4 Video Thumbnails (Generated)
-   **Description:** Automatically extracting a frame from an uploaded video to serve as its thumbnail.
-   **Status:** **Deferred.** Requires server-side `ffmpeg` which is not guaranteed in all deployment environments.
-   **UI Handling:** The UI uses a static SVG placeholder for all video thumbnails. This is expected behavior, not a bug.

---

## 2. Known UI Limitations

### 2.1 Mobile Navigation
-   **Gap:** The admin dashboard navigation on mobile uses a simple stack. It may become cluttered if many new admin features are added.
-   **Acceptance:** Acceptable for current scope (only ~3-4 admin links).

### 2.2 Bulk Actions
-   **Gap:** Admins must delete assets one by one. There is no "Select All" or bulk delete feature.
-   **Acceptance:** Acceptable given the low volume of expected deletion events.

### 2.3 Upload Progress
-   **Gap:** Large file uploads do not show a precise percentage progress bar (e.g., "45%").
-   **Acceptance:** A simple "processing" spinner or disabled state on the submit button is sufficient for the MVP.
