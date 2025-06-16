<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MechanicResource\Pages;
use App\Models\Mechanic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class MechanicResource extends Resource
{
    protected static ?string $model = Mechanic::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = 'Garagisten';

    protected static ?string $modelLabel = 'Garagist';

    protected static ?string $pluralModelLabel = 'Garagisten';

    protected static ?string $navigationGroup = 'Gebruikersbeheer';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Naam'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('E-mail'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255)
                    ->label('Wachtwoord'),
                Forms\Components\TextInput::make('company_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Bedrijfsnaam'),
                Forms\Components\TextInput::make('vat')
                    ->required()
                    ->maxLength(255)
                    ->label('BTW nummer')
                    ->placeholder('BE0123456789'),
                Forms\Components\TextInput::make('telephone')
                    ->required()
                    ->tel()
                    ->maxLength(255)
                    ->label('Telefoonnummer')
                    ->placeholder('+32 123 45 67 89'),
                Forms\Components\TextInput::make('adress')
                    ->required()
                    ->maxLength(255)
                    ->label('Adres'),
                Forms\Components\TextInput::make('postal_code')
                    ->required()
                    ->maxLength(255)
                    ->label('Postcode'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Naam'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('E-mail'),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable()
                    ->sortable()
                    ->label('Bedrijfsnaam'),
                Tables\Columns\TextColumn::make('vat')
                    ->searchable()
                    ->sortable()
                    ->label('BTW nummer'),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable()
                    ->sortable()
                    ->label('Telefoonnummer'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Aangemaakt op'),
            ])
            ->filters([
                Tables\Filters\Filter::make('company_name')
                    ->form([
                        Forms\Components\TextInput::make('company_name')
                            ->label('Bedrijfsnaam')
                            ->placeholder('Zoek op bedrijfsnaam'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['company_name'],
                                fn ($query, $companyName) => $query->where('company_name', 'like', "%{$companyName}%")
                            );
                    })
                    ->label('Filter op bedrijfsnaam'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Vanaf'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Tot'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn ($query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'],
                                fn ($query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
                    })
                    ->label('Aangemaakt tussen'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMechanics::route('/'),
            'create' => Pages\CreateMechanic::route('/create'),
            'edit' => Pages\EditMechanic::route('/{record}/edit'),
        ];
    }
} 