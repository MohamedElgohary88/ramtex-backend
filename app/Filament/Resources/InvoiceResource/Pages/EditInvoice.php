<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Services\InvoiceService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('post')
                ->label('Post Invoice')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->isDraft())
                ->requiresConfirmation()
                ->modalHeading('Post Invoice')
                ->modalDescription('This will deduct stock for all items. This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, Post Invoice')
                ->action(function () {
                    try {
                        $service = app(InvoiceService::class);
                        $service->postInvoice($this->record, auth()->user());
                        
                        Notification::make()
                            ->title('Invoice Posted')
                            ->body("Invoice #{$this->record->invoice_number} has been posted successfully.")
                            ->success()
                            ->send();
                        
                        $this->redirect($this->getResource()::getUrl('index'));
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Posting Failed')
                            ->body($e->getMessage())
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),
            Actions\DeleteAction::make()
                ->visible(fn () => $this->record->isDraft()),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Recalculate totals from items
        $totalAmount = 0;
        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $totalAmount += ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
            }
        }
        
        $vatRate = (float) ($data['vat_rate'] ?? 0);
        $vatAmount = $totalAmount * ($vatRate / 100);
        
        $data['total_amount'] = $totalAmount;
        $data['vat_amount'] = $vatAmount;
        $data['grand_total'] = $totalAmount + $vatAmount;
        
        return $data;
    }
}
