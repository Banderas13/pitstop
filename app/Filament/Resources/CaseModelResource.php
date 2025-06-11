<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseModelResource\Pages;
use App\Filament\Resources\CaseModelResource\RelationManagers;
use App\Models\CaseModel;
use App\Filament\Widgets\CasesChart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use App\Mail\CaseBill;
use Filament\Notifications\Notification;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

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
                ->maxLength(255)
                ->label('Case Description'),

            Forms\Components\DatePicker::make('created_at')
                ->label('Case Date')
                ->default(now())
                ->required()
                ->displayFormat('d/m/Y')
                ->native(false)
                ->dehydrateStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('Y-m-d') : null),

            Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required()
                ->preload()
                ->live()
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                    TextInput::make('bday')
                        ->type('date')
                        ->required(),
                    TextInput::make('vat'),
                ]),

            Select::make('car_id')
                ->relationship('car', 'numberplate', function ($query, $get) {
                    return $query->where('user_id', $get('user_id'));
                })
                ->searchable()
                ->required()
                ->preload()
                ->createOptionForm([
                    Select::make('type_id')
                        ->relationship('type', 'name')
                        ->searchable()
                        ->required()
                        ->createOptionForm([
                            Select::make('brand_id')
                                ->relationship('brand', 'name')
                                ->searchable()
                                ->required()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ]),
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                        ]),
                    TextInput::make('year')
                        ->required()
                        ->numeric()
                        ->minValue(1900)
                        ->maxValue(date('Y') + 1),
                    TextInput::make('chasis_number')
                        ->required()
                        ->maxLength(17),
                    TextInput::make('numberplate')
                        ->required()
                        ->maxLength(20),
                    Select::make('fuel')
                        ->options([
                            'diesel' => 'Diesel',
                            'gasoline' => 'Gasoline',
                            'hybrid/diesel' => 'Hybrid/Diesel',
                            'hybrid/gasoline' => 'Hybrid/Gasoline',
                            'lpg' => 'LPG',
                            'electric' => 'Electric',
                            'hydrogen' => 'Hydrogen',
                        ])
                        ->required(),
                ]),

            Select::make('mechanic_id')
                ->relationship('mechanic', 'name')
                ->searchable()
                ->required()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    TextInput::make('company_name')->required(),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('vat')->required(),
                    TextInput::make('adress'),
                    TextInput::make('telephone'),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                ]),

            Select::make('offer_id')
                ->relationship('offer', 'price')
                ->label('Offer Price')
                ->createOptionForm([
                    Forms\Components\TextInput::make('price')
                        ->label('Price (€)')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->step(0.01)
                        ->prefix('€'),
                ])
                ->createOptionUsing(function (array $data) {
                    return Offer::create([
                        'price' => $data['price'],
                    ])->id;
                }),

            Select::make('approval')
                ->options([
                    0 => 'Pending',
                    1 => 'Approved',
                    2 => 'Rejected'
                ])
                ->default(0)
                ->required(),

            Forms\Components\FileUpload::make('media')
                ->multiple()
                ->directory('case-media')
                ->label('Case Media'),
        ]); 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car.type.brand.name')
                    ->searchable()
                    ->sortable()
                    ->label('Car Brand'),
                
                Tables\Columns\TextColumn::make('car.type.name')
                    ->searchable()
                    ->sortable()
                    ->label('Car Model'),
                
                Tables\Columns\TextColumn::make('car.numberplate')
                    ->searchable()
                    ->sortable()
                    ->label('License Plate'),
                
                Tables\Columns\TextColumn::make('mechanic.name')
                    ->searchable()
                    ->sortable()
                    ->label('Assigned Mechanic'),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Customer'),
                
                Tables\Columns\TextColumn::make('approval')
                    ->badge()
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        0 => 'Pending',
                        1 => 'Approved',
                        2 => 'Rejected',
                    })
                    ->color(fn (int $state): string => match ($state) {
                        0 => 'gray',
                        1 => 'success',
                        2 => 'danger',
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('offer.price')
                    ->money('EUR')
                    ->sortable()
                    ->label('Offer Price'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d/m/Y')
                    ->sortable()
                    ->label('Case Date'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('approval')
                    ->options([
                        0 => 'Pending',
                        1 => 'Approved',
                        2 => 'Rejected'
                    ]),
                Tables\Filters\SelectFilter::make('car.fuel')
                    ->label('Fuel')
                    ->options([
                        'diesel' => 'Diesel',
                        'gasoline' => 'Gasoline',
                        'hybrid/diesel' => 'Hybrid/Diesel',
                        'hybrid/gasoline' => 'Hybrid/Gasoline',
                        'lpg' => 'LPG',
                        'electric' => 'Electric',
                        'hydrogen' => 'Hydrogen',
                    ]),
                Tables\Filters\SelectFilter::make('mechanic_id')
                    ->relationship('mechanic', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Mechanic'),
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Customer'),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Cases from'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Cases until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Case Date'),
            ])
            ->actions([
                Action::make('sendBill')
                    ->label('Send Bill')
                    ->icon('heroicon-o-envelope')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (CaseModel $record) {
                        if (!$record->offer) {
                            Notification::make()
                                ->title('No offer found for this case')
                                ->danger()
                                ->send();
                            return;
                        }

                        Mail::to($record->user->email)->send(new CaseBill($record));

                        Notification::make()
                            ->title('Bill sent successfully')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (CaseModel $record) => $record->approval === 1),
                    Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('sendBills')
                        ->label('Send Bills')
                        ->icon('heroicon-o-envelope')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $successCount = 0;
                            $errorCount = 0;

                            foreach ($records as $record) {
                                try {
                                    if ($record->approval === 1 && $record->offer) {
                                        Log::info('Attempting to send bill', [
                                            'case_id' => $record->id,
                                            'customer_email' => $record->user->email,
                                            'price' => $record->offer->price
                                        ]);

                                        Mail::to($record->user->email)->send(new CaseBill($record));
                                        
                                        Log::info('Bill sent successfully', [
                                            'case_id' => $record->id,
                                            'customer_email' => $record->user->email
                                        ]);
                                        
                                        $successCount++;
                                    } else {
                                        Log::warning('Cannot send bill - case not approved or no offer', [
                                            'case_id' => $record->id,
                                            'approval' => $record->approval,
                                            'has_offer' => (bool)$record->offer
                                        ]);
                                        $errorCount++;
                                    }
                                } catch (\Exception $e) {
                                    Log::error('Failed to send bill', [
                                        'case_id' => $record->id,
                                        'error' => $e->getMessage()
                                    ]);
                                    $errorCount++;
                                }
                            }

                            if ($successCount > 0) {
                                Notification::make()
                                    ->title("Successfully sent {$successCount} bills")
                                    ->success()
                                    ->send();
                            }

                            if ($errorCount > 0) {
                                Notification::make()
                                    ->title("Could not send {$errorCount} bills (not approved or no offer)")
                                    ->warning()
                                    ->send();
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
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

    public static function getWidgets(): array
    {
        return [
            CasesChart::class,
        ];
    }
}
