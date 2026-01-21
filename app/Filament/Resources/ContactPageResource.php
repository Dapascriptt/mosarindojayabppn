<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactPageResource\Pages;
use App\Models\ContactPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactPageResource extends Resource
{
    protected static ?string $model = ContactPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Judul Hero')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('hero_desc')
                            ->label('Deskripsi Hero')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('hero_bg')
                            ->label('Background Hero')
                            ->image()
                            ->disk('public')
                            ->directory('contact')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Form Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('form_title')
                            ->label('Judul Form')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('form_desc')
                            ->label('Deskripsi Form')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Info Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('info_title')
                            ->label('Judul Info')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('company_name')
                            ->label('Nama Perusahaan')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('whatsapp')
                            ->label('WhatsApp'),
                        Forms\Components\TextInput::make('email')
                            ->label('Email'),
                        Forms\Components\TextInput::make('cta_whatsapp_label')
                            ->label('Label Tombol WhatsApp'),
                        Forms\Components\TextInput::make('cta_email_label')
                            ->label('Label Tombol Email'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Maps')
                    ->schema([
                        Forms\Components\Textarea::make('maps_embed_url')
                            ->label('Embed Maps (URL atau iframe)')
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
                    ->label('Hero')
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
            'index' => Pages\ListContactPages::route('/'),
            'create' => Pages\CreateContactPage::route('/create'),
            'edit' => Pages\EditContactPage::route('/{record}/edit'),
        ];
    }
}
