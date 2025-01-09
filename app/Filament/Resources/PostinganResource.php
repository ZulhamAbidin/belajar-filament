<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\kategori;
use Filament\Forms\Form;
use App\Models\Postingan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use App\Filament\Resources\PostinganResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostinganResource extends Resource
{
    protected static ?string $model = Postingan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Daftar Postingan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat Postingan')->description('deskripsi')->collapsible()->schema([
                    TextInput::make('judul')
                        ->label('Judul Postingan')
                        ->columnSpanFull()
                        ->required(),

                        // validasi = min dan max ->minLength(5) ->maxLength(2) ->rules('min:3|max:5') isian tertentu ->rules(['in:hai,alo,hola']) ->in(['hai', 'hi', 'ho']) 

                    // TextInput::make('slug')
                    //     ->label('Slug')
                    //     ->columnSpanFull()
                    //     // ->unique()
                    //     ->unique(ignoreRecord:true)
                    //     ->validationMessages([
                    //         'unique' => 'Slug Telah Terdaftar.',
                    //     ])
                    //     ->required(),
        
                    Select::make('kategori_id')
                        ->label('Kategori')
                        // ->searchable()
                        ->options(kategori::all()->pluck('nama', 'id')
                    ),

                    // Select::make('kategori_id')
                    //     ->label('Kategori')
                    //     ->relationship('Kategori', 'nama'),
                    
                    RichEditor::make('konten')
                        ->label('Isi Konten')
                        ->toolbarButtons(['attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'underline', 'undo'])
                        ->columnSpanFull()
                        ->required(),
                    
                    Checkbox::make('published')
                        ->columnSpan(1)
                        ->required(),
                         
                    FileUpload::make('sampul')->disk('public')->directory('sampul')->required(),
                ]),

                // FileUpload::make('sampul')->disk('public')->directory('sampul'),
                
            ])->columns([
                'default' =>1,
                'md' =>2,
                'lg' =>3,
                'xl' =>4,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:false)
                    ,
                    
                TextColumn::make('slug')
                    ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('kategori.nama')
                    ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:false),

                ImageColumn::make('sampul')
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->searchable()
                    ->sortable()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault:false),

                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->copyable()
                    ->copyMessage('Berhasil Menyalin')
                    ->searchable()
                    ->sortable()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault:false),
                
                CheckboxColumn::make('published')
                    ->label('Publish')
                    ->toggleable(isToggledHiddenByDefault:false),

            ])
            ->filters([Tables\Filters\TrashedFilter::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ])]);
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
            'index' => Pages\ListPostingans::route('/'),
            'create' => Pages\CreatePostingan::route('/create'),
            'edit' => Pages\EditPostingan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}