<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseModelResource\Pages;
use App\Filament\Resources\CaseModelResource\RelationManagers;
use App\Models\CaseModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
class CaseModelResource extends Resource
{
    protected static ?string $model = CaseModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Cases Management';

    protected static ?string $label = 'Case Management';



    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('description')
                ->required()
                ->maxLength(255),

            Hidden::make('user_id')
                ->default(auth()->id())
                ->required(),

            Select::make('mechanic_id')
            ->relationship('mechanic', 'name')
            ->searchable()
            ->required()
            ->createOptionForm([
                TextInput::make('name')->required(),
                TextInput::make('company_name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('vat'),
                TextInput::make('adress'),
                TextInput::make('telephone'),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
            ]),

            Select::make('user_id')
            ->relationship('user', 'name')
            ->searchable()
            ->required()
            ->createOptionForm([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
            ]),

        ]); 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCaseModels::route('/'),
            'create' => Pages\CreateCaseModel::route('/create'),
            'edit' => Pages\EditCaseModel::route('/{record}/edit'),
        ];
    }
}
