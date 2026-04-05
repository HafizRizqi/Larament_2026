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
use Filament\Forms\Components\DatePicker;
use Tiptap\Core\Mark;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make("title")->required()->required()->minLength(5),
                TextInput::make("slug")->required()->required()->unique(ignoreRecord: true),
                Select::make("category_id")
                    ->relationship("category", "name")
                    ->preload()
                    ->searchable(),
                ColorPicker::make("color"),
                MarkdownEditor::make("content"),
                //RichEditor::make("content"),
                FileUpload::make("image")
                ->disk("public")
                ->directory("posts"),
                TagsInput::make("tags"),
                Checkbox::make("published"),
                DatePicker::make("published_at"),

            ]);
    }
}