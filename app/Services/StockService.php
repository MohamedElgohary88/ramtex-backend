<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class StockService
{
    /**
     * Adjust stock for a product strictly within a transaction.
     *
     * @param Product $product
     * @param int $quantity (Always positive, type determines sign)
     * @param string $type ('in', 'out', 'adjustment')
     * @param User|null $user
     * @param string|null $notes
     * @param mixed|null $reference (Model instance for morph relation)
     * @return StockMovement
     * @throws \Exception
     */
    public function adjustStock(
        Product $product,
        int $quantity,
        string $type,
        ?User $user = null,
        ?string $notes = null,
        $reference = null
    ): StockMovement {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Stock quantity must be positive.");
        }

        if (!in_array($type, ['in', 'out', 'adjustment'])) {
            throw new InvalidArgumentException("Invalid stock movement type.");
        }

        return DB::transaction(function () use ($product, $quantity, $type, $user, $notes, $reference) {
            // Lock the product row for update to prevent race conditions
            $product = Product::lockForUpdate()->find($product->id);

            $currentStock = $product->stock_on_hand;
            $newStock = $currentStock;

            if ($type === 'out') {
                if ($currentStock < $quantity) {
                    throw new \Exception("Insufficient stock for Product: {$product->name} (Current: {$currentStock}, Requested: {$quantity})");
                }
                $newStock -= $quantity;
            } elseif ($type === 'in') {
                $newStock += $quantity;
            } elseif ($type === 'adjustment') {
                // Adjustment logic: If quantity is positive, add. If intended to be absolute set, logic differs.
                // Here we assume 'adjustment' is a delta. If you want absolute set, different logic is needed.
                // For simplicity in this service method, we treat it as an addition/subtraction delta or just a record.
                // Let's assume adjustment can be positive or negative, but the param is positive.
                // To be safe, let's treat 'adjustment' as 'in' effectively in this simple method,
                // or require a dedicated method for 'setExactStock'.
                // For now, let's assume this method is for deltas.
                // Re-enforcing: This method takes absolute quantity.
                // Let's implementation: Direct update or Delta?
                // Standard practice: 'adjustment' usually implies a correction.
                // Let's treat it as a +quantity for now. If user wants to reduce, they should use 'out' or negative adjustment logic which we prohibited.
                // Revised: We will allow signed int for 'kadjustment' if we change param type, but we forced positive int.
                // So, 'adjustment' adds stock. If you need to remove stock via adjustment, handled elsewhere or use 'out' with notes.
                 $newStock += $quantity;
            }

            // Create Movement Record
            $movement = StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $user?->id,
                'type' => $type,
                'quantity' => $quantity,
                'notes' => $notes,
                'reference_id' => $reference?->id,
                'reference_type' => $reference ? get_class($reference) : null,
            ]);

            // Update Product Stock
            $product->update(['stock_on_hand' => $newStock]);

            return $movement;
        });
    }
}
