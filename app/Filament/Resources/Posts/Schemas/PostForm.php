<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;

use Tiptap\Core\Mark;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
        //section 1 - post details
Section::make("Post Details")
    ->description("Fill in the details of the post")
    // -> icon(Heroicon::RocketLaunch)
    // -> icon('heroicon-o-document-text')
    ->schema([
        Group::make([

            // KIRI (2/3)
            Group::make([
                Section::make('Post Details')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')->required(),
                            TextInput::make('slug')->required(),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required(),
                            ColorPicker::make('color'),
                        ])->columns(2),

                        MarkdownEditor::make('body')
                            ->columnSpanFull(),
                    ]),
            ])->columnSpan(2),

            // KANAN (1/3)
            Group::make([
                Section::make('Image Upload')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('posts'),
                    ]),

                Section::make('Meta Data')
                    ->icon('heroicon-o-cog')
                    ->schema([
                        TagsInput::make('tags'),
                        Checkbox::make('published'),
                        DateTimePicker::make('published_at'),
                    ]),
            ])->columnSpan(1),

        ])->columns(3),
    ]),
        ]);

    }
}