# 12: UI Scope and Constraints

## Purpose of This Document

This document defines the boundaries of what is allowed and what is forbidden in the UI implementation of the Smart Brains Media Hub. It serves to prevent scope creep and ensure technical simplicity.

This document derives from `00_CANONICAL_OVERVIEW.md`.

---

## 1. Allowed Technologies & Patterns

### 1.1 CSS & Styling
-   **Framework:** Tailwind CSS is the **sole** source of truth for styling.
-   **Custom CSS:** Avoid writing custom raw CSS in `<style>` blocks or separate `.css` files unless absolutely necessary for a specific browser hack or animation not coverable by Tailwind.
-   **Responsive Design:** Mobile-first approach. All layouts must break down gracefully to a single column on devices < 768px.

### 1.2 Interaction & JavaScript
-   **Library:** Alpine.js is the **only** approved frontend library for interactivity.
-   **Scope:** Use Alpine.js strictly for:
    -   Toggling UI state (dropdowns, mobile menus).
    -   Handling "Copy to Clipboard" logic.
    -   Simple client-side form validation feedback.
    -   Dismissing notifications/toasts.
-   **No SPAs:** Do not use Alpine to simulate a Single Page Application routing system. URL navigation must remain standard server-side routing.

### 1.3 Images & Media
-   **Placeholders:** When a video thumbnail cannot be generated (e.g., missing ffmpeg on server), the UI **must** fail gracefully by showing a generic SVG placeholder icon.
-   **Lazy Loading:** Native `loading="lazy"` attribute on `<img>` tags is allowed and encouraged.

---

## 2. Forbidden Technologies & Patterns

### 2.1 Frameworks
-   **React / Vue / Svelte / Angular:** **Strictly Forbidden.** Introducing a build step for these frameworks violates the simplicity constraint.
-   **jQuery:** **Forbidden.** Use vanilla JS or Alpine.js.

### 2.2 UI Patterns
-   **Infinite Scroll:** Forbidden. It complicates footer access and state management.
-   **Right-Click Disabling:** Do not attempt to disable right-click context menus via JS. It breaks accessibility and native browser features.
-   **Autoplay:** Videos must **not** autoplay on the listing or detail pages. Students must explicitly initiate playback.

### 2.3 Data Simulation
-   **Fake Data:** The UI must not display hardcoded "fake" assets in production views.
-   **Exceptions:**
    -   During local development, seeders should provide realistic data.
    -   "Empty States" are required (e.g., "No videos found") rather than showing mock videos.

---

## 3. Placeholder Strategy

Where real data or assets are technically complex to generate in the current MVP phase, the UI must use consistent placeholders:

| Asset Type | Situation | Approved Placeholder |
| :--- | :--- | :--- |
| **User Avatar** | No user photo uploaded | Generic "Initials" circle or SVG silhouette. |
| **Video Thumbnail** | ffmpeg not available | A neutral gray card with a centered "Play" icon SVG. |
| **Branding** | No logo provided | Simple text: "Smart Brains Media Hub" in system font. |

---

## 4. Admin vs. Public Separation

-   **Asset Leaking:** Admin UI components (e.g., "Delete" buttons) must **never** be rendered in the HTML of public pages, even if hidden with CSS. They must be excluded server-side via Blade logic (`@auth`).
-   **Route Protection:** UI links to admin pages must not exist in the DOM for unauthenticated users.
