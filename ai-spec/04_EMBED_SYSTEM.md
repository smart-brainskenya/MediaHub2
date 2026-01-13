# 04: Embed System

## Purpose of This Document

This document provides a detailed explanation of the critical **mental model** and **technical implementation** for embedding media, particularly videos. The primary goal is to replicate the familiar workflow of embedding a YouTube video while ensuring the system works in a restricted, zero-data environment.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## The Core Problem

Students are taught to embed videos using `<iframe>` code copied from services like YouTube. This workflow breaks in zero-data environments where YouTube is blocked. A direct link to a video file (`<video src=".../my_video.mp4">`) presents a different mental model and can be less reliable.

The Media Hub solves this by adopting YouTube's `<iframe>` pattern but routing it to an internal, self-hosted player.

## The Non-Negotiable Embed Model

The system must follow this three-step process:

1.  **The `<iframe>` Snippet:** The student copies a standard HTML `<iframe>` tag from the Media Hub.
    ```html
    <!-- Example of what the student copies -->
    <iframe
        width="560"
        height="315"
        src="https://mediahub.smartbrains.internal/embed/video/123"
        frameborder="0"
        allowfullscreen
    ></iframe>
    ```
    The `src` attribute **must** point to an internal page on the Media Hub, not directly to a video file.

2.  **The Internal Embed Page:** The URL in the `src` attribute (`.../embed/video/123`) loads a dedicated, minimalist HTML page from the Laravel application. This page has one job: to display a video player.

3.  **The Native `<video>` Element:** Inside that internal embed page, a native HTML `<video>` element is used to play the actual video file, which is also served from the Smart Brains infrastructure.
    ```html
    <!-- Simplified content of the .../embed/video/123 page -->
    <html>
    <head>
        <style>
            /* Styles to make video fill the iframe */
            body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; }
            video { width: 100%; height: 100%; }
        </style>
    </head>
    <body>
        <video controls src="https://media.smartbrains.internal/assets/videos/example_video.mp4"></video>
    </body>
    </html>
    ```

This architecture ensures the student's workflow remains identical to what they were taught, preserving the lesson's continuity and mental model.

---

## Image Handling

Images are simpler and do not require an iframe model. The student should be able to copy either:

1.  **A Direct URL:**
    `https://media.smartbrains.internal/assets/images/example_image.jpg`

2.  **A Full `<img>` Tag:**
    `<img src="https://media.smartbrains.internal/assets/images/example_image.jpg" alt="Example Image">`

Both options allow the image to be easily used in student projects.

---

## Forbidden Practices

-   Students must **never** be given embed codes that link to external domains (e.g., YouTube, Vimeo).
-   The primary embed mechanism for videos must **not** be a direct link to the video file (e.g., `<video src="...">`). The `<iframe>` method is mandatory.

---

## AI Improvement Suggestions (Flagged)

*There are no AI-generated improvement suggestions at this time.*
