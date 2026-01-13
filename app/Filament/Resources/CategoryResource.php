<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Basic Details Section
                Forms\Components\Section::make('Category Details')
                    ->description('Category name, slug, and basic information')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Category Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Electronics, Clothing, Food, etc.')
                            ->helperText('The display name for this category')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                            )
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('electronics-accessories')
                                    ->helperText('URL-friendly identifier (auto-generated from name)')
                                    ->disabled(fn ($operation) => $operation === 'create')
                                    ->dehydrated()
                                    ->suffixIcon('heroicon-o-link')
                                    ->columnSpan(2),
                                
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Status')
                                    ->helperText('Active categories appear in listings')
                                    ->inline(false)
                                    ->required()
                                    ->default(true)
                                    ->columnSpan(1),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(['md' => 1])
                    ->columnSpanFull(),

                // Additional Information Section
                Forms\Components\Section::make('Additional Information')
                    ->description('Optional description and media')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Brief description of what products belong to this category...')
                            ->helperText('Optional: Describe what items are included in this category')
                            ->rows(3)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Category Image')
                            ->image()
                            ->directory('categories')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Optional: Upload a representative image for this category')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
