# Banli Theme Design System

This document is the project-side copy of the Banli design rules generated with the local Codex `hue` skill. The Codex skill lives at `/Users/zhangjianhua/.codex/skills/banli-design`.

## Core Direction

Banli is a disciplined dark fashion storefront: graphite indigo canvas, clean product photography, controlled borders, and restrained jewel accents. Product imagery and typography must carry the experience; chrome only helps users compare, filter, and buy.

## Non-Negotiable Rules

1. Page-level scrolling belongs to `html`. Do not create nested desktop scroll containers in `body`, `#wrapper`, product wrappers, category sidebars, or footer sections.
2. Product detail pages must keep breadcrumbs on normal pages. Quick view may hide breadcrumbs only when space is constrained.
3. Product detail media must show vertical thumbnails on desktop when multiple images exist.
4. Quick view uses one backdrop, one modal border, and one scroll area at most.
5. Category sidebars use one outer panel. Category rows and filter rows are flat, not nested rounded boxes.
6. Accordion arrows rotate inside a fixed square button. The icon must never move outside the button frame.
7. Category and brand banners stay compact. Desktop target is 180 to 240px, max 280px.
8. Product cards use one 1px border and a clean image mat. No heavy glow, no oversized CTA slab.
9. Footer rows share the same container width. Social icons are 30 to 34px on desktop.
10. Navigation badges must not disrupt menu baseline alignment and parent menu items must have one chevron only.

## Tokens

| Token | Dark Value | Role |
|-------|------------|------|
| `--background` | `#080B1F` | Page canvas |
| `--surface1` | `#101435` | Primary section surface |
| `--surface2` | `#202740` | Cards and panels |
| `--surface3` | `#343C55` | Inputs and selected rows |
| `--border` | `#202740` | Subtle separators |
| `--border-visible` | `#515A70` | Intentional borders |
| `--text1` | `#F8F9FC` | Primary text |
| `--text2` | `#C1C9DA` | Secondary text |
| `--text3` | `#98A2B7` | Muted text |
| `--text4` | `#707A91` | Disabled text |
| `--accent` | `#6F95D8` | Primary interactive |
| `--accent-subtle` | `#121E3C` | Selected backgrounds |

## Typography

Use Manrope for display and body. Use IBM Plex Mono only for SKU or technical identifiers, not for prices.

| Token | Size | Weight | Use |
|-------|------|--------|-----|
| `--display` | 36px | 500 | Product detail title desktop |
| `--heading` | 28px | 600 | Category title, module title |
| `--subheading` | 20px | 600 | Card group title |
| `--body` | 15px | 500 | Paragraphs, form text |
| `--body-sm` | 14px | 500 | Card title, nav item |
| `--caption` | 12px | 600 | Metadata, SKU, stock |
| `--label` | 11px | 700 | Uppercase labels and tabs |

## Component Rules

### Product Cards

- Card radius is 8px.
- Border is 1px.
- Hover may only increase border contrast and scale image to `1.02`.
- Grid titles clamp to 2 lines.
- Prices should stay on one row whenever card width allows it.

### Product Detail

- Desktop uses media and buying panel side by side.
- Media column uses vertical thumbnails plus one main image.
- Buying panel is information-first: brand, title, price, metadata, options, quantity, CTA row, wishlist.
- CTA height is 44px.

### Quick View

- Backdrop opacity target is 42 to 58 percent.
- Modal must not introduce page plus modal double scrollbars.
- If internal scroll is unavoidable, scroll only the modal body.
- Main media should include thumbnails on desktop.

### Category Sidebar

- One outer panel.
- Flat rows.
- Clear child rail and indentation.
- No per-option rounded cards.
- No internal desktop scrollbar.

### Footer

- One container width.
- One consistent separator system.
- Social icons 30 to 34px desktop.
- No large social icon tiles.

## Anti-Patterns

- No double scrollbars.
- No nested rounded cards.
- No neon glow around hover states.
- No product image overlay darker than 24 percent.
- No card border thicker than 1px.
- No card radius above 12px.
- No CTA above 48px height in product cards or quick view.
- No mismatched footer separator widths.
- No unrelated gradient bands that do not align with the page container.
