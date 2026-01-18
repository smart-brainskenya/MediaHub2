# 10: Visual Identity

## Purpose of This Document

This document defines the visual branding and identity standards for the **Smart Brains Media Hub**. It serves as the authoritative reference for UI implementation, ensuring the platform is playful and student-friendly on public pages while remaining professional and efficient on admin pages.

This document derives from `00_CANONICAL_OVERVIEW.md` and the official logo analysis.

---

## 1. Brand Core Identity

### Brand Personality
- **Public (Student) Face:** Playful, Energetic, Welcoming, Curious, Safe.
- **Admin (Staff) Face:** Organized, Efficient, Calm, Professional.

### The "Smart Brains" Aesthetic
The visual language combines the structure of technology (circuitry/connections) with the warmth of learning (organic shapes, bright colors).

---

## 2. Color Palette

### 2.1 Primary Brand Colors
These colors form the core of the Smart Brains identity and must be defined in `tailwind.config.js`.

| Name | HEX | Tailwind Token | Usage |
| :--- | :--- | :--- | :--- |
| **Smart Blue** | `#0954B8` | `brand-blue` | Primary buttons, Headings, Links, Admin Header. High contrast text. |
| **Sky Blue** | `#38B6FF` | `brand-sky` | Background accents, Illustrations, Secondary buttons, Icons. |
| **Brainy Yellow** | `#FFBD59` | `brand-yellow` | Highlights, "New" badges, Playful UI elements, Call-to-Action backgrounds (with dark text). |
| **Creative Orange**| `#FF914D` | `brand-orange` | Warm accents, Gradients, Warning states. |

### 2.2 Neutral Scale
Used for text, borders, and backgrounds to balance the bright brand colors.

| Name | HEX | Usage |
| :--- | :--- | :--- |
| **Canvas White** | `#FFFFFF` | Page backgrounds, Cards. |
| **Off White** | `#F8FAFC` | App backgrounds (slate-50). |
| **Soft Gray** | `#E2E8F0` | Borders, Dividers (slate-200). |
| **Body Gray** | `#475569` | Secondary text, descriptions (slate-600). |
| **Ink Black** | `#0F172A` | Primary text, Headings (slate-900). |

### 2.3 Approved Gradients
Gradients should be used sparingly to add depth, primarily on the Public UI.

- **Ocean Gradient:** `bg-gradient-to-br from-[#38B6FF] to-[#0954B8]`
  - *Usage:* Hero sections, Primary Call-to-Action containers.
- **Sunset Gradient:** `bg-gradient-to-br from-[#FFBD59] to-[#FF914D]`
  - *Usage:* Special badges, "New" indicators, playful highlights.

---

## 3. UI Component Styling

### 3.1 Buttons

**Public UI (Playful):**
- **Primary:** Solid **Smart Blue** (`#0954B8`) background, White text. Rounded-full (pill shape) or Rounded-xl.
  - *Hover:* Slight brightness lift or scale up (`transform scale-105`).
- **Secondary:** Solid **Brainy Yellow** (`#FFBD59`) background, **Ink Black** text.
- **Ghost:** Transparent background, **Smart Blue** text, Hover **Sky Blue** background (low opacity).

**Admin UI (Professional):**
- **Primary:** Solid **Smart Blue** (`#0954B8`) background, White text. Standard Rounded-md.
- **Secondary:** White background, **Soft Gray** border, **Ink Black** text.
- **Danger:** Rose/Red background (standard Tailwind `red-600`), White text.

### 3.2 Cards and Surfaces

- **Public:** White cards with soft, large shadows (`shadow-lg`, `shadow-xl`). Rounded-2xl corners. Border radius should be generous (16px+).
- **Admin:** White cards with subtle shadows (`shadow-sm`). Rounded-lg (standard) corners.

### 3.3 Typography Tone

**Font Family:**
- Prefer **System Fonts** (`sans-serif`) for performance, but style them differently based on context.
- *Recommendation for future improvement:* Integrate a rounded sans-serif font (e.g., 'Nunito' or 'Quicksand') for headings to enhance friendliness.

**Hierarchy:**
- **Headings (Public):** Bold, Tight tracking. Colors can use **Smart Blue**.
- **Body:** Readable, comfortable line height (1.6). High contrast (**Ink Black**).

---

## 4. Logo & Visual Assets

### 4.1 Logo Usage

The Smart Brains logo is the anchor of the brand.

- **Public Pages:**
  - **Full Logo:** Must be prominent in the Header/Navbar.
  - **Size:** Large enough to be legible (min-height 40px).
  - **Background:** Placed on White or very light backgrounds. If placed on a dark background, use a white-monochrome version (if available).

- **Admin Pages:**
  - **Compact/Subtle:** Logo should be smaller in the sidebar or top bar.
  - **Neutrality:** It serves as a home link, not a marketing element.

### 4.2 Favicon Strategy

Implementers must generate favicons derived from the "Brain/Circuit" icon portion of the SVG logo.

**Required Files:**
1.  `favicon.ico`: 32x32px (Legacy support).
2.  `favicon-32x32.png`: Standard desktop.
3.  `apple-touch-icon.png`: 180x180px (iOS home screen).
4.  `android-chrome-192x192.png`: Android home screen.

**Location:**
- Store in `/public/` root directory.
- Reference in `resources/views/layouts/*.blade.php`.

---

## 5. Interaction Design (Micro-interactions)

### 5.1 Hover States
- **Public:** Elements should feel "tactile". Buttons and cards can lift (`-translate-y-1`) or glow on hover.
- **Admin:** Standard color shifts (darken/lighten). No movement.

### 5.2 Focus States
- All interactive elements must have a visible focus ring for accessibility.
- **Color:** Use **Smart Blue** (`ring-[#0954B8]`) or **Sky Blue** (`ring-[#38B6FF]`) for the focus ring.

---

## 6. Implementation Guide (Tailwind Setup)

Add these colors to `tailwind.config.js` to ensure consistency:

```javascript
module.exports = {
    theme: {
        extend: {
            colors: {
                brand: {
                    blue: '#0954B8',
                    sky: '#38B6FF',
                    yellow: '#FFBD59',
                    orange: '#FF914D',
                }
            }
        }
    }
}
```

**Usage Examples:**
- `bg-brand-blue`
- `text-brand-orange`
- `border-brand-yellow`
- `hover:bg-brand-sky`

---

## 7. Scope Boundaries (What NOT to do)

- **Do NOT** use the **Brainy Yellow** for text backgrounds unless the text is Black (accessibility contrast failure with white text).
- **Do NOT** use complex gradients on the Admin Dashboard; keep it clean for data density.
- **Do NOT** distort the logo aspect ratio.
- **Do NOT** use unrelated colors (e.g., Purple, Pink, Green) unless they are system status colors (Success/Error).

---

**End of Visual Identity**