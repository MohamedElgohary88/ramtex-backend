# Dashboard Redesign - Visual Guide

## Overview
This document provides visual examples and usage instructions for the redesigned dashboard.

## Form Screenshots

### Client Form
The Client form now has 4 logical sections:

**Section 1: Basic Information**
- Full Name (required) with helper text
- Title/Gender dropdown (Mr., Mrs., Miss, M.)
- Company Name (optional)
- Job Title (optional)

**Section 2: Contact Information**
- Email with envelope icon
- Phone (required) with phone icon
- Alternative Phone (optional)
- Fax (optional)

**Section 3: Address & Location**
- Full street address textarea
- City, District, PO Box, Country fields
- 2-column layout on desktop

**Section 4: Financial & Legal Information**
- Tax ID / MOF Number
- Bank Account Details

> **Note**: All sections are collapsible for easier navigation. Each field has helper text explaining its purpose.

### Category Form
The Category form includes:

**Main Section:**
- Category Name (auto-generates slug)
- URL Slug (disabled on create, editable after)
- Active/Inactive toggle with helper text

**Additional Information Section (collapsible):**
- Description textarea
- Image upload with aspect ratio editor (16:9, 4:3, 1:1)
- Max 2MB file size

### Product Form
The Product form uses tabs for organization:

**Tab 1: Details**
- Product Name (required)
- SKU/Item Code (required, unique)
- Category (searchable dropdown with inline creation)
- Active status toggle
- Description textarea

**Tab 2: Media**
- Product image upload
- Aspect ratio editor (1:1, 4:3, 16:9)
- Image editor built-in

**Tab 3: Pricing & Stock**
- Retail Price with $ prefix
- Wholesale Price with $ prefix
- Current Stock (read-only, system-managed)
- Low Stock Alert Level

## Dashboard Widgets

### Stats Overview Cards
6 cards in a 3-column grid (responsive to 2-column on tablet, 1-column on mobile):

1. **Monthly Revenue**
   - Current month revenue with $ formatting
   - Delta % from last month (green up arrow or red down arrow)
   - 7-day sparkline trend
   - Color: Green (positive) or Red (negative)

2. **Outstanding Receivables**
   - Total unpaid invoice amount
   - Sparkline showing trend
   - Color: Warning (high amount) or Info (low amount)

3. **Active Clients**
   - Total count of registered clients
   - Growth sparkline
   - Color: Info (blue)

4. **Draft Invoices**
   - Count of pending invoices
   - Status indicator ("Needs attention" vs "Under control")
   - Color: Warning (>5 drafts) or Gray (≤5 drafts)

5. **Low Stock Items**
   - Count of products below alert level
   - Trend sparkline
   - Color: Danger (red) if items exist, Success (green) if none

6. **Total Products**
   - Total SKU count
   - Growth sparkline
   - Color: Gray (neutral)

### Revenue Chart (Line Chart)
- 30-day daily revenue trend
- Filled area chart with amber color
- Interactive tooltips with $ formatting
- Subtle gridlines (10% opacity)
- Responsive labels (auto-skip on small screens)

### Invoice Status Chart (Donut Chart)
- Breakdown by status: Posted (green), Draft (amber), Cancelled (red)
- Shows counts in legend labels
- Percentage tooltips on hover
- 65% cutout for modern donut appearance

### Year-over-Year Comparison (Dual-Line Chart)
- Current year: Solid amber line with fill
- Previous year: Dashed gray line
- Monthly data points
- Currency-formatted axis and tooltips
- Legend at bottom

### Invoice Volume Chart (Bar Chart)
- 30-day daily count of invoices created
- Green bars with rounded corners (6px)
- Hover effects with darker green
- Tooltips showing exact counts

## Design System Tokens

### Colors
**Light Mode:**
- Success: #22c55e (green)
- Warning: #f59e0b (amber)
- Danger: #ef4444 (red)
- Info: #2563eb (blue)

**Dark Mode:**
- Surface: #0b1220 (base), #18181b (elevated), #1f2937 (cards)
- Text: #fafafa (primary), #a1a1aa (secondary), #71717a (muted)

### Spacing
Based on 8px grid:
- xs: 8px
- sm: 12px
- md: 16px
- lg: 24px
- xl: 32px
- 2xl: 48px

### Typography
- Page Title: 24px semibold
- Section Header: 16px semibold
- Body Text: 14px regular
- Helper Text: 12px regular
- Labels: 14px medium

### Border Radius
- Small: 6px
- Medium: 8px
- Large: 12px
- Extra Large: 16px
- Full: 9999px (pills/badges)

## Responsive Behavior

### Desktop (≥1024px)
- 3-column grid for stat cards
- 2-column form layouts
- Full-width charts (2-column span for revenue and comparison)
- All tabs and sections visible

### Tablet (768px - 1023px)
- 2-column grid for stat cards
- 2-column form layouts
- 1-column charts
- Tabs remain horizontal

### Mobile (≤767px)
- 1-column grid for stat cards
- 1-column form layouts
- Stacked sections
- Vertical action buttons (Cancel/Save)
- Chart labels auto-skip for readability

## Accessibility Features

### Keyboard Navigation
- Tab order follows visual layout
- All interactive elements are keyboard accessible
- Focus indicators visible (2px amber ring)
- Enter submits forms
- Escape closes modals

### Screen Readers
- All form fields have proper labels (no placeholder-only)
- Helper text associated with fields via aria-describedby
- Required fields marked with asterisk (*) and aria-required
- Image uploads have alt text
- Buttons have descriptive labels

### Color Contrast
- All text meets WCAG AA standards (4.5:1 minimum)
- Icons have sufficient contrast
- Focus indicators are clearly visible
- Error states use both color and icons

## Browser Support
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## Performance
- CSS bundle: 53.81 kB (11.90 kB gzipped)
- No additional JavaScript overhead
- Lazy-loaded images
- Optimized chart rendering
- Minimal layout shift (CLS < 0.1)

## Usage Tips

### Creating Records
1. Navigate to the entity list (Clients, Categories, or Products)
2. Click "Create" button
3. Fill required fields (marked with *)
4. Optional: Expand collapsible sections for additional fields
5. For products: Use tabs to navigate between sections
6. Click "Create" button at bottom (sticky on scroll)

### Editing Records
1. Click edit action on any record in the list
2. Modify fields as needed
3. Click "Save changes" at bottom
4. Delete option available in header actions

### Dashboard
1. Dashboard loads automatically on login
2. Stat cards show current month data
3. Click on any metric to drill down (future feature)
4. Charts update daily with latest data
5. Hover over chart elements for detailed tooltips

## Troubleshooting

### Images not uploading
- Check file size (max 2MB)
- Ensure file type is JPEG, PNG, or WebP
- Verify storage directory permissions

### Form validation errors
- All required fields must be filled
- Email must be valid format
- SKU must be unique
- Check inline error messages below fields

### Responsive layout issues
- Clear browser cache
- Ensure CSS is properly compiled
- Check browser compatibility
- Try hard refresh (Ctrl+Shift+R)

## Migration Guide

### Database Migration
Run the following command to add new category fields:
```bash
php artisan migrate
```

This will add:
- `description` (text, nullable)
- `image_path` (string, nullable)

to the `categories` table.

### Asset Compilation
Build CSS assets:
```bash
npm install
npm run build
```

For development with hot reload:
```bash
npm run dev
```

## Future Enhancements
- Product variants management
- Rich text editor for descriptions
- Advanced image gallery with reordering
- Autosave drafts functionality
- SEO metadata fields
- Export/import capabilities
- Bulk edit operations
- Advanced search and filters
