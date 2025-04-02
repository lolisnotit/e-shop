<?php

namespace App\Filament\Resources;

use App\Enums\ProductStatusEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\RolesEnum;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                ->schema([
                    TextInput::make('title')->label(__('タイトル'))->live(onBlur:true)->required()->afterStateUpdated(function(string $operation ,$state,callable $set){
                        $set('slug',Str::slug($state));
    
                    }),
                    TextInput::make('slug')->required(),
                    Select::make('department_id')->relationship('department','name')
                    ->label(__('一般カテゴリー'))
                    ->preload()
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function(callable $set){
                        $set('category_id',null);
                    }),
                    Select::make('category_id')->relationship(
                        name:'category',
                        titleAttribute:'name',
                        modifyQueryUsing:function(Builder $query,callable $get){
                            $departmentId = $get('department_id');
                            if ($departmentId){
                                $query->where('department_id',$departmentId);
                            }
                        }
                    )
                    ->label(__('Category'))
                    ->preload()
                    ->label(__('カテゴリー'))
                    ->searchable()
                    ->required(),
                    ]),
                    RichEditor::make('description')
                    ->label(__('説明'))
                    ->required()
                    ->toolbarButtons()
                    ->columnSpan(2),

                    TextInput::make('quantity')
                        ->label(__('個数'))
                        ->integer(),
                    TextInput::make('price')
                        ->label(__('値段'))
                        ->numeric()
                        ->required(),
                    Select::make('status')
                        ->label(__('ステータス'))
                        ->options(ProductStatusEnum::labels())
                        ->default(ProductStatusEnum::Draft->value)
                        ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('タイトル'))->sortable()->words(10)->searchable(),
                TextColumn::make('status')->label(__('ステータス'))->badge()->colors(ProductStatusEnum::colors()),
                TextColumn::make('department.name')->label(__('一般カテゴリ')),
                TextColumn::make('category.name')->label(__('カテゴリ')),
                TextColumn::make('created_at')->label(__('作成日'))->dateTime(),
                
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Filament::auth()->user();
        return $user && $user->hasRole(RolesEnum::Vendor);
    }
}
