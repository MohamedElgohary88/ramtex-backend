# Legacy Database Audit (Ramtex v1)
**Date:** 2026-01-11
**Auditor:** Tech Lead (AI)

## 🚨 Critical Architecture Violations Detected

### 1. Data Integrity Risks (URGENT)
*   **Monetary Fields as VARCHAR:**
    *   `tbm_invoice`: `totalprice`, `totalnet`, `currencyvalue` are `VARCHAR(1000)`.
    *   `tbm_products`: `default_price` is `VARCHAR(1000)`.
    *   **Risk:** Floating point math errors, string sorting issues, inability to perform DB-level sums.
    *   **Fix:** MIGRATION TO `DECIMAL(15, 2)` IS MANDATORY.

*   **Date Formats:**
    *   Column `datedate` is used inconsistently.
    *   Some dates might be storing strings in other tables? Need to standardise on `created_at`, `updated_at`, and specific date columns (e.g., `invoice_date`).

### 2. Schema Structure
*   **Foreign Keys:**
    *   Explicit `_id` columns exist (`client_id`, `sales_id`), but no physical Foreign Key constraints found in the dump (MyISAM engine legacy?).
    *   **Fix:** Laravel Foreign Keys with `constrained()` and `onDelete('restrict')` or `cascade`.

*   **Normalization:**
    *   `tbm_client` contains flat address fields (`city`, `district`, `address`).
    *   **Decision:** For now, keep `address` simple on the model unless multi-address shipping is required.

### 3. Identity & Access
*   **User/Sales Split:**
    *   `users` table exists (Admins?).
    *   `tbm_sales` table exists (Sales Reps?).
    *   **Strategy:** Merge into single `User` model with Roles (Spatie Permission or Filament Shield).
    *   **Passwords:** Legacy uses MD5 (`21232f297a57a5a743894a0e4a801fc3`). We cannot decrypt these. Users will need to reset passwords or we implement a temporary legacy hash check.

## Refactoring Priority: The "Big 5"

1.  **Users & Authentication** (`users` + `tbm_sales`)
    *   **Why:** Foundation of security. Needed for `created_by` auditing on all other records.
    *   **New Model:** `User`

2.  **Product Catalog** (`tbm_products` + `tbm_category`)
    *   **Why:** You can't invoice what you don't define.
    *   **Fix:** Strict types, clean up `itemcode` uniqueness.
    *   **New Models:** `Product`, `Category`.

3.  **Client Registry** (`tbm_client`)
    *   **Why:** The counter-party to every transaction.
    *   **New Model:** `Client` (Relationships: `BelongsTo` Country, etc).

4.  **Inventory Ledger** (`tbm_stocks`)
    *   **Why:** "Data Integrity is Sacred". We need a transactional stock ledger properly implemented.
    *   **New Model:** `StockMovement` (Polymorphic? Or tied to Invoice/Return).

5.  **Invoicing Engine** (`tbm_invoice` + `tbm_invoice_det`)
    *   **Why:** The revenue generator.
    *   **New Models:** `Invoice`, `InvoiceItem`.
