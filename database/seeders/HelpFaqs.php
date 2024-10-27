<?php

namespace Database\Seeders;

use App\Models\Help;
use App\Models\HelpCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HelpFaqs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'key' => 'kyc_information',
                'name' => 'KYC Information',
            ],
            [
                'key' => 'documents_information',
                'name' => 'Documents Information',
            ],
            [
                'key' => 'general_information',
                'name' => 'General Information',
            ],
            [
                'key' => 'account',
                'name' => 'Account',
            ]
        ];
        HelpCategory::insert($categories);

        $kycInformations = [
            [
                'help_category_id' => 1,
                'question' => 'What is KYC?',
                'answer' => 'At Gro Trades, we have to protect our users and their customers from any kind of fraud. Know Your Customer documents basically help establish the identity of your business and helps Gro Trades onboard you as a user, while mitigating any risk at the same time. You can learn in detail about KYC in this well explained wikipedia article.'
            ],
            [
                'help_category_id' => 1,
                'question' => 'Why is KYC needed?',
                'answer' => 'We need your KYC documents to verify your business and bank accounts to prevent fraud and to mitigate risk.'
            ],
            [
                'help_category_id' => 1,
                'question' => 'How to upload the Documents?',
                'answer' => 'Just upload your documents Data from KYC Form we provided.'
            ]
        ];
        Help::insert($kycInformations);
        $documentsInformations = [
            [
                'help_category_id' => 2,
                'question' => 'What documents are required to submit KYC?',
                'answer' => 'ccccccc'
            ],
            [
                'help_category_id' => 2,
                'question' => 'What Information Must be Clear in the Uploaded Documents',
                'answer' => 'Proof of bank account, the uploaded document must clearly display the following information: Account holder name, Account number, IFSC code, Address'
            ]
        ];
        Help::insert($documentsInformations);
        $generalInformations = [
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ]
        ];
        $accountFaq = [
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ],
            [
                'question' => 'cccccccc',
                'answer' => 'ccccccc'
            ]
        ];
    }
}
