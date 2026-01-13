<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // نستخدم Group عشان نضمن إنه ياخد المساحة كاملة
                Forms\Components\Group::make()
                    ->schema([
                        
                        // Basic Information
                        Forms\Components\Section::make('Basic Information')
                            ->description('Client name, company, and role details')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Forms\Components\TextInput::make('full_name')
                                    ->label('Full Name')
                                    ->required()
                                    ->columnSpan(1), // ياخد عمود واحد
                                
                                Forms\Components\TextInput::make('company_name')
                                    ->label('Company')
                                    ->columnSpan(1),
                                
                                Forms\Components\TextInput::make('job_title')
                                    ->label('Job Title')
                                    ->columnSpan(1),
                                    
                                Forms\Components\Select::make('gender')
                                    ->options(['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.'])
                                    ->columnSpan(1),
                            ])
                            ->columns(2) // للكروت الصغيرة (موبايل)
                            ->columns(['md' => 4]) // للشاشات الكبيرة (4 أعمدة جنب بعض)
                            ->columnSpanFull(),

                        // Contact Information
                        Forms\Components\Section::make('Contact Information')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->columnSpan(1),
                                    
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->required()
                                    ->columnSpan(1),
                                    
                                Forms\Components\TextInput::make('other_phone')
                                    ->tel()
                                    ->columnSpan(1),
                                    
                                Forms\Components\TextInput::make('fax')
                                    ->tel()
                                    ->columnSpan(1),
                            ])
                            ->columns(2)
                            ->columns(['md' => 4])
                            ->columnSpanFull(),

                        // Address (Full Width)
                        Forms\Components\Section::make('Address & Location')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Forms\Components\Textarea::make('address')
                                    ->rows(3)
                                    ->columnSpanFull(), // العنوان ياخد العرض كله
                                
                                Forms\Components\TextInput::make('city')->columnSpan(1),
                                Forms\Components\TextInput::make('district')->columnSpan(1),
                                Forms\Components\TextInput::make('country')->default('Lebanon')->columnSpan(1),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull() // ده أهم سطر: بيخلي الجروب ده يفرش في الصفحة كلها
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('other_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('financial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_details')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pobox')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FinancialTransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
