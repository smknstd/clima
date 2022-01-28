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

class SinglePhotoForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    protected ?string $formValidatorClass = SinglePhotoValidator::class;

    function buildFormFields(FieldsContainer $formFields) : void
    {
        $formFields
            ->addField(
                SharpFormUploadField::make("cover")
                    ->setLabel("Photo")
                    ->setFileFilterImages()
                    ->setMaxFileSize(1)
                    ->shouldOptimizeImage()
                    ->setStorageDisk("local")
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
                SharpFormTextField::make("title")
                    ->setLabel("Titre")
                    ->setMaxLength(300)
            );
    }

    function buildFormLayout(FormLayout $formLayout): void
    {
        $formLayout
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column

                    ->withFields("title")
                    ->withFields("tags");
            })
            ->addColumn(6, function(FormLayoutColumn $column) {
                $column
                    ->withSingleField("cover");
            });
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
                "type" => BlogpostType::SINGLE_PHOTO,
                'state' => BlogpostState::DRAFT,
                'published_at' => now(),
                'user_id' => auth()->id(),
            ]);

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
