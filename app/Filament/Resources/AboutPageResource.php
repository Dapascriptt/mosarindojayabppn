<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutPageResource\Pages;
use App\Models\AboutPage;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;

class AboutPageResource extends Resource
{
    protected static ?string $model = AboutPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Profil';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Judul')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('hero_subtitle')
                            ->label('Subjudul')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('hero_desc')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('video_url')
                            ->label('Video Hero')
                            ->disk('public')
                            ->directory('about')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Foto Lokasi')
                    ->schema([
                        Forms\Components\FileUpload::make('location_photos')
                            ->label('Foto Lokasi')
                            ->image()
                            ->multiple()
                            ->disk('public')
                            ->directory('about/locations')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Highlight')
                    ->schema([
                        Forms\Components\Repeater::make('highlights')
                            ->label('Highlight')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Teks')
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Legalitas')
                    ->schema([
                        Forms\Components\Repeater::make('legal_items')
                            ->label('Daftar Legalitas')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                Forms\Components\TextInput::make('value')
                                    ->label('Nilai')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('SBU')
                    ->schema([
                        Forms\Components\Repeater::make('sbu_items')
                            ->label('Daftar SBU')
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Kode')
                                    ->required(),
                                Forms\Components\TextInput::make('desc')
                                    ->label('Deskripsi')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Tim')
                    ->schema([
                        Forms\Components\Repeater::make('team_groups')
                            ->label('Kelompok Tim')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->required(),
                                Forms\Components\Repeater::make('members')
                                    ->label('Anggota')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama')
                                            ->required(),
                                    ])
                                    ->defaultItems(0)
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Sertifikasi')
                    ->schema([
                        Forms\Components\Textarea::make('certifications_text')
                            ->label('Keterangan Sertifikasi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->label('Judul')
                    ->limit(50),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutPages::route('/'),
            'create' => Pages\CreateAboutPage::route('/create'),
            'edit' => Pages\EditAboutPage::route('/{record}/edit'),
        ];
    }
}
