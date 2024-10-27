<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Help as ModelsHelp;
use App\Models\HelpCategory;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class Help extends Component
{
    use Toast;
    use WithPagination;
    public $addFaq = false;

    public $editFaq = null;
    // form properties
    #[Validate('required')]
    public $category = 3;
    #[Validate('required|min:5')]
    public $question;
    #[Validate('required|min:5')]
    public $answer;
    #[Validate('required')]
    public bool $in_help = true;
    #[Validate('required')]
    public bool $in_kyc = true;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'category.name', 'label' => 'Category'],
            ['key' => 'question', 'label' => 'Question'],
            ['key' => 'section', 'label' => 'Sections'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
        $editorConfig = [
            'min_height' => 100,
            'max_height' => 250,
            'quickbars_selection_toolbar' => 'bold italic link',
        ];

        $data = ModelsHelp::orderBy('id', 'desc')->orderBy('help_category_id', 'desc')->paginate(10);
        $categories = HelpCategory::all();
        return view('livewire.admin.settings.help', [
            'headers' => $headers,
            'data' => $data,
            'categories' => $categories,
            'editorConfig' => $editorConfig
        ]);
    }
    public function resetForm()
    {
        $this->editFaq = null;
        $this->category = 3;
        $this->question = null;
        $this->answer = null;
        $this->in_help = true;
        $this->in_kyc = true;
        $this->reset();
    }

    public function openAddForm()
    {
        $this->resetForm();
        $this->addFaq = true;
    }

    public function saveForm()
    {
        if ($this->editFaq) {
            return $this->update();
        }
        return $this->save();
    }

    public function save()
    {
        try {
            $this->validate();

            $formData = [
                'help_category_id' => $this->category,
                'question' => $this->question,
                'answer' => $this->answer,
                'in_help' => $this->in_help,
                'in_kyc' => $this->in_kyc
            ];
            ModelsHelp::create($formData);
            $this->resetForm();
            $this->addFaq = false;
            $this->success('Added succesfully');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function openEdit($id)
    {
        try {
            $this->resetForm();
            $faq = ModelsHelp::find($id);
            $this->editFaq = $faq;
            $this->category = $faq->help_category_id;
            $this->question = $faq->question;
            $this->answer = $faq->answer;
            $this->in_help = $faq->in_help;
            $this->in_kyc = $faq->in_kyc;
            $this->addFaq = true;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function update()
    {
        try {
            $this->editFaq->help_category_id = $this->category;
            $this->editFaq->question = $this->question;
            $this->editFaq->answer = $this->answer;
            $this->editFaq->in_help = $this->in_help;
            $this->editFaq->in_kyc = $this->in_kyc;
            $this->editFaq->save();
            $this->resetForm();
            $this->addFaq = false;
            $this->success('Update successfully.');
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }

    public function delete($id){
        try {
            ModelsHelp::destroy($id);
            $this->success('Delete Successfully.');
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
}
