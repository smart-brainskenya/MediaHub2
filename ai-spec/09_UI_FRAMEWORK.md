# 09: UI Framework

## Purpose of This Document

This document defines the structural, layout, and interaction rules for the Smart Brains Media Hub's user interface. Its purpose is to ensure consistency across all pages and prevent arbitrary design decisions during implementation. This document does NOT specify colors, fonts, or detailed visual styling—those belong in a separate branding document.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## 1. UI Design Principles

The interface must adhere to the following core principles:

### Simplicity
- Every page should have a single, clear purpose.
- No unnecessary controls, decorative elements, or distracting information.
- Students should intuitively understand what action is available on each page.

### Clarity
- Labels and instructions must be explicit and unambiguous.
- Error messages must clearly state what went wrong and how to fix it.
- Buttons should indicate their action without requiring context.

### Student-Safe Design
- No elements that exploit or gamify behavior (no points, badges, social features).
- Consistent interaction patterns across all public pages.
- All public pages are accessible without login or account creation.

### Consistency
- Navigation, page structure, and interactions must behave the same way throughout the application.
- Public galleries must have the same interaction model.
- Admin pages must follow the same dashboard conventions.

---

## 2. Navigation Structure

### 2.1 Public Navigation Rules

The public-facing part of the application must provide a simple navigation model:

1. **Homepage (Entry Point):**
   - The homepage is the primary entry point for all students.
   - The homepage must display two primary navigation options:
     - "Image Gallery" (leading to the image listing page)
     - "Video Library" (leading to the video listing page)
   - A "Smart Brains Media Hub" or equivalent title/branding should be visible (placement and styling TBD in visual identity document).
   - No other navigation options should be present on the homepage.

2. **Navigation from Listing Pages:**
   - From image gallery or video library pages, a navigation element (button, link, or breadcrumb) must allow students to:
     - Return to the homepage
     - Switch to the other media type (Image Gallery ↔ Video Library)
   - This navigation should be positioned consistently on all listing pages.

3. **Navigation from Detail Pages:**
   - From a media detail/preview page, a navigation element must allow students to:
     - Return to the listing page for that media type
     - Return to the homepage
   - The "back" navigation should use a standard pattern (back button, breadcrumb, or link).

4. **No Admin Access from Public Pages:**
   - Public pages must never display links to admin login or admin functions.
   - Admin authentication happens at a separate URL (e.g., `/admin/login`).
   - Students who navigate to an admin URL without authentication should be redirected to the login page.

### 2.2 Admin Navigation Rules

The admin dashboard must provide structured access to administrative functions:

1. **Dashboard Layout:**
   - The admin dashboard is the primary hub after login.
   - The dashboard must display:
     - A list of all media assets (with view, edit, delete, and preview options)
     - A button or link to "Upload New Asset"
     - A button or link to "Import from URL"
     - A logout option

2. **Navigation Structure:**
   - Admin pages should include a consistent navigation area (header, sidebar, or navigation bar).
   - The navigation should include:
     - Smart Brains Media Hub title or logo
     - Link back to the main dashboard
     - Logout button
   - No navigation to public pages should appear in the admin interface.

3. **Access Control:**
   - All admin pages must check for valid authentication before rendering.
   - Unauthenticated users attempting to access admin pages should be redirected to `/admin/login`.
   - After logout, users should be redirected to the public homepage.

---

## 3. Page Layout Definitions

### 3.1 Public Homepage

**Purpose:** Serve as the entry point and primary navigation hub for students.

**Required Elements:**
- Title or branding identifier for the platform
- Clear heading or explanatory text (e.g., "Choose a media type to get started")
- Two equally prominent navigation options:
  - "Image Gallery" button/link
  - "Video Library" button/link
- Optional: Brief description of what the Media Hub is (one sentence to one paragraph)

**Layout Expectations:**
- The page should feel uncluttered and welcoming to students.
- The two media type options should be visually equivalent and easily distinguishable.
- No authentication, signup, or account information should be visible.

**Responsive Behavior:**
- On mobile: Options should be stacked vertically, full-width or nearly full-width.
- On tablet: Options can be side-by-side or stacked, depending on screen size.
- On desktop: Options should be centered and appropriately spaced.

---

### 3.2 Media Listing Pages (Image Gallery & Video Library)

**Purpose:** Display all available media assets in a browsable format.

**Required Elements:**
- Page title indicating the current media type ("Image Gallery" or "Video Library")
- A collection of media assets displayed in a grid or list format
- Each asset should show:
  - A thumbnail or preview of the media (still image for videos, the full image for images)
  - The asset name
  - A clickable element to view the full detail page
- Navigation back to the homepage or media type selection
- Navigation to switch to the other media type (Image Gallery ↔ Video Library)

