# 10: Visual Identity

## Purpose of This Document

This document defines the visual branding and identity standards for the Smart Brains Media Hub. Its purpose is to ensure that the visual presentation of the platform is consistent, professional, and aligned with Smart Brains values. This document serves as a reference for all UI implementation decisions regarding colors, typography, logos, and accessibility.

This document derives from the authoritative source: `00_CANONICAL_OVERVIEW.md`.

---

## 1. Brand Alignment Strategy

### Current State of Smart Brains Branding

**The Smart Brains organization's visual identity, including:**
- Primary and secondary brand colors
- Official logo and usage guidelines
- Typography standards (font families, sizing hierarchies)
- Visual tone and design philosophy

**...are NOT currently defined in the ai-spec documentation.**

### Decision: Neutral Defaults Until Brand Information is Provided

**The Media Hub will adopt the following approach:**

1. **Neutral, Professional Styling:** Until Smart Brains branding specifications are provided, the Media Hub will use a neutral, professional color palette and typography.

2. **No Assumptions About Brand Colors:** The implementation will NOT assume or invent brand colors. Instead, it will use Tailwind CSS's neutral and gray scales exclusively.

3. **Placeholder for Logo:** The platform will include a space for the Smart Brains logo, but no specific logo design or placement rules are defined. A placeholder text (e.g., "Smart Brains Media Hub") will be used until the logo is provided.

4. **Accessibility-First Approach:** All design decisions will prioritize accessibility (WCAG 2.1 AA compliance) to ensure the platform is usable by all students and staff.

5. **Scalability:** Once Smart Brains branding guidelines are provided, the implementation can be updated to incorporate official colors, fonts, and logos without requiring architectural changes.

---

## 2. Logo Usage

### Logo Placement

The Smart Brains logo (or organizational identifier) should appear in the following locations:

**Public Pages:**
- **Homepage:** Small logo or text identifier ("Smart Brains Media Hub") in the page header, top-left or centered, depending on layout preference (TBD).
- **Gallery Pages:** Small logo or text identifier in the page header, consistent with the homepage.
- **Detail Pages:** Optional; logo placement should be consistent with other pages.

**Admin Pages:**
- **Dashboard Header:** Logo or text identifier ("Smart Brains Media Hub" or "Admin Dashboard") should be visible in the navigation header.
- **Login Page:** Optional; a minimal logo or text identifier may appear, but the login page should be simple and focused.

### Logo Exclusions

The Smart Brains logo must NOT appear in the following locations:

- **Embed Pages (for `<iframe>`):** Embed pages (`/embed/video/{id}`) must remain completely minimal and not display any logo or branding. The iframe content should contain only the media player.
- **Error Pages:** Logos are optional on error pages, but should not distract from the error message.
- **Individual Media Cards:** Media asset cards should not display a logo; they should focus on the media thumbnail and name.

### Logo Specifications (TBD)

The following details about the Smart Brains logo are **not yet defined** and must be provided by the organization:

- Official logo file (SVG, PNG, or other format)
- Minimum size requirements
- Spacing/padding guidelines (clear space around the logo)
- Color variations (e.g., full color, monochrome, inverse)
- Usage restrictions (e.g., do not stretch, do not rotate)

---

## 3. Color Usage

### Current Color Strategy: Neutral Defaults

**Because Smart Brains brand colors have not been specified, the Media Hub will use a neutral color palette.**

### Tailwind Neutral Palette (Default)

The implementation should restrict Tailwind CSS color usage to the following scales:

- **Gray / Slate:** `gray-*`, `slate-*` (for text, backgrounds, borders)
- **White:** `white` (for backgrounds and content areas)
- **Black:** `black` (for text and borders, used sparingly)

**Specifically RESTRICTED:**
- Do NOT use Tailwind's colored scales (`red-*`, `blue-*`, `green-*`, `yellow-*`, `purple-*`, etc.) unless explicitly approved by Smart Brains branding guidelines.

### Color Semantic Usage

Even within the neutral palette, colors should be used consistently for specific purposes:

| Purpose                 | Tailwind Scale             | Notes                                                      |
| ----------------------- | -------------------------- | ---------------------------------------------------------- |
| **Primary Text**        | `gray-900` or `slate-900`  | For headings and main content; must have high contrast.    |
| **Secondary Text**      | `gray-600` or `slate-600`  | For labels, helper text, and meta information.             |
| **Tertiary Text**       | `gray-500` or `slate-500`  | For disabled states and deemphasized content.              |
| **Backgrounds**         | `white`, `gray-50`         | For content areas and cards.                              |
| **Borders**             | `gray-200` or `slate-200`  | For dividers and card edges.                              |
| **Hover/Active States** | `gray-100` or `slate-100`  | For interactive elements when hovered or focused.         |

### Accent Colors for Interactive Elements

