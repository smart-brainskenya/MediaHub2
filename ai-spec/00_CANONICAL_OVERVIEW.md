# Smart Brains Media Hub  
**Canonical Overview (Authoritative Source)**

## Purpose of This Document
This document defines the **core intent, scope, constraints, and mental model** of the Smart Brains Media Hub.  
All other documentation, implementation decisions, and AI-generated outputs **must derive from and remain consistent with this file**.

If there is a conflict between this document and any other instruction, **this document takes precedence**.

---

## 1. What Is Being Built

Smart Brains Media Hub is a **public, zero-data-compatible media platform** that allows students to safely access **images and videos** for use in coding projects.

The platform exists to replace external sources such as **YouTube and Google Images** in environments where:
- Internet access is restricted or unavailable
- Only Smart Brains domains are zero-rated
- External embeds and links are unreliable or blocked

The platform provides a **controlled alternative** that preserves familiar student workflows while ensuring **offline reliability and pedagogical continuity**.

---

## 2. Who This Product Is For

### Primary Users (Students)
- Children learning coding and basic web development
- Access the platform **without authentication**
- Browse, preview, and reuse media assets
- Copy links or embed code for use in their HTML projects

Students:
- Do **not** upload content
- Do **not** manage assets
- Do **not** authenticate

They are strictly **read-only consumers**.

---

### Administrators (Internal Staff)
- Smart Brains staff only
- Authenticated access required
- Fully manage all media assets

Admins:
- Upload images and videos
- Import media from external links (admin-only)
- Rename, preview, replace, or delete assets
- Control what students can see and reuse

---

## 3. Core Problem Being Solved

Previously, students were taught to:
- Copy **embed code** (e.g., from YouTube)
- Paste it into a code editor
- See a video appear on their website

However:
- YouTube and Google are not accessible under zero-data conditions
- External embeds fail without internet
- This breaks lessons and requires retraining students

The Media Hub solves this by:
- Hosting all media on Smart Brains infrastructure
- Providing **iframe-based embed codes** that behave like YouTube embeds
- Preserving the exact **student mental model** already taught

---

## 4. How Students Are Expected to Use the Platform

1. Student opens the Media Hub (public access)
2. Student chooses:
   - Video Library, or
   - Image Gallery
3. Student selects an asset
4. Student clicks:
   - “Copy Embed Code” (for videos), or
   - “Copy Image URL / `<img>` tag” (for images)
5. Student pastes into their HTML code
6. Asset renders correctly **without internet**

This workflow is **non-negotiable** and must remain simple and consistent.

---

## 5. Embed System Mental Model (Critical)

- Videos are embedded using `<iframe>` elements
- The iframe **does not embed a raw video file**
- The iframe loads an **internal Smart Brains embed page**
- That embed page contains a native HTML `<video>` player

This mirrors how YouTube embeds work **without relying on YouTube**.

Students must **never** embed external URLs.

---

## 6. Nature of the Media Assets

- Assets are **not curriculum-specific**
- No categories, topics, or grade-level organization
- Assets are treated as a **flat, reusable library**
- Media is intentionally “generic” and creativity-focused
- Assets are selected because students enjoy and reuse them

Any form of categorization or curriculum mapping is **explicitly out of scope**.

---

## 7. Technical & Architectural Constraints (Non-Negotiable)

The system **must** adhere to the following:

- Laravel monolith architecture
- Blade templates for rendering
- Alpine.js for frontend interactivity
- Tailwind CSS for styling
- Native HTML `<video>` and `<img>` elements
- iframe embeds only for internal embed pages
- Media served only from Smart Brains domains

The system **must not**:
- Use React or SPA frameworks
- Rely on browser right-click behavior
- Embed external content
- Allow student uploads
- Introduce unnecessary complexity

---

## 8. Authentication & Access Rules

- Student-facing pages are **public**
- Admin dashboard is **authenticated**
- No login or account creation for students
- All write operations are admin-only

This separation is intentional and must not be blurred.

---

## 9. What This Product Is NOT

The Media Hub is **not**:
- A social platform
- A content creation tool for students
- A curriculum management system
- A general-purpose CMS
- A replacement for YouTube at scale

It is a **focused utility** designed to solve a specific classroom constraint.

---

## 10. Definition of Success

The system is considered successful if:
- Students can embed videos exactly as they were taught before
- Media works reliably without internet access
- Teachers do not need to change lesson instructions
- Admins can manage assets easily
- The system remains simple, predictable, and stable

---

## 11. Guideline for AI Usage

Any AI generating documentation, code, or suggestions for this project must:
- Treat this document as authoritative
- Flag any suggested changes explicitly
- Avoid introducing new assumptions
- Prefer simplicity over novelty

---

**End of Canonical Overview**