**Layout Expectations:**
- Grid format is preferred (e.g., multiple columns of thumbnail cards).
- All cards in the grid should be consistently sized.
- Clicking a card navigates to the media detail page.
- Assets should be displayed in a consistent order (e.g., newest first or alphabetical). The specific order is TBD.

**Responsive Behavior:**
- Mobile (small screens): Single-column layout.
- Tablet (medium screens): Two to three columns.
- Desktop (large screens): Three or more columns.
- Adjust grid columns responsively based on screen width.

**Pagination Expectation:**
- If the library contains many assets, pagination or lazy-loading may be necessary. This is flagged as an AI improvement suggestion (see Section 7).

---

### 3.3 Media Detail Pages (Watch / Preview)

**Purpose:** Display a single media asset and provide options for copying and embedding.

**Required Elements:**

**For Videos:**
- The native HTML `<video>` player displaying the video
- Video player controls (play, pause, volume, fullscreen) should be enabled by default
- Video dimensions should be responsive (fill available container width on all screen sizes)
- Asset name displayed above or below the player
- "Copy Embed Code" button
- Navigation back to the video library or homepage

**For Images:**
- The image displayed at full resolution or scaled to fit the viewport
- Asset name displayed above or below the image
- "Copy Image URL" button
- "Copy `<img>` Tag" button (optional, but recommended for consistency)
- Navigation back to the image gallery or homepage

**Common Elements:**
- All copy buttons should provide immediate visual feedback when clicked (see Section 5.1 for interaction patterns).
- The layout should center media in the viewport and allow for responsive scaling.

**Layout Expectations:**
- Media should be the primary focus of the page.
- Buttons should be positioned below the media or adjacent to it.
- On mobile, buttons should be stacked or arranged to fit the screen width.

**Responsive Behavior:**
- Mobile: Media should scale to fill the available width, with buttons centered below.
- Tablet: Media should scale proportionally, buttons positioned below or to the side.
- Desktop: Media should scale proportionally and be centered, with buttons positioned appropriately.

---

### 3.4 Embed Pages (for `<iframe>` Embedding)

**Purpose:** Serve as the minimal internal page that displays a media player inside an `<iframe>`.

**Required Elements:**

**For Video Embed Pages (e.g., `/embed/video/{id}`):**
- Only the native HTML `<video>` player
- The player should fill the iframe's available space (width: 100%, height: 100%)
- No navigation, no title, no extraneous elements
- Minimal styling to ensure the video fills the iframe

**Styling Expectations:**
- Body margins and padding should be zero
- The video element should fill the entire iframe container
- No horizontal or vertical scrollbars should appear

**Purpose and Context:**
- This page is NOT meant to be viewed directly by students—it is embedded inside an `<iframe>` tag in external HTML documents.
- Students should never see the URL of this page in the address bar under normal use.

---

### 3.5 Admin Dashboard

**Purpose:** Serve as the hub for all administrative functions.

**Required Elements:**