Neutral colors alone may not be sufficient to distinguish interactive elements (buttons, links, hover states). In such cases, the following temporary approach is acceptable:

**Option A: Grayscale Buttons**
- Primary buttons: `gray-900` text on `gray-100` background
- Danger buttons (delete): `white` text on `gray-800` background
- Secondary buttons: border only, no background fill

**Option B: Wait for Brand Colors**
- Defer the selection of button accent colors until Smart Brains provides brand colors.
- Use neutral grayscale buttons as a placeholder.

### Success, Warning, and Error States

For functional states, a minimal color palette may be necessary:

| State       | Current Approach           | Notes                                                      |
| ----------- | -------------------------- | ---------------------------------------------------------- |
| **Success** | `gray-700` text + checkmark | Consider a subtle background if contrast is insufficient. |
| **Error**   | `gray-900` text with icon   | Avoid red if no brand color palette is defined.           |
| **Warning** | `gray-700` text with icon   | Avoid yellow/orange if no brand color palette is defined. |
| **Info**    | `gray-600` text with icon   | Use for informational messages.                           |

**Accessibility Note:** Do not rely on color alone to indicate state. Always pair color with icons, text, or other visual cues.

### Future Brand Color Integration

Once Smart Brains provides an official brand color palette, the implementation can be updated by:

1. Defining custom Tailwind colors in `tailwind.config.js` (e.g., `brand-primary`, `brand-secondary`).
2. Replacing all instances of `gray-*` and `slate-*` with the appropriate brand colors.
3. Updating button styles to use brand accent colors.
4. Ensuring all changes maintain WCAG 2.1 AA contrast ratios (see Section 6).

---

## 4. Typography

### System Fonts (Recommended Default)

Until Smart Brains specifies a custom font family, the Media Hub should use system fonts for maximum compatibility and performance:

**Font Family Stack:**
```
font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
```

This stack ensures:
- Optimal rendering on macOS and iOS (San Francisco)
- Optimal rendering on Windows (Segoe UI)
- Optimal rendering on Android (Roboto)
- Fallback to standard sans-serif fonts on unsupported systems

### Tailwind Font Configuration

The default Tailwind font stack (`font-sans`) includes system fonts and is recommended. No custom font family need be configured at this time.

### Font Size Hierarchy

The following size hierarchy should be maintained for consistency:

| Purpose              | Size              | Notes                                                    |
| -------------------- | ----------------- | -------------------------------------------------------- |
| **Heading 1** (H1)   | `text-3xl` (30px) | Page titles and primary headings.                        |
| **Heading 2** (H2)   | `text-2xl` (24px) | Section headings.                                        |
| **Heading 3** (H3)   | `text-xl` (20px)  | Subsection headings.                                     |
| **Body Text**        | `text-base` (16px)| Default for paragraphs, labels, and button text.         |
| **Small Text**       | `text-sm` (14px)  | Helper text, meta information, secondary labels.         |
| **Tiny Text**        | `text-xs` (12px)  | Minimal use; use only for non-critical information.      |

**Minimum Font Size for Students:** All body text and form labels should be at least `text-base` (16px) to ensure readability for young learners.

### Font Weight

The following weights should be used consistently:

| Usage                     | Weight             | Tailwind Class |
| ------------------------- | ------------------ | -------------- |
| **Headings**              | Bold (700)         | `font-bold`    |
| **Section Labels**        | Semibold (600)     | `font-semibold`|
| **Body Text** (default)   | Regular (400)      | `font-normal`  |
| **Deemphasized Text**     | Regular (400)      | `font-normal`  |

### Future Custom Font Integration

If Smart Brains provides a custom brand font, it can be added to the project by:

1. Obtaining the font files (WOFF2 preferred for web).
2. Adding the font to the Tailwind configuration in `tailwind.config.js`.
3. Updating the font stack to prioritize the brand font with appropriate fallbacks.

---

## 5. Visual Tone

### Design Philosophy

The Smart Brains Media Hub should embody the following visual and interactive characteristics:

### Simplicity and Clarity

- **Minimal Visual Hierarchy:** Use whitespace, size, and contrast to guide the user's attention.
- **No Unnecessary Decoration:** Avoid gradients, shadows (unless functional), ornamental graphics, or animations that don't serve a purpose.
- **Clear Labeling:** Every interactive element should have a clear, unambiguous label.
- **Consistent Patterns:** Repeat visual patterns across all pages to build familiarity.

### Educational and Student-Friendly

- **Non-Threatening:** The interface should feel welcoming and approachable, not corporate or intimidating.
- **Clear Purpose:** Every page and control should communicate its purpose clearly, in language appropriate for students.
- **Forgiving Design:** The interface should make it easy to undo mistakes (e.g., confirmation dialogs for deletions, clear error messages).

### Professional and Trustworthy

