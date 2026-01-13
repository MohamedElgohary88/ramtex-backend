<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    
    protected static ?string $navigationGroup = 'Inventory';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Product Information')
                    ->tabs([
                        // Details Tab
                        Forms\Components\Tabs\Tab::make('Details')
                            ->icon('heroicon-o-cube')
                            ->schema([
                                Forms\Components\Section::make('Basic Information')
                                    ->description('Product name, SKU, category, and status')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Product Name')
                                            ->required()
                                            ->placeholder('Product title')
                                            ->helperText('The main display name for this product')
                                            ->maxLength(255)
                                            ->columnSpan(['md' => 2]),
                                        
                                        Forms\Components\TextInput::make('item_code')
                                            ->label('SKU / Item Code')
                                            ->required()
                                            ->placeholder('PROD-001')
                                            ->helperText('Unique product identifier for inventory tracking')
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->suffixIcon('heroicon-o-qr-code')
                                            ->columnSpan(['md' => 1]),
                                        
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Inactive products won\'t appear in sales')
                                            ->inline(false)
                                            ->required()
                                            ->default(true)
                                            ->columnSpan(['md' => 1]),
                                        
                                        Forms\Components\Select::make('category_id')
                                            ->label('Category')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->helperText('Product category for organization')
                                            ->suffixIcon('heroicon-o-tag')
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                                Forms\Components\TextInput::make('slug')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\Toggle::make('is_active')
                                                    ->default(true),
                                            ])
                                            ->columnSpan(['md' => 2]),
                                    ])
                                    ->columns(['md' => 4])
                                    ->columnSpanFull(),
                                
                                Forms\Components\Section::make('Description')
                                    ->description('Product description and details')
                                    ->schema([
                                        Forms\Components\Textarea::make('description')
                                            ->label('Product Description')
                                            ->placeholder('Detailed product information, features, specifications...')
                                            ->helperText('Describe the product features, benefits, and specifications')
                                            ->rows(5)
                                            ->maxLength(65535)
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                        
                        // Media Tab
                        Forms\Components\Tabs\Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Product Images')
                                    ->description('Upload product photos and images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image_path')
                                            ->label('Product Image')
                                            ->image()
                                            ->directory('products')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                                '4:3',
                                                '16:9',
                                            ])
                                            ->helperText('Upload a high-quality product image (recommended: square format)')
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                        
                        // Pricing & Stock Tab
                        Forms\Components\Tabs\Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\Section::make('Pricing')
                                    ->description('Product pricing information')
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->label('Retail Price')
                                            ->required()
                                            ->numeric()
                                            ->default(0.00)
                                            ->prefix('$')
                                            ->helperText('Regular selling price to customers')
                                            ->minValue(0)
                                            ->step(0.01)
                                            ->columnSpan(['md' => 1]),
                                        
                                        Forms\Components\TextInput::make('wholesale_price')
                                            ->label('Wholesale Price')
                                            ->required()
                                            ->numeric()
                                            ->default(0.00)
                                            ->prefix('$')
                                            ->helperText('Bulk or wholesale price for resellers')
                                            ->minValue(0)
                                            ->step(0.01)
                                            ->columnSpan(['md' => 1]),
                                    ])
                                    ->columns(['md' => 2])
                                    ->columnSpanFull(),
                                
                                Forms\Components\Section::make('Inventory')
                                    ->description('Stock levels and alerts')
                                    ->schema([
                                        Forms\Components\TextInput::make('stock_on_hand')
                                            ->label('Current Stock')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Current quantity in stock (updated automatically by system)')
                                            ->disabled()
                                            ->dehydrated(false)
                                            ->suffixIcon('heroicon-o-cube')
                                            ->columnSpan(['md' => 1]),
                                        
                                        Forms\Components\TextInput::make('min_stock_alert')
                                            ->label('Low Stock Alert Level')
                                            ->required()
                                            ->numeric()
                                            ->default(10)
                                            ->helperText('System alerts when stock falls below this level')
                                            ->minValue(0)
                                            ->suffixIcon('heroicon-o-exclamation-triangle')
                                            ->columnSpan(['md' => 1]),
                                    ])
                                    ->columns(['md' => 2])
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->circular()
                    ->disk('public'),
                Tables\Columns\TextColumn::make('item_code')
                    ->searchable()
                    ->sortable()
                    ->label('Code')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->description(fn (Product $record): string => \Illuminate\Support\Str::limit($record->description ?? '', 30)),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_on_hand')
                    ->numeric()
                    ->sortable()
                    ->label('Stock')
                    ->color(fn (Product $record): string => $record->stock_on_hand <= $record->min_stock_alert ? 'danger' : 'success'),
                Tables\Columns\TextColumn::make('min_stock_alert')
                    ->numeric()
                    ->label('Min Alert')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
