<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomePageResource\Pages;
use App\Models\HomePage;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;

class HomePageResource extends Resource
{
    protected static ?string $model = HomePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Beranda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konten Beranda')
                    ->schema([
                        Forms\Components\FileUpload::make('hero_media')
                            ->label('Media Hero (Gambar/Video)')
                            ->multiple()
                            ->disk('public')
                            ->directory('home/hero')
                            ->acceptedFileTypes(['image/*', 'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('card_image')
                            ->label('Gambar Card')
                            ->image()
                            ->disk('public')
                            ->directory('home')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('about_excerpt')
                            ->label('Penjelasan Singkat')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('vision_text')
                            ->label('Teks Visi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('mission_points')
                            ->label('Poin Misi')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Poin')
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('partner_logos')
                            ->label('Logo Mitra')
                            ->image()
                            ->multiple()
                            ->disk('public')
                            ->directory('partners')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('about_excerpt')
                    ->label('Ringkas')
                    ->limit(60),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomePages::route('/'),
            'create' => Pages\CreateHomePage::route('/create'),
            'edit' => Pages\EditHomePage::route('/{record}/edit'),
        ];
    }
}