- **Polished Presentation:** Even with neutral colors, the interface should feel complete and intentional.
- **Consistent Spacing:** Use consistent padding and margins throughout (leverage Tailwind's spacing scale).
- **Aligned Elements:** All elements should be precisely aligned using a grid or layout system.

### Tone Guidelines

- **Neutral, not playful:** Avoid gamification, emoji overuse, or cutesy language. The tone should be professional but approachable.
- **Instructional, not prescriptive:** Use language that guides students without being condescending (e.g., "Choose a media type" rather than "Pick one, silly!").
- **Supportive, not punitive:** Error messages should help users fix problems, not shame them.

---

## 6. Accessibility Baselines

The Media Hub must adhere to WCAG 2.1 AA accessibility standards as a minimum requirement. The following baselines apply:

### 6.1 Contrast Requirements

**Text Contrast:**
- **Normal Text (≥14px):** Minimum contrast ratio of 4.5:1 (WCAG AA).
- **Large Text (≥18px):** Minimum contrast ratio of 3:1 (WCAG AA).
- **UI Components (borders, icons):** Minimum contrast ratio of 3:1 (WCAG AA).

**Practical Implementation:**
- Use `gray-900` or `slate-900` text on `white` or light backgrounds (meets 4.5:1).
- Use `gray-600` text only for secondary, non-critical information.
- Test contrast ratios using a tool like WebAIM Contrast Checker or browser DevTools.

### 6.2 Font Size Minimums

- **Body Text:** Minimum `text-base` (16px) for primary content.
- **Form Labels:** Minimum `text-base` (16px).
- **Button Text:** Minimum `text-base` (16px).
- **Helper Text:** Minimum `text-sm` (14px) if unavoidable; prefer `text-base`.

**Rationale:** Ensures readability for all users, including those with low vision or using small devices.

### 6.3 Color Accessibility

- **Do Not Rely on Color Alone:** Every piece of information conveyed by color must also be conveyed by another visual means (icon, text, pattern).
  - Example: A success message should use both a green background AND a checkmark icon.
- **Color-Blind Friendly:** Neutral colors are inherently color-blind friendly, but avoid using only red/green combinations without additional context.

### 6.4 Interactive Element Sizing

- **Button and Touch Target Sizes:** All clickable elements (buttons, links, form inputs) should have a minimum size of 44×44 pixels to accommodate touch input on mobile devices.
- **Spacing Between Controls:** Interactive elements should be spaced at least 8 pixels apart to prevent accidental clicks.

### 6.5 Keyboard Navigation

- **Focusable Elements:** All interactive elements (buttons, links, form inputs) must be keyboard-navigable using the Tab key.
- **Focus Indicator:** Focused elements must have a visible focus indicator (default browser focus ring is acceptable; Tailwind provides `focus:outline` classes).
- **Logical Tab Order:** Tab order should follow the logical reading order of the page (left-to-right, top-to-bottom for English).
- **Skip Links:** Consider adding a "Skip to main content" link for keyboard users to bypass repetitive navigation.

### 6.6 Alternative Text for Images

**For Media Thumbnails:**
- Each media thumbnail in the gallery should have an `alt` attribute describing the image or indicating "Video thumbnail" for video assets.
- Example: `alt="Mountains landscape image"` or `alt="Video thumbnail: Introduction to HTML"`

**For UI Icons:**
- Icons used to convey meaning (e.g., a delete icon, checkmark, warning icon) should have an `aria-label` attribute.
- Example: `<button aria-label="Delete this media">🗑</button>`

**For Decorative Images:**
- If an image is purely decorative (not conveying information), use `alt=""` and `role="presentation"` to hide it from screen readers.

### 6.7 Form Accessibility

- **Associated Labels:** Every form input must have an associated `<label>` element with a matching `for` attribute.
  ```html
  <label for="asset-name">Asset Name</label>
  <input id="asset-name" type="text" name="name">
  ```
- **Error Messages:** Error messages should be associated with their corresponding input using `aria-describedby`.
- **Required Fields:** Clearly mark required fields with text or an icon, not color alone.

### 6.8 Screen Reader Support

- **Semantic HTML:** Use proper HTML elements (buttons, links, headings, lists) to provide semantic meaning to screen reader users.
- **ARIA Labels:** Use `aria-label` and `aria-describedby` for elements that require additional context.
- **List Structure:** Use proper list markup (`<ul>`, `<ol>`, `<li>`) for galleries and asset listings.
- **Role Attributes:** Use `role` attributes sparingly, only when semantic HTML is insufficient.

### 6.9 Animation and Motion

- **Reduced Motion:** Respect the user's `prefers-reduced-motion` setting by removing or reducing animations for users who request this.
  ```css
  @media (prefers-reduced-motion: reduce) {
    * { animation: none !important; transition: none !important; }
  }
  ```
- **No Seizure-Inducing Effects:** Avoid flashing or strobing content that could trigger photosensitive seizures.

---

## 7. Tailwind CSS Configuration

### Current Configuration

The Media Hub uses Tailwind CSS for styling. The following configuration guidelines apply:

### Color Restrictions (Neutral Defaults)

**Default Behavior:**
- Use Tailwind's default neutral and slate scales only.
- Do NOT introduce custom colors for branding purposes until Smart Brains branding is provided.

**Example Configuration (placeholder):**
```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        // Do NOT add custom colors here until branding is defined
        // Examples of what NOT to do:
        // 'brand-primary': '#1E3A8A', // Remove this
        // 'brand-secondary': '#64748B', // Remove this
      },
    },
  },
};
```

### Spacing and Layout

- **Default Spacing Scale:** Use Tailwind's default spacing scale (`p-4`, `m-2`, `gap-6`, etc.) for padding, margin, and gaps.
- **Responsive Breakpoints:** Use Tailwind's default breakpoints (`sm`, `md`, `lg`, `xl`) for responsive design.
- **Grid System:** Use Tailwind's `grid` and `grid-cols-*` utilities for layout.

### Buttons and Interactive Elements

**Button Styling (Neutral Defaults):**
```html
<!-- Primary Button -->
<button class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-gray-800 focus:outline">
  Click Me
</button>

<!-- Secondary Button -->
<button class="px-4 py-2 border border-gray-300 text-gray-900 rounded hover:bg-gray-50 focus:outline">
  Cancel
</button>

<!-- Danger Button (Delete) -->
<button class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 focus:outline">
  Delete
</button>
```

### Future Brand Color Integration

When Smart Brains provides brand colors, update the configuration:

```javascript
// tailwind.config.js (FUTURE)
module.exports = {
  theme: {
    extend: {
      colors: {
        'brand-primary': '#2563EB',   // Example: Smart Brains blue
        'brand-secondary': '#64748B', // Example: Smart Brains gray
        'brand-accent': '#DC2626',    // Example: Smart Brains red
      },
    },
  },
};
```

Then replace all neutral colors with brand colors in the codebase.

---

## 8. AI Improvement Suggestions (Flagged)

The following suggestions are raised for consideration but require input from Smart Brains leadership:

### 8.1 Brand Colors Definition

**Assumption:** The Media Hub currently uses neutral grayscale colors because Smart Brains brand colors are not yet specified.

**Suggestion:** Obtain or define the official Smart Brains brand color palette, including:
- Primary brand color (for buttons, links, accents)
- Secondary brand color (for supporting UI elements)
- Accent colors (for success, warning, error states)
- Contrast requirements for brand colors against light and dark backgrounds

**Decision Point:** Once provided, the Media Hub implementation can be updated to use these colors throughout.

### 8.2 Logo and Visual Assets

**Assumption:** No Smart Brains logo or visual assets are currently defined for the Media Hub.

**Suggestion:** Provide the official Smart Brains logo in vector format (SVG recommended) and define:
- Logo placement rules on public and admin pages
- Minimum size requirements
- Spacing guidelines
- Color variations (full color, monochrome, inverse)

**Decision Point:** Once provided, the logo can be integrated into page headers and navigation.

### 8.3 Custom Font Family

**Assumption:** The Media Hub currently uses system fonts (default Tailwind) because no custom brand font has been specified.

**Suggestion:** If Smart Brains has a brand font family, provide the font files (WOFF2 format recommended for web) and integrate them into the Tailwind configuration.

**Decision Point:** Custom fonts improve brand identity but may impact page load performance. Consider performance trade-offs before committing to custom fonts.

### 8.4 Dark Mode Support

**Suggestion:** Consider implementing dark mode support for the Media Hub using Tailwind's `dark:` utilities. This would allow users to view the platform in a dark color scheme, reducing eye strain in low-light conditions.

**Decision Point:** Determine whether dark mode is a priority for the target user base (students in school settings likely use light mode during the day, but night learners may benefit from dark mode).

### 8.5 Motion and Animation Guidelines

**Suggestion:** Define specific animation guidelines for the platform:
- When should elements animate (transitions, fades)?
- What duration should animations use (e.g., 200ms, 300ms)?
- Should animations be reduced for users with `prefers-reduced-motion`?

**Decision Point:** Animations can improve UX but may distract from content. Define expectations to ensure consistency.

### 8.6 Micro-Interactions and Feedback

**Suggestion:** Standardize feedback mechanisms for user actions:
- Copy to clipboard: how long should the "Copied!" message display? (Currently suggested: 2–3 seconds)
- Form submission: what animation or indicator shows the form is processing?
- Delete confirmation: should the delete button change color or appearance while processing?

**Decision Point:** Consistent feedback patterns improve user confidence. Define these patterns before implementation.

---

**End of Visual Identity**
