# 03: User Flows

## Purpose of This Document

This document describes the step-by-step user journeys for the two primary roles in the Smart Brains Media Hub: **Students** (public, anonymous users) and **Administrators** (internal, authenticated staff). Its purpose is to define the exact, expected interactions with the platform.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## 1. Student User Flow (Read-Only)

The student workflow is designed for simplicity and to mirror established patterns of using online media. Students do not require an account or any form of authentication.

**Assumptions:**
- The student has the URL to the Media Hub.
- The student is using a standard web browser.

**Flow:**

1.  **Access the Platform:** The student navigates to the public homepage of the Media Hub.

2.  **Select Media Type:** The homepage presents two clear options: "Image Gallery" and "Video Library". The student clicks on their desired media type.

3.  **Browse and Select:**
    - The student is taken to a grid or list view of all available assets.
    - The student scrolls through the media and clicks on a specific image or video to view it.

4.  **Preview and Copy Code:**
    - **For an Image:** The student is shown the image and provided with one or more of the following for easy copying:
        - The direct image URL.
        - A complete HTML `<img>` tag.
    - **For a Video:** The student is shown the video player and a button labeled "Copy Embed Code". Clicking this button copies a pre-formatted `<iframe>` snippet to their clipboard.

5.  **Use in Project:** The student switches to their code editor and pastes the copied URL, `<img>` tag, or `<iframe>` snippet into their HTML file. The asset will now render within their project.

This workflow is non-negotiable and must be maintained as described.

---

## 2. Administrator User Flow (Full Control)

The administrator workflow provides full management of all media assets on the platform. Access to these functions is strictly protected by an authentication system.

**Assumptions:**
- The administrator has a valid user account.
- The administrator knows the URL for the admin login page.

**Flow:**

1.  **Authenticate:** The administrator navigates to the admin login page and enters their credentials to access the dashboard.

2.  **Manage Media:** From the admin dashboard, the administrator can perform any of the following actions:
    - **Upload:** Upload new image or video files directly from their computer.
    - **Import:** Provide a URL to an external image or video, which the system will download, store internally, and make available as a new asset.
    - **View/Preview:** See a list of all managed assets and preview them.
    - **Edit:** Change the display name of an asset.
    - **Replace:** Upload a new file to replace an existing asset while keeping the same ID/URL.
    - **Delete:** Permanently remove an asset from the library.

3.  **Logout:** The administrator logs out of the system to end their session.

---

## AI Improvement Suggestions (Flagged)

*There are no AI-generated improvement suggestions at this time.*
