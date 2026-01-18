# 11: Page UI Specifications

## Purpose of This Document

This document provides granular UI specifications for key pages within the Smart Brains Media Hub. It serves as a strict guide for frontend implementation, ensuring that the visual hierarchy, layout, and tone meet the needs of both student and admin users.

This document derives from `00_CANONICAL_OVERVIEW.md` and expands upon `09_UI_FRAMEWORK.md`.

---

## 1. Design Philosophy by User Role

### 1.1 Public UI (Student-Facing)
**Tone:** Welcoming, Simple, Focused, Child-Friendly.
**Goal:** Reduce cognitive load. Students should never have to guess what to click.

**Visual Principles:**
- **Big Click Targets:** Buttons and navigation cards must be large and easily clickable/tappable (min 44px height, ideally larger for primary actions).
- **Minimal Text:** Use icons and short, clear labels. Avoid long paragraphs.
- **High Contrast:** Ensure distinct separation between background, content cards, and interactive elements.
- **No Admin Clutter:** Absolutely no admin-related controls (edit, delete, settings) should be visible or hidden in menus.

### 1.2 Admin UI (Staff-Facing)
**Tone:** Utilitarian, Dense, Efficient, Professional.
**Goal:** Maximize management capability. Admins need access to data and tools quickly.

**Visual Principles:**
- **Density:** standard table rows and form inputs are acceptable.
- **Explicit Controls:** Edit, Delete, and Upload actions should be clearly labeled and accessible.
- **Status Indicators:** Clear visual cues for system status (success messages, error alerts).

---

## 2. Public Page Specifications

### 2.1 Public Homepage ("/")
**Layout:** Centered "Split Choice" Layout.
**Elements:**
1.  **Header/Branding:** Centered logo or text title ("Smart Brains Media Hub") at the top.
2.  **Hero/Welcome:** A brief, welcoming heading (e.g., "What would you like to find today?").
3.  **Primary Navigation Cards:** Two large, equal-sized cards side-by-side (stack on mobile).
    *   **Card 1 (Image Gallery):** Icon representing images (e.g., photo frame) + Label "Image Gallery".
    *   **Card 2 (Video Library):** Icon representing video (e.g., play button) + Label "Video Library".
    *   **Behavior:** Hover effects (scale up slightly or shadow deepen) to indicate interactivity.
4.  **Footer:** minimal copyright or organizational link.

### 2.2 Gallery Listing Pages (`/images`, `/videos`)
**Layout:** Responsive Grid.
**Elements:**
1.  **Header:**
    *   **Back Navigation:** Clear "← Back to Home" link/button.
    *   **Page Title:** "Image Gallery" or "Video Library".
    *   **Switch Link:** A secondary link to switch to the other gallery type (e.g., "Go to Videos").
2.  **Grid Container:**
    *   **Columns:** 1 (mobile) -> 2 (tablet) -> 3 or 4 (desktop).
    *   **Gap:** Consistent spacing (e.g., `gap-6`).
3.  **Media Card:**
    *   **Thumbnail:** 
        *   Images: The actual image, object-cover.
        *   Videos: A generated thumbnail or a consistent placeholder icon (e.g., play icon on gray background).
    *   **Label:** The filename or display name, truncated if too long.
    *   **Interaction:** Entire card is clickable.

### 2.3 Media Preview / Watch Pages (`/images/{id}`, `/videos/{id}`)
**Layout:** Single Column, Focused Content.
**Elements:**
1.  **Header:** "← Back to Gallery" navigation.
2.  **Content Stage:**
    *   **Images:** Displayed max-width 100%, max-height 80vh. Object-contain to ensure the whole image is seen.
    *   **Videos:** Native `<video>` player with standard controls. Width 100%.
3.  **Action Area (Below Content):**
    *   **Title:** Full media name.
    *   **Primary Action:** "Copy URL" (Images) or "Copy Embed Code" (Videos).
        *   **Style:** Large, primary colored button.
        *   **Feedback:** Text changes to "Copied!" on click.
    *   **Secondary Action (Images only):** "Copy `<img>` Tag" (outlined/secondary style).

---

## 3. Admin Page Specifications

### 3.1 Admin Dashboard (`/admin/dashboard`)
**Layout:** Dashboard / Table View.
**Elements:**
1.  **Top Bar:** User profile, Logout, link to Public Home.
2.  **Action Bar:**
    *   **Primary:** "Upload New Media" button.
    *   **Secondary:** "Import from URL" button (if enabled).
3.  **Asset Table:**
    *   **Columns:** Thumbnail (small), Name, Type, Uploaded At, Actions.
    *   **Actions:** Edit (Rename), Delete.
    *   **Empty State:** Clear message if no assets exist, prompting upload.

### 3.2 Upload Form
**Layout:** Simple Form Container.
**Elements:**
1.  **File Input:** Native file picker or drag-and-drop zone.
2.  **Name Input:** Text field for display name (auto-filled from filename if possible).
3.  **Submit:** "Upload" button with loading state spinner.
4.  **Cancel:** Link back to dashboard.

---

## 4. Forbidden UI Patterns (Anti-Patterns)

-   **Infinite Scroll:** Do not implement infinite scroll on galleries. It creates navigation traps for students. Use standard pagination if needed.
-   **Modal Overload:** Do not use modals for deep content navigation. Use distinct URLs/Pages so browser "Back" buttons work as expected.
-   **Hidden Navigation:** Do not hide primary navigation behind "hamburger" menus on desktop.
-   **Complex Filters:** Avoid multi-dropdown filtering systems for students. Keep the library flat and browsable.
