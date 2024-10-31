<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Pageview/Visitors') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination
            per-page="perPage"
            :per-page-values="[10, 20, 50]"
            wire:model="expanded"
            expandable show-empty-text>
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="It is empty." />
            </x-slot:empty>
            @scope('cell_id', $pageView)
            {{ $loop->index+1 }}
            @endscope

            @scope('expansion', $pageView)
            <div class="bg-base-200 p-4">
                <b>User Agent: </b>{{ $pageView->user_agent }}<br />
                <b>Latitude / Longitude: </b>{{ $pageView->lat .' / '.$pageView->long }}<br />
                <b>From: </b>{{ $pageView->city . ', ' . $pageView->state . ', ' . $pageView->country . ', ' . $pageView->zip }}<br />
                <b>At: </b>{{ date('d-M-Y, h:i a', strtotime($pageView->created_at)) }}
            </div>
            @endscope

            @scope('cell_created_at', $pageView)
            {{ date('d-M-Y', strtotime($pageView->created_at)) }}
            @endscope
        </x-mary-table>
    </x-mary-card>
</div>