1. **Media Asset List:**
   - A table or structured list displaying all media assets
   - Each row/item should show:
     - Asset name
     - Asset type (image or video)
     - Creation or upload date (optional but recommended)
     - Action buttons:
       - "Preview" (view the asset in a detail view)
       - "Rename" (edit the asset's name)
       - "Replace" (upload a new file version)
       - "Delete" (remove the asset with confirmation)

2. **Upload New Asset Section:**
   - A button or link labeled "Upload New Asset" that opens an upload form
   - The upload form must include:
     - A file input for selecting an image or video file
     - A text field for entering the asset's display name
     - A "Submit" or "Upload" button
     - Form validation messaging (see Section 6 for error states)

3. **Import from URL Section:**
   - A button or link labeled "Import from URL" that opens an import form
   - The import form must include:
     - A text field for entering a URL
     - A text field for entering the asset's display name
     - A "Submit" or "Import" button
     - Form validation messaging (see Section 6 for error states)

4. **Navigation and Logout:**
   - A logout button or link, clearly labeled
   - Navigation back to the Media Hub homepage (optional)
   - A title or branding identifier for the admin dashboard

**Layout Expectations:**
- The media asset list should be the primary focus.
- Upload and import options should be accessible but secondary (e.g., buttons at the top or side).
- The dashboard should use a consistent table or card-based layout for displaying assets.

**Responsive Behavior:**
- Mobile: The media asset table may condense or use a card-based layout instead of a traditional table to fit smaller screens.
- Tablet: Table layout is acceptable with some column consolidation if necessary.
- Desktop: Traditional table layout with all columns visible.

---

## 4. Interactive Patterns

### 4.1 Copy Buttons (Clipboard Functionality)

**Behavior:**
- Copy buttons ("Copy Embed Code," "Copy Image URL," "Copy `<img>` Tag") should:
  1. Copy the specified code/URL to the user's clipboard when clicked
  2. Provide immediate visual feedback that the action succeeded
  3. Remain on the page (no navigation)

**Feedback Mechanism:**
- After clicking a copy button, one of the following feedback patterns should occur:
  - Option A: The button text temporarily changes (e.g., from "Copy Embed Code" to "Copied!" or "✓ Copied")
  - Option B: A toast notification appears briefly (e.g., at the bottom or top of the screen) confirming the copy action
  - Option C: A brief success message or icon appears near the button
- Feedback should be visible for 2–3 seconds before returning to the original state.
- Implementation: Use Alpine.js to handle the button click and clipboard operation.

**Technical Notes:**
- Copy functionality must use the Clipboard API (`navigator.clipboard.writeText()`) or a fallback method if necessary.
- The exact code/URL to be copied should be generated server-side (in Blade) and embedded in the page.

---

### 4.2 Form Submission Behavior

**For Upload and Import Forms:**
- When the user submits the form (upload or import):
  1. Disable the submit button to prevent duplicate submissions
  2. Show a loading state (button text change or spinner) to indicate processing
  3. Upon success, redirect to the updated dashboard or display a success message
  4. Upon error, display the error message (see Section 6.3 for error state details)

**Visual Feedback:**
- The submit button should change appearance while processing (disabled state, loading text, spinner icon).
- Error messages should be displayed inline or above the form.
- Success messages may be displayed inline or as a toast notification.

---

### 4.3 Confirmation Dialogs

**For Delete Operations:**
- When a user clicks "Delete" on an asset, a confirmation dialog or modal should appear.
- The dialog must clearly state:
  - "Are you sure you want to delete [Asset Name]?"
  - "This action cannot be undone." (or similar warning)
- The dialog must provide two clear options:
  - "Cancel" (closes the dialog without deleting)
  - "Delete" or "Yes, Delete" (confirms the deletion)
- The delete button should be visually distinct (e.g., a different color to indicate danger).

**For Rename Operations:**
- Rename functionality can be either:
  - Inline editing (click asset name to edit, enter new name, click save/cancel), or
  - A modal form with the asset name pre-filled and "Save" and "Cancel" buttons
- The choice between inline and modal editing is TBD.

---

## 5. Empty States

Empty states occur when a gallery or dashboard contains no media assets. They should be handled as follows:

### 5.1 Empty Image Gallery

**Scenario:** No images have been uploaded.

**Expected Display:**
- A clear message: "No images available yet."
- Optional: A brief explanation (e.g., "Check back soon for new images to use in your projects.")
- Navigation back to the homepage should remain available.

**Visual Treatment:**
- Center the message on the page.
- The message should be easy to read and not alarming.

---

### 5.2 Empty Video Library

**Scenario:** No videos have been uploaded.

**Expected Display:**
- A clear message: "No videos available yet."
- Optional: A brief explanation (e.g., "Check back soon for new videos to use in your projects.")
- Navigation back to the homepage should remain available.

**Visual Treatment:**
- Center the message on the page.
- The message should be easy to read and not alarming.

---

### 5.3 Empty Admin Dashboard

**Scenario:** An admin has logged in but no assets have been uploaded yet.

**Expected Display:**
- A message: "No assets yet. Upload or import your first media to get started."
- The upload and import buttons/forms should remain fully visible and accessible.
- No error message should be displayed; this is a normal state.

---

## 6. Error States

Error states occur when an action fails or when a user requests something that cannot be fulfilled. The following scenarios must be handled:

### 6.1 Asset Not Found (404)

**Scenario:** A student navigates to a detail page for a media asset that does not exist or has been deleted.

**Expected Display:**
- A clear message: "Media not found" or "This media is no longer available."
- Optional explanation: "It may have been deleted or the link is incorrect."
- Navigation back to the appropriate gallery (Image Gallery or Video Library) should be provided.
- No technical error details should be displayed to the student.

**Status Code:** HTTP 404 Not Found

---

### 6.2 Unauthorized Access

**Scenario:** A student or unauthenticated user attempts to access an admin page.

**Expected Display:**
- The user should be redirected to the login page.
- If the redirect is not possible, a clear message should state: "You do not have permission to view this page. Please log in."
- A link to the homepage should be provided.

**Status Code:** HTTP 401 Unauthorized or HTTP 403 Forbidden (depending on context)

---

### 6.3 Failed Upload

**Scenario:** An admin attempts to upload a file but the upload fails (e.g., invalid file type, file too large, server error).

**Expected Display:**
- An error message displayed above or below the upload form, clearly stating:
  - What went wrong (e.g., "File type not supported" or "File is too large")
  - What the user can do to fix it (e.g., "Please choose a JPEG, PNG, or MP4 file")
- The form should remain visible and editable so the user can correct the input and resubmit.
- The file input and other form fields should not be cleared.

**Validation Messaging:**
- Client-side validation (in the browser) should provide immediate feedback for obvious issues (e.g., "Please select a file").
- Server-side validation errors should be displayed prominently.

---

### 6.4 Failed Import

**Scenario:** An admin attempts to import media from a URL but the import fails (e.g., invalid URL, network error, unsupported file type, file too large).

**Expected Display:**
- An error message displayed above or below the import form, clearly stating:
  - What went wrong (e.g., "URL is invalid" or "File is too large")
  - What the user can do to fix it (e.g., "Please provide a valid URL to a JPEG, PNG, or MP4 file")
- The form should remain visible and editable so the user can correct the input and resubmit.
- The URL field should not be cleared.

**Validation Messaging:**
- Client-side validation should check that the URL field is not empty.
- Server-side validation should check the URL format and file accessibility.

---

### 6.5 Session Expired or Logout

**Scenario:** An admin's session expires or they voluntarily log out.

**Expected Display:**
- The user should be redirected to the public homepage.
- Optionally, a brief message can be displayed on the homepage (e.g., "You have been logged out") before redirecting.
- No technical session details should be exposed.

---

## 7. Responsive Expectations

The application must be functional and usable across multiple screen sizes:

### 7.1 Mobile Devices (Small Screens: < 768px)

**General Expectations:**
- Single-column layouts for listings and galleries.
- Buttons and form inputs should be touch-friendly (minimum 44px height).
- Navigation should be accessible but compact (no large sidebars).
- Text should be readable without horizontal scrolling.
- Images and videos should scale responsively to fill the available width.

**Specific Page Adjustments:**
- **Listing pages:** Single-column grid of media cards.
- **Detail pages:** Media should fill the viewport width, buttons stacked vertically below.
- **Admin dashboard:** Consider a card-based layout for assets instead of a table, or condense table columns.
- **Forms:** Input fields should be full-width or nearly full-width.

---

### 7.2 Tablet Devices (Medium Screens: 768px – 1024px)

**General Expectations:**
- Multi-column layouts are acceptable.
- Navigation can be expanded from mobile constraints.
- Tables can display multiple columns.
- Media can be centered with appropriate padding.

**Specific Page Adjustments:**
- **Listing pages:** Two-column grid of media cards.
- **Detail pages:** Media centered with moderate padding, buttons positioned below or to the side.
- **Admin dashboard:** Table layout is acceptable; consider condensing less critical columns if needed.

---

### 7.3 Desktop Devices (Large Screens: ≥ 1024px)

**General Expectations:**
- Multi-column layouts are standard.
- Full table layouts can be used without condensing.
- Navigation can be expanded (sidebar, top nav, etc.).
- Media can be centered with appropriate spacing.

**Specific Page Adjustments:**
- **Listing pages:** Three or more columns in the grid.
- **Detail pages:** Media centered, buttons positioned below or to the side with full visibility.
- **Admin dashboard:** Full table layout with all columns visible.

---

## 8. AI Improvement Suggestions (Flagged)

The following suggestions are raised for consideration but are not required for the current scope:

### 8.1 Pagination and Lazy-Loading

**Suggestion:** As the media library grows, the listing pages may display many assets at once. Consider implementing pagination (separate pages of results) or lazy-loading (load more assets as the student scrolls) to improve performance and user experience.

**Decision Point:** Determine whether pagination or infinite scroll is preferred, and at what asset count this becomes necessary.

### 8.2 Search Functionality

**Suggestion:** Add a search bar on the listing pages to allow students to find assets by name. This would also appear on the admin dashboard to help admins locate assets in a large library.

**Decision Point:** Determine whether search is in scope and what level of search sophistication is needed (simple name matching vs. advanced filters).

### 8.3 Inline Editing for Admin Rename

**Suggestion:** For the rename operation, inline editing (where the admin clicks the asset name to edit it directly in the list) may be more efficient than a separate modal form.

**Decision Point:** Determine whether inline editing or modal-based editing is preferred.

### 8.4 Asset Preview Modal

**Suggestion:** On the admin dashboard, a "Preview" button could open a modal overlay showing the media without navigating to a separate page. This would make the admin workflow faster for quick previews.

**Decision Point:** Determine whether preview should be inline, in a modal, or on a separate detail page.

### 8.5 Bulk Operations

**Suggestion:** If admins frequently manage many assets, bulk operations (select multiple assets and delete/rename them together) could improve efficiency.

**Decision Point:** Determine whether bulk operations are needed for the current use case.

### 8.6 File Size and Type Validation

**Suggestion:** Display file size limits and supported file types prominently in the upload and import forms. Provide clear, user-friendly error messages if files do not meet requirements.

**Decision Point:** Determine supported file types and maximum file sizes, then ensure they are documented in the UI.

---

**End of UI Framework**
