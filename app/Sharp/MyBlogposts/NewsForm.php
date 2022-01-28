<?php

namespace App\Sharp\MyBlogposts;

use App\Models\Blogpost;
use App\Models\Enums\BlogpostState;
use App\Models\Enums\BlogpostType;
use App\Models\User;
use Code16\Sharp\Form\Eloquent\Uploads\Transformers\SharpUploadModelFormAttributeTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormDateField;
use Code16\Sharp\Form\Fields\SharpFormEditorField;
use Code16\Sharp\Form\Fields\SharpFormListField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayout;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;

class NewsForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    protected ?string $formValidatorClass = NewsValidator::class;

    function buildFormFields(FieldsContainer $formFields) : void
    {
        $formFields
            ->addField(
                SharpFormUploadField::make("cover")
                    ->setLabel("Visuel principal")
                    ->setFileFilterImages()
                    ->setMaxFileSize(1)
                    ->shouldOptimizeImage()
                    ->setStorageDisk("local")
                    ->setCropRatio("16:10")
                    ->setStorageBasePath("data/Blogpost/{id}")
            )
            ->addField(
                SharpFormSelectField::make("tags",
                    Tag::get()->map(function(Tag $tag) {
                        return [
                            "id" => $tag->id,
                            "label" => $tag->name,
                        ];
                    })->all()
                )
                ->setMultiple(true)
                ->setLabel('Tags')
            )
            ->addField(
                SharpFormDateField::make("published_at")
                    ->setLabel("Date affichée sur le site")
                    ->setHasTime(true)
                    ->setDisplayFormat("DD/MM/YYYY HH:mm")
                    ->setMondayFirst()
            )
            ->addField(
                SharpFormTextField::make("title")
                    ->setLabel("Titre")
                    ->setMaxLength(300)
            )
            ->addField(
                SharpFormEditorField::make("content")
                    ->setToolbar([
                        SharpFormEditorField::B,
                        SharpFormEditorField::I,
                        SharpFormEditorField::HIGHLIGHT,
                        SharpFormEditorField::UL,
                        SharpFormEditorField::OL,
                        SharpFormEditorField::SEPARATOR,
                        SharpFormEditorField::A,
                        SharpFormEditorField::H1,
                        SharpFormEditorField::H2,
                        SharpFormEditorField::SEPARATOR,
                        SharpFormEditorField::A,
                    ])
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column

                    ->withFields("title")
                    ->withFields("content")
                    ->withFields("tags");
            })
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withFields("published_at|6")
                    ->withSingleField("cover");
            });
    }

    public function create(): array
    {
        return [
            'published_at' => now(),
        ];
    }


    function find($id): array
    {
        return $this
            ->setCustomTransformer("tags", function($value, Blogpost $blogpost) {
                return collect($blogpost->tags)->map(fn($tag) => ["id" => $tag->id])->all();
            })
            ->setCustomTransformer("cover", new SharpUploadModelFormAttributeTransformer())
            ->transform(Blogpost::with('cover')->findOrFail($id));
    }

    function update($id, array $data)
    {
        $blogpost = $id
            ? Blogpost::findOrFail($id)
            : new Blogpost([
                "type" => BlogpostType::NEWS,
                'state' => BlogpostState::DRAFT,
                'user_id' => auth()->id(),
            ]);
        $data['published_at'] = now();
        if ($data['title'] ?? false) {
            $data['slug'] = Str::slug($data['title']);
        }

        $this
            ->save($blogpost, $data);

        if ($data['tags'] ?? false) {
            $blogpost->syncTags(collect($data['tags'])->map(fn($tag) => Tag::find($tag['id'])->name)->all());
        }

        return $blogpost->id;
    }

    public function delete($id): void
    {
        Blogpost::find($id)->delete();
    }
}
