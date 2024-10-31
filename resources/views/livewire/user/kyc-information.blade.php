<x-mary-modal wire:model="showKycModal" class="backdrop-blur" box-class="max-w-4xl w-full">
    <h3 class="text-2xl border-b font-semibold mb-2">Below The Following Details Are Incomplete Please Fill it to Avail Fully Featured Account</h3>
    <ol class="list-decimal ps-5">
        @if ($user->getKycStatus() == 'pending')
        <li class="text-xl mb-4">
            Your KYC(Know your Customers) is Incomplete Please Complete Your KYC to Enable Withdrawal Options.<br />
            <small><b>Note: </b> Get More Details On How to Apply For KYC and its Required Documents On KYC Page You Can Visit By <a class="text-primary" href="{{ route('user.account.kyc') }}">Clicking Here</a>.</small>
        </li>
        @endif
        @if (!$user->profile_photo_path ||
        !$user->gender ||
        !$user->date_of_birth||
        !$user->address||
        !$user->city||
        !$user->state||
        !$user->country||
        !$user->pincode)
        <li class="text-xl">
            Your Profile is Incomplete Please Complete Your Profile to Enjoy Fully Featured Account and Great Support.<br />
            <small><b>The Following Things Are Remaining To Complete in Profile Section Please Complete it.</b></small>
            <ol class="list-[lower-alpha] ps-5">
                <li><small>Profile picture</small></li>
                <li><small>Gender</small></li>
                <li><small>Date Of Birth (DOB)</small></li>
                <li><small>Address (Room no, Building Name, Street Address)</small></li>
                <li><small>City</small></li>
                <li><small>State</small></li>
                <li><small>Country</small></li>
                <li><small>Zip/Pin code</small></li>
            </ol>
            <small><b>Note: </b>You Can Complete Your Profile by <a class="text-primary" href="{{ route('profile.show') }}">Clicking Here</a>.</small>
        </li>
        @endif
    </ol>
</x-mary-modal>
