<div>
    <div class="mb-5">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Manage Funds') }}
        </h2>
    </div>
    <x-mary-card>
        <div class="flex gap-3">
            <x-mary-icon name="o-circle-stack" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
            <div class="flex flex-col gap-3">
                <p class="text-2xl font-bold">Deposit</p>
                <p class="text-red-700">
                    <b>Note:</b> Please Complete the payment first (by below methods) and take screenshot of the successfull payment and attach in the form below.
                </p>
            </div>
        </div>
        <div class="grid md:grid-cols-3 gap-3 mt-4 mb-3">

            <x-mary-button class="btn-outline h-auto p-8" spinner="setShowSection('usdt')" wire:click="setShowSection('usdt')">
                <div class="flex items-center justify-center flex-col">
                    <div class="flex gap-2 items-center font-semibold text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" xml:space="preserve" id="_x3C_Layer_x3E_" width="800" height="800" version="1.1" viewBox="0 0 32 32">
                            <g id="Tron_x2C__crypto_1_">
                                <g id="XMLID_71_">
                                    <g id="XMLID_1484_">
                                        <path id="XMLID_61_" d="m2.5 1.5 11 29 16-20-5.3-5.2z" fill="none" />
                                    </g>
                                    <g id="XMLID_2520_">
                                        <path id="XMLID_65_" d="m16 12.5-2.5 18 16-20z" fill="none" />
                                    </g>
                                    <g id="XMLID_2671_">
                                        <path id="XMLID_66_" d="m2.5 1.5 13.5 11 8.2-7.2z" fill="none" />
                                    </g>
                                </g>
                                <g id="XMLID_80_">
                                    <g id="XMLID_4521_">
                                        <path id="XMLID_707_" d="M16 13c-.24 0-.46-.18-.49-.43-.04-.27.15-.53.42-.57l13.5-2c.27-.04.53.15.57.42.04.27-.15.53-.42.57l-13.5 2c-.03.01-.06.01-.08.01z" fill="#ff5252" />
                                    </g>
                                    <g id="XMLID_4522_">
                                        <path id="XMLID_706_" d="M16 13c-.11 0-.22-.04-.32-.11l-13.5-11c-.21-.18-.24-.49-.07-.71.17-.21.49-.25.7-.07l13.5 11c.21.17.25.49.07.7-.09.13-.23.19-.38.19z" fill="#ff5252" />
                                    </g>
                                    <g id="XMLID_4520_">
                                        <path id="XMLID_705_" d="M13.5 31h-.07c-.27-.04-.46-.29-.43-.56l2.5-18c.02-.12.08-.23.17-.31l8.2-7.2c.21-.18.52-.16.71.05.18.21.16.52-.05.71l-8.06 7.08L14 30.57c-.04.25-.25.43-.5.43z" fill="#ff5252" />
                                    </g>
                                    <g id="XMLID_4518_">
                                        <path id="XMLID_702_" d="M13.5 31c-.03 0-.05 0-.08-.01-.18-.03-.33-.15-.39-.32l-11-29c-.06-.16-.03-.35.08-.49s.3-.2.47-.17l21.7 3.8c.1.02.19.06.26.14l5.3 5.2c.18.18.2.47.04.67l-16 20c-.09.11-.23.18-.38.18zM3.28 2.14 13.66 29.5l15.17-18.96-4.87-4.77L3.28 2.14z" fill="#ff5252" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                        tether
                    </div>
                    <span class="mt-3">USDT TRC-20</span>
                </div>
            </x-mary-button>

            <x-mary-button class="btn-outline h-auto p-8" spinner="setShowSection('upi')" wire:click="setShowSection('upi')">
                <div class="flex items-center justify-center flex-col">
                    <div class="flex gap-2 items-center font-semibold text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" width="800" height="800" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M2 16.9c0-1.3094 0-1.9641.29472-2.445.16491-.2691.39117-.4954.66028-.6603C3.43594 13.5 4.09063 13.5 5.4 13.5h1.1c1.88562 0 2.82843 0 3.41421.5858C10.5 14.6716 10.5 15.6144 10.5 17.5v1.1c0 1.3094 0 1.9641-.2947 2.445-.1649.2691-.39119.4954-.6603.6603C9.06406 22 8.40937 22 7.1 22c-1.96406 0-2.94609 0-3.6675-.4421-.40366-.2473-.74305-.5867-.99042-.9904M22 7.1c0 1.30937 0 1.96406-.2947 2.445-.1649.26911-.3912.4954-.6603.6603-.4809.2947-1.1356.2947-2.445.2947h-1.1c-1.8856 0-2.8284 0-3.4142-.58579C13.5 9.32843 13.5 8.38562 13.5 6.5V5.4c0-1.30937 0-1.96406.2947-2.445.1649-.26911.3912-.49537.6603-.66028C14.9359 2 15.5906 2 16.9 2c1.9641 0 2.9461 0 3.6675.44208.4037.24737.7431.58676.9904.99042" />
                            <path fill="currentColor" d="M16.5 6.25c0-.51541 0-.77311.1291-.95507.0456-.06421.1016-.12027.1658-.16582C16.9769 5 17.2346 5 17.75 5s.7731 0 .9551.12911c.0642.04555.1202.10161.1658.16582C19 5.47689 19 5.73459 19 6.25c0 .51541 0 .77311-.1291.95507-.0456.06421-.1016.12027-.1658.16582C18.5231 7.5 18.2654 7.5 17.75 7.5s-.7731 0-.9551-.12911c-.0642-.04555-.1202-.10161-.1658-.16582C16.5 7.02311 16.5 6.76541 16.5 6.25ZM12.75 22c0 .4142.3358.75.75.75s.75-.3358.75-.75h-1.5Zm1.6389-8.1629.4166.6236-.4166-.6236Zm-.5518.5518-.6236-.4167.6236.4167ZM19 12.75h-2v1.5h2v-1.5ZM12.75 19v3h1.5v-3h-1.5ZM17 12.75c-.6866 0-1.258-.0009-1.719.046-.4735.0481-.9128.1529-1.3088.4175l.8333 1.2472c.1085-.0725.2725-.1363.6273-.1724.3674-.0374.8494-.0383 1.5672-.0383v-1.5ZM14.25 17c0-.7178.0009-1.1998.0383-1.5672.0361-.3548.0999-.5188.1724-.6273l-1.2472-.8333c-.2646.396-.3694.8353-.4175 1.3088-.0469.461-.046 1.0324-.046 1.719h1.5Zm-.2778-3.7865c-.3003.2006-.5581.4584-.7587.7587l1.2472.8333c.0912-.1365.2083-.2536.3448-.3448l-.8333-1.2472ZM22.75 13.5c0-.4142-.3358-.75-.75-.75s-.75.3358-.75.75h1.5Zm-1.9846 8.3478.287.6929-.287-.6929Zm1.0824-1.0824-.693-.287.693.287ZM17 22.75h2v-1.5h-2v1.5ZM22.75 17v-3.5h-1.5V17h1.5ZM19 22.75c.4557 0 .835.0004 1.1454-.0208.3171-.0216.6166-.0682.907-.1885l-.574-1.3859c-.0772.032-.1944.0615-.4351.0779-.2475.0169-.5671.0173-1.0433.0173v1.5ZM21.25 19c0 .4762-.0004.7958-.0173 1.0433-.0164.2407-.0459.3579-.0779.4351l1.3859.574c.1203-.2904.1669-.5899.1885-.907.0212-.3104.0208-.6897.0208-1.1454h-1.5Zm-.1976 3.5407c.6738-.2791 1.2092-.8145 1.4883-1.4883l-1.3859-.574c-.1268.3062-.3702.5496-.6764.6765l.574 1.3858Z" />
                            <path stroke="currentColor" stroke-width="1.5" d="M2 7.1c0-1.96406 0-2.94609.44208-3.6675.24737-.40366.58676-.74305.99042-.99042C4.15391 2 5.13594 2 7.1 2c1.30937 0 1.96406 0 2.445.29472.26911.16491.4954.39117.6603.66028.2947.48094.2947 1.13563.2947 2.445v1.1c0 1.88562 0 2.82843-.58579 3.41421C9.32843 10.5 8.38562 10.5 6.5 10.5H5.4c-1.30937 0-1.96406 0-2.445-.2947-.26911-.1649-.49537-.39119-.66028-.6603C2 9.06406 2 8.40937 2 7.1Z" />
                            <path fill="#1C274C" d="M5 6.25c0-.51541 0-.77311.12911-.95507a.6995818.6995818 0 0 1 .16582-.16582C5.47689 5 5.73459 5 6.25 5c.51541 0 .77311 0 .95507.12911a.6995818.6995818 0 0 1 .16582.16582C7.5 5.47689 7.5 5.73459 7.5 6.25c0 .51541 0 .77311-.12911.95507a.6995818.6995818 0 0 1-.16582.16582C7.02311 7.5 6.76541 7.5 6.25 7.5c-.51541 0-.77311 0-.95507-.12911a.6995818.6995818 0 0 1-.16582-.16582C5 7.02311 5 6.76541 5 6.25Zm0 11.5c0-.5154 0-.7731.12911-.9551.04555-.0642.10161-.1202.16582-.1658.18196-.1291.43966-.1291.95507-.1291.51541 0 .77311 0 .95507.1291.06421.0456.12027.1016.16582.1658.12911.182.12911.4397.12911.9551s0 .7731-.12911.9551c-.04555.0642-.10161.1202-.16582.1658C7.02311 19 6.76541 19 6.25 19c-.51541 0-.77311 0-.95507-.1291-.06421-.0456-.12027-.1016-.16582-.1658C5 18.5231 5 18.2654 5 17.75Zm11 0c0-.7022 0-1.0533.1685-1.3056.073-.1092.1667-.2029.2759-.2759C16.6967 16 17.0478 16 17.75 16s1.0533 0 1.3056.1685c.1092.073.2029.1667.2759.2759.1685.2523.1685.6034.1685 1.3056s0 1.0533-.1685 1.3056c-.073.1092-.1667.2029-.2759.2759-.2523.1685-.6034.1685-1.3056.1685s-1.0533 0-1.3056-.1685c-.1092-.073-.2029-.1667-.2759-.2759C16 18.8033 16 18.4522 16 17.75Z" />
                        </svg>
                        UPI/QR
                    </div>
                    <span class="mt-3">Transfer via UPI ID/QR Code</span>
                </div>
            </x-mary-button>

            <x-mary-button class="btn-outline h-auto p-8" spinner="setShowSection('bank')" wire:click="setShowSection('bank')">
                <div class="flex items-center justify-center flex-col">
                    <div class="flex gap-2 items-center font-semibold text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" xml:space="preserve" width="800" height="800" version="1.0" viewBox="0 0 64 64">
                            <path fill="#506C7F" d="M18 25h4v29h-4zm12 0h4v29h-4zm12 0h4v29h-4z" />
                            <path fill="#B4CCB9" d="M48 25h4v29h-4zm-24 0h4v29h-4zm12 0h4v29h-4zm-24 0h4v29h-4z" />
                            <path fill="#F9EBB2" d="M8 56c-1.104 0-2 .896-2 2h52c0-1.104-.895-2-2-2H8zm52 4H4c-1.104 0-2 .896-2 2h60c0-1.104-.895-2-2-2zM4 23h56c.893 0 1.684-.601 1.926-1.461.24-.86-.125-1.785-.889-2.248l-28-17C32.725 2.1 32.365 2 32 2c-.367 0-.725.1-1.037.29L2.961 19.291c-.764.463-1.129 1.388-.888 2.247C2.315 22.399 3.107 23 4 23z" />
                            <g fill="#394240">
                                <path d="M60 58c0-2.209-1.791-4-4-4h-2V25h6c1.795 0 3.369-1.194 3.852-2.922.484-1.728-.242-3.566-1.775-4.497l-28-17C33.439.193 32.719 0 32 0s-1.438.193-2.076.581l-28 17c-1.533.931-2.26 2.77-1.775 4.497C.632 23.806 2.207 25 4 25h6v29H8c-2.209 0-4 1.791-4 4-2.209 0-4 1.791-4 4v2h64v-2c0-2.209-1.791-4-4-4zM4 23c-.893 0-1.685-.601-1.926-1.462-.241-.859.124-1.784.888-2.247l28-17.001C31.275 2.1 31.635 2 32 2c.367 0 .725.1 1.039.291l28 17c.764.463 1.129 1.388.887 2.248C61.686 22.399 60.893 23 60 23H4zm48 2v29h-4V25h4zm-6 0v29h-4V25h4zm-6 0v29h-4V25h4zm-6 0v29h-4V25h4zm-6 0v29h-4V25h4zm-6 0v29h-4V25h4zm-6 0v29h-4V25h4zM8 56h48c1.105 0 2 .896 2 2H6c0-1.104.896-2 2-2zm-6 6c0-1.104.896-2 2-2h56c1.105 0 2 .896 2 2H2z" />
                                <path d="M32 9c-2.762 0-5 2.238-5 5s2.238 5 5 5 5-2.238 5-5-2.238-5-5-5zm0 8c-1.656 0-3-1.343-3-3s1.344-3 3-3c1.658 0 3 1.343 3 3s-1.342 3-3 3z" />
                            </g>
                            <circle cx="32" cy="14" r="3" fill="#F76D57" />
                        </svg>

                        WIRE TRANSFER
                    </div>
                    <span class="mt-3">Manual Bank Transfer</span>
                </div>
            </x-mary-button>

        </div>

        @if ($showSection == 'usdt')
        <div class="border rounded-xl p-3 text-center flex items-center justify-center flex-col">
            <p class="text-xl font-semibold">
                Deposit USDT TRC20
            </p>
            <p class="text-wrap break-all">
                Please send <b>USDT TRC-20</b> to the following address
            </p>
            <img src="{{ env('USDT_QR_FILE') }}" class="w-full max-w-sm" />
            <div class="border rounded flex justify-between items-center gap-4 py-1 px-2">
                <div class="text-start">
                    <small class="text-gray-600">When asked, copy-paste this wallet address:</small> <br />
                    {{ env('USDT_ADDRESS') }}
                </div>
                <x-mary-icon name="o-clipboard-document-list" class="ms-3 cursor-pointer" title="{{ env('USDT_ADDRESS') }}" x-clipboard />
            </div>
        </div>
        @endif
        @if ($showSection == 'upi')
        <div class="border rounded-xl p-3 text-center flex items-center justify-center flex-col">
            <p class="text-xl font-semibold">
                Deposit via UPI/QR
            </p>

            @if (env('UPI_QR_FILE') && env('UPI_ADDRESS'))
            <img src="/img/QR/qr-upi.png" class="w-full max-w-sm" />
            <div class="border rounded flex justify-between items-center gap-4 py-1 px-2 min-w-72">
                <div class="text-start">
                    <small class="text-gray-600">Copy UPI address:</small> <br />
                    {{ env('UPI_ADDRESS') }}
                </div>
                <x-mary-icon name="o-clipboard-document-list" class="ms-3 cursor-pointer" title="{{ env('UPI_ADDRESS') }}" x-clipboard />
            </div>
            @else
            <h4 class="text-3xl font-bold py-8">N/A</h4>
            @endif
        </div>
        @endif
        @if ($showSection == 'bank')
        <div class="border rounded-xl p-3 text-center flex items-center justify-center flex-col">
            <p class="text-xl font-semibold">
                Manual Bank Transfer
            </p>

            @if (env('BANK_ACCOUNT_NAME') == 'TestBank' && env('BANK_ACCOUNT_NAME_2') == 'TestBank')
            <h4 class="text-3xl font-bold py-8">N/A</h4>
            @else
            <div class="grid md:grid-cols-2 gap-4">
                @if (env('BANK_ACCOUNT_NAME') != 'TestBank')
                <div class="border rounded py-1 w-full mt-3">
                    <div class="text-start *:grid *:grid-cols-2 *:px-3 *:py-1 *:gap-3 divide-y">
                        <div>
                            <b>Name:</b><span>{{ env('BANK_ACCOUNT_NAME') }}</span>
                        </div>
                        <div>
                            <b>Bank:</b><span>{{ env('BANK_BANK_NAME') }}</span>
                        </div>
                        <div>
                            <b>A/C No:</b><span>{{ env('BANK_ACCOUNT_NUMBER') }}</span>
                        </div>
                        <div>
                            <b>IFSC Code:</b><span>{{ env('BANK_IFSC_CODE') }}</span>
                        </div>
                        <div>
                            <b>MICR Code:</b><span>{{ env('BANK_MICR_CODE') }}</span>
                        </div>
                        <div>
                            <b>Branch Address:</b><span>{{ env('BANK_BRANCH_ADDRESS') }}</span>
                        </div>
                    </div>
                </div>
                @endif
                @if (env('BANK_ACCOUNT_NAME_2') != 'TestBank')
                <div class="border rounded py-1 w-full mt-3">
                    <div class="text-start *:grid *:grid-cols-2 *:px-3 *:py-1 *:gap-3 divide-y">
                        <div>
                            <b>Name:</b><span>{{ env('BANK_ACCOUNT_NAME_2') }}</span>
                        </div>
                        <div>
                            <b>Bank:</b><span>{{ env('BANK_BANK_NAME_2') }}</span>
                        </div>
                        <div>
                            <b>A/C No:</b><span>{{ env('BANK_ACCOUNT_NUMBER_2') }}</span>
                        </div>
                        <div>
                            <b>IFSC Code:</b><span>{{ env('BANK_IFSC_CODE_2') }}</span>
                        </div>
                        <div>
                            <b>MICR Code:</b><span>{{ env('BANK_MICR_CODE_2') }}</span>
                        </div>
                        <div>
                            <b>Branch Address:</b><span>{{ env('BANK_BRANCH_ADDRESS_2') }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>
        @endif

        <x-mary-form wire:submit="save" class="mt-5" no-separator>
            <x-mary-input label="Amount" placeholder="Enter amount in dollars" wire:model="amount" type="number" prefix="$" required />
            <x-mary-file wire:model="file" label="Receipt" accept="image/*" class="*:w-full" required />
            <div class="mt-4">
                <x-mary-button label="Deposit" class="btn-primary" type="submit" spinner="save" />
            </div>
        </x-mary-form>
    </x-mary-card>
</div>
