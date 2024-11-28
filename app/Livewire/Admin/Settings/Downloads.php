<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Download;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class Downloads extends Component
{
    use Toast;
    use WithPagination;
    use WithFileUploads;

    public $addDownload = false;

    public $editDownload = null;
    // form properties
    #[Validate('image')]
    public $image;
    #[Validate('required|min:5')]
    public $title;
    #[Validate('required|min:5')]
    public $details;
    // #[Validate('file|mimes:exe,apk,msi,zip|max:102400')] // 100MB
    // #[Validate('file|mimes:exe,apk,msi,zip|mimetypes:application/vnd.android.package-archive,application/x-msdownload,application/x-zip-compressed,application/octet-stream|max:102400')]

    #[Validate('file|mimes:exe,apk,msi|max:102400')] // 100MB
    public $file;

    public $oldImage = null;
    public $oldFile = null;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'image', 'label' => 'image'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
        $data = Download::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.settings.downloads', [
            'headers' => $headers,
            'data' => $data
        ]);
    }

    public function resetForm()
    {
        $this->editDownload = null;
        $this->image = null;
        $this->title = null;
        $this->details = null;
        $this->file = null;
        $this->reset();
    }

    public function openAddForm()
    {
        $this->resetForm();
        $this->addDownload = true;
    }

    public function saveForm()
    {
        if ($this->editDownload) {
            return $this->update();
        }
        return $this->save();
    }

    public function save()
    {
        try {
            $this->validate();

            if (!$this->image && !$this->oldImage && !$this->editDownload->image) {
                $this->error('Image is required');
                return;
                // return error
            }
            if (!$this->file && !$this->oldFile && !$this->editDownload->file) {
                // return error
                $this->error('Downloadable file is required');
                return;
            }

            $imagePath = $this->oldImage;
            if ($this->image) {
                $imagePath = $this->image->store('downloads/image', 'public');
            }
            $filePath = $this->oldFile;
            if ($this->file) {
                // logger('Uploaded file MIME type: ' . $this->file->getMimeType());
                // $filePath = $this->file->store('downloads/file', 'public');
                $filePath = $this->file->storeAs('downloads/file', $this->file->getClientOriginalName(), 'public');
            }


            $formData = [
                'image' => $imagePath,
                'title' => $this->title,
                'details' => $this->details,
                'file' => $filePath,
            ];
            Download::create($formData);
            $this->resetForm();
            $this->addDownload = false;
            $this->success('Added succesfully');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

    public function openEdit($id)
    {
        try {
            $this->resetForm();
            $download = Download::find($id);

            $this->editDownload = $download;

            $this->oldImage = $download->image;
            $this->title = $download->title;
            $this->details = $download->details;
            $this->oldFile = $download->file;

            $this->addDownload = true;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function closeModal()
    {
        $this->editDownload = null;

        $this->oldImage = null;
        $this->title = '';
        $this->details = '';
        $this->oldFile = null;
        $this->addDownload = \false;
    }

    public function update()
    {
        try {
            $this->editDownload->title = $this->title;
            $this->editDownload->details = $this->details;
            if ($this->image) {
                $imagePath = $this->image->store('downloads/image', 'public');
                $this->editDownload->image = $imagePath;
            }
            if ($this->file) {
                $filePath = $this->file->store('downloads/file', 'public');
                $this->editDownload->file = $filePath;
            }
            $this->editDownload->save();
            $this->resetForm();
            $this->addDownload = false;
            $this->success('Update successfully.');
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Download::destroy($id);
            $this->success('Delete Successfully.');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
