<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $modelLabel = 'Staff Member';

    protected static ?string $pluralModelLabel = 'Staff';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Account Access')
                    ->description('Core credentials and permissions for the admin portal.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpan(1),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? Hash::make($state) : null)
                            ->rule(Password::default())
                            ->columnSpan(1),
                        Select::make('roles')
                            ->label('Roles & Permissions')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpanFull()
                            ->helperText('Assign shields/roles using Spatie Permissions.'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Forms\Components\Section::make('Employment Details')
                    ->description('Sales rep, HR, and operational data stored in the profile record.')
                    ->relationship('profile')
                    ->schema([
                        TextInput::make('employee_code')
                            ->label('Employee ID')
                            ->required()
                            ->maxLength(50)
                            ->columnSpan(1),
                        TextInput::make('job_title')
                            ->label('Job Title')
                            ->maxLength(120)
                            ->columnSpan(1),
                        TextInput::make('department')
                            ->label('Department')
                            ->maxLength(120)
                            ->columnSpan(1),
                        Select::make('employment_type')
                            ->label('Employment Type')
                            ->options([
                                'full-time' => 'Full-time',
                                'part-time' => 'Part-time',
                                'contract' => 'Contract',
                                'consultant' => 'Consultant',
                            ])
                            ->default('full-time')
                            ->columnSpan(1),
                        TextInput::make('reporting_manager')
                            ->label('Reporting Manager')
                            ->maxLength(120)
                            ->columnSpan(1),
                        TextInput::make('work_location')
                            ->label('Work Location')
                            ->maxLength(120)
                            ->columnSpan(1),
                        DatePicker::make('date_of_hire')
                            ->label('Date of Hire')
                            ->native(false)
                            ->columnSpan(1),
                        TextInput::make('salary')
                            ->label('Base Salary')
                            ->numeric()
                            ->default(0)
                            ->prefix('$')
                            ->step(0.01)
                            ->columnSpan(1),
                        TextInput::make('commission_rate')
                            ->label('Commission %')
                            ->numeric()
                            ->default(0)
                            ->suffix('%')
                            ->step(0.01)
                            ->columnSpan(1),
                        TextInput::make('phone')
                            ->label('Primary Phone')
                            ->tel()
                            ->maxLength(30)
                            ->columnSpan(1),
                        TextInput::make('emergency_contact_name')
                            ->label('Emergency Contact Name')
                            ->maxLength(120)
                            ->columnSpan(1),
                        TextInput::make('emergency_contact_phone')
                            ->label('Emergency Contact Phone')
                            ->tel()
                            ->maxLength(30)
                            ->columnSpan(1),
                        Textarea::make('notes')
                            ->label('HR Notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('profile.employee_code')
                    ->label('Employee ID')
                    ->badge()
                    ->sortable(),
                TextColumn::make('profile.job_title')
                    ->label('Job Title')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('profile.department')
                    ->label('Department')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('profile.date_of_hire')
                    ->label('Hired')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('profile.salary')
                    ->label('Salary')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->label('Department')
                    ->relationship('profile', 'department')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['profile', 'roles']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'profile.employee_code'];
    }
}
