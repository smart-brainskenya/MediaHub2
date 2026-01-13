# 07: Implementation Order

## Purpose of This Document

This document proposes a logical, step-by-step order for implementing the Smart Brains Media Hub. Its purpose is to provide a clear roadmap for development, ensuring foundational elements are built before dependent features. This sequence is a recommendation and can be adapted, but it follows a "backend-first" approach.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## Recommended Implementation Sequence

### Phase 1: Project Setup and Foundations

1.  **Initialize Laravel Project:** Set up a new Laravel project.
2.  **Configure Database:** Configure the `.env` file and connect the application to a database.
3.  **Install Starter Kits:** Install Laravel's standard authentication scaffolding (e.g., Breeze or Jetstream) to provide a starting point for admin authentication and basic layout.
4.  **Create Data Model:**
    -   Generate the `MediaAsset` model and its corresponding migration file based on `06_DATA_MODEL.md`.
    -   Run the migrations to create the `users` and `media_assets` tables.

### Phase 2: Core Admin Functionality (Backend)

5.  **Build Media CRUD:**
    -   Create the routes and controller (`Admin/MediaAssetController`) for managing media.
    -   Implement the logic for creating, reading, updating, and deleting `MediaAsset` records.
    -   Implement the file handling logic for uploads, ensuring files are stored in a designated `storage` directory.
6.  **Implement Admin Views:**
    -   Create the Blade views for the admin dashboard, including:
        -   A table listing all media assets.
        -   Forms for uploading and editing assets.
        -   Confirmation modals for deleting assets.
7.  **Implement Import Feature:**
    -   Add the controller logic to handle fetching a file from an external URL and storing it locally. This should likely be handled by a queued job to avoid timeout issues.

### Phase 3: Public-Facing Student Interface

8.  **Create Public Routes:**
    -   Define the routes for the homepage, image gallery, and video library.
9.  **Build Public Controllers:**
    -   Create controllers (`ImageGalleryController`, `VideoLibraryController`) to fetch all corresponding `MediaAsset` records from the database.
10. **Develop Public Views:**
    -   Create the Blade views for the galleries, displaying assets in a user-friendly grid.
    -   Use Tailwind CSS to style the public-facing pages.

### Phase 4: Embedding and Interactivity

11. **Implement Embed Page:**
    -   Create the route (`/embed/video/{id}`) and controller method to serve the dedicated video embed page.
    -   Create the minimalist Blade view for this page, which contains only the HTML `<video>` player.
12. **Add "Copy Code" Feature:**
    -   On the asset preview pages, add buttons for "Copy Embed Code" (videos) and "Copy URL/Tag" (images).
    -   Use Alpine.js to add the clipboard-copying functionality to these buttons.

### Phase 5: Finalization and Review

13. **Testing:** Write tests to ensure all admin functions and public flows work as expected.
14. **Styling and Polish:** Review all pages and ensure the styling is consistent and the user experience is smooth.
15. **Deployment Preparation:** Ensure all environment variables and storage links are correctly configured for deployment.

---

## AI Improvement Suggestions (Flagged)

*There are no AI-generated improvement suggestions at this time.*
