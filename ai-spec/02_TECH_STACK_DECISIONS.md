# 02: Tech Stack Decisions

## Purpose of This Document

This document outlines the non-negotiable technical and architectural constraints for the Smart Brains Media Hub. Its purpose is to ensure that the implementation adheres to a consistent, pre-defined technology stack, promoting long-term maintainability and stability.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## Mandated Technology Stack

All development must adhere strictly to the following architectural and technological choices. These decisions are final and not subject to change without updating the canonical overview.

| Component             | Technology / Standard          | Notes                                                              |
| --------------------- | ------------------------------ | ------------------------------------------------------------------ |
| **Backend Framework** | Laravel (Monolith)             | The entire application will be built as a single Laravel project.  |
| **Frontend Rendering**| Blade Templates                | All HTML views will be rendered server-side using Blade.           |
| **Frontend Interactivity**| Alpine.js                      | Used for lightweight, in-page interactivity (e.g., "Copy Code"). |
| **Styling**           | Tailwind CSS                   | The primary CSS framework for all styling.                         |
| **Media Display**     | Native HTML `<video>` & `<img>`| For rendering all media assets to the end-user.                    |
| **Video Embedding**   | `<iframe>` to an internal page | The standard method for embedding videos, mirroring YouTube's model. |
| **Media Storage**     | Smart Brains Infrastructure    | All assets are served from internal, zero-rated domains.           |

---

## Prohibited Technologies

The following technologies and approaches are explicitly forbidden to ensure simplicity and adherence to the project's core goals:

1.  **No Single-Page Applications (SPAs):** The project must not use frameworks like React, Vue, Angular, or Svelte. The frontend will be rendered server-side by Laravel Blade.

2.  **No External Embeds:** The system must not display content embedded from external or third-party domains.

3.  **No Complex Frontend State Management:** Global state management libraries are unnecessary and prohibited. State should be managed locally with Alpine.js or via server-side rendering.

4.  **No Non-Standard Browser Features:** The application should not rely on experimental APIs or behaviors not universally supported, such as depending on the browser's right-click context menu.

---

## AI Improvement Suggestions (Flagged)

*There are no AI-generated improvement suggestions at this time.*
