<?php

namespace App\Livewire\Admin\Settings;

use App\Models\DespositDetails;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class DepositDetailsSettings extends Component
{
    use Toast;
    use WithFileUploads;

    public $perPage = 10;
    public array $expanded = [];
    use WithPagination;

    public $addDepositDetails = false;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'type', 'label' => 'Type'],
            ['key' => 'address', 'label' => 'Address'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $data = DespositDetails::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.settings.deposit-details-settings', [
            'headers' => $headers,
            'data' => $data
        ]);
    }

    public function openAddForm()
    {
        $this->reset();
        $this->addDepositDetails = true;
    }
    public function closeAddForm()
    {
        $this->reset();
        $this->addDepositDetails = false;
    }

    public $detailTypes = [
        [
            'id' => 'tether',
            'name' => 'Tether'
        ],
        [
            'id' => 'upi',
            'name' => 'UPI'
        ],
        [
            'id' => 'bank',
            'name' => 'Bank'
        ]
    ];


    public $type; // tether, upi, bank
    public $address; // required on all types
    public $qr_code; // required if type = upi or type = tether
    public $bank_name; // required if type = bank
    public $account_name; // required if type = bank
    public $ifsc_code; // required if type = bank
    public $micr_code; // optional
    public $branch_address; // optional

    #[Validate]
    protected function rules()
    {
        $rules = [
            'type' => 'required|in:tether,upi,bank',
            'address' => 'required|string|max:255',
        ];

        if (in_array($this->type, ['upi', 'tether'])) {
            $rules['qr_code'] = 'required|image|mimes:jpeg,png,jpg|max:10240'; // 10MB max
        }

        if ($this->type === 'bank') {
            $rules['bank_name'] = 'required|string|max:255';
            $rules['account_name'] = 'required|string|max:255';
            $rules['ifsc_code'] = 'required|string|max:11|min:11|regex:/^[A-Za-z]{4}0[A-Za-z0-9]{6}$/';
        }

        // Optional fields
        $rules['micr_code'] = 'nullable|string|max:20';
        $rules['branch_address'] = 'nullable|string|max:255';

        return $rules;
    }
    protected function messages()
    {
        return [
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid.',
            'address.required' => 'The address field is required.',
            'qr_code.required' => 'A QR code is required for UPI or Tether types.',
            'qr_code.image' => 'The QR code must be an image file.',
            'bank_name.required' => 'The bank name is required for Bank detail.',
            'account_name.required' => 'The account name is required for Bank detail.',
            'ifsc_code.required' => 'The IFSC code is required for Bank detail.',
            'ifsc_code.regex' => 'The IFSC code must be valid (e.g., SBIN0123456, HDFC0005678, ICIC0007890).',
        ];
    }
    public function save()
    {
        try {
            $this->validate(); // Runs the dynamic rules

            $formData = [
                'type' => $this->type,
                'address' => $this->address,
                'qr_code' => $this->qr_code ? $this->qr_code->store('qr_codes', 'public') : null,
                'bank_name' => $this->type == 'bank' ? $this->bank_name : null,
                'account_name' => $this->type == 'bank' ? $this->account_name : null,
                'ifsc_code' => $this->type == 'bank' ? $this->ifsc_code : null,
                'micr_code' => $this->type == 'bank' ? $this->micr_code : null,
                'branch_address' => $this->type == 'bank' ? $this->branch_address : null,
            ];
            DespositDetails::create($formData);
            $this->success('Added succesfully');
            $this->reset();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DespositDetails::destroy($id);
            $this->success('Delete Successfully.');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
