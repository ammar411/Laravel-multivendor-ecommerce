<?php

namespace App\Filament\Widgets;
use App\Models\Order;
use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action; 
class LatestOrders extends BaseWidget


{
    protected  int| string| array $columnSpan ='full';
    protected static ?int $sort=2;
public function table(Table $table): Table

{
    return $table
        ->query(
            (new OrderResource())->getEloquentQuery()
        )
        ->defaultPaginationPageOption(5)
        ->defaultSort('created_at', 'desc')
        ->columns([
          
             TextColumn::make('id')->label('Order id')->searchable(),
    
             TextColumn::make('user.name')->searchable(),

                 TextColumn::make('grand_total')->money('PKR'), 

                TextColumn::make('status')->badge()->color(fn(string $state):string=>match($state){
                    'new'=> 'info',
                    'processing'=>'success', 'delivered'=> 'success', 'cancelled'=>'danger'
                })
                ->icons([
'new' => 'heroicon-m-sparkles',
    'processing' => 'heroicon-m-arrow-path', 
    'shipped' => 'heroicon-m-truck',  // Fixed: was 'tuck', now 'truck'
    'delivered' => 'heroicon-m-check-badge',
    'cancelled' => 'heroicon-m-x-circle'
                    ])->sortable(),

                    TextColumn::make('payment_method')->sortable()->searchable() ,

                     TextColumn::make('payment_status')->sortable()
                     ->badge()
                     ->searchable() ,

                       TextColumn::make('created_at')->label('Ordered At')->dateTime()
        ])
    -> actions([
              Action::make('View Order')
    ->url(fn(Order $record):string=>OrderResource::getUrl('view',['record'=>$record]))
    ->color('info')
    ->icon('heroicon-o-eye'),
    ]);
}
}
