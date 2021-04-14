<x-dashboard-tile :position="$position" :mailboxId="$mailboxId">
    <div class="text-center">
        <h1 style="font-size: 1.5rem">{{ $helpscoutData[$mailboxId]["mailbox"] }}</h1>
    </div>
    <div wire:poll.{{ $refreshIntervalInSeconds }}s class="gap-4 text-center">
        <div class="grid grid-cols-1" style="min-height: 9rem">
            @if($helpscoutData[$mailboxId]["ticketsActive"] === 0)
                <div class="rounded-lg" style="font-size: 2rem; border: 1px solid #39FF14">
                    <h3 style="color: #39FF14; padding: 4.8rem 0 4.8rem 0">{{ $no_active_tickets_text  }}</h3>
                </div>
            @else
                <div class="rounded-lg" style="background-color: rgba(255, 36, 36, {{ $helpscoutData[$mailboxId]['ticketsActiveAlertTransparency'] }});">
                    <h1 style="font-size: 7rem"> {{ $helpscoutData[$mailboxId]["ticketsActive"] }}</h1>
                    <h2>Tickets</h2>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-2">
            <div class="rounded-lg">
                <h1 style="font-size: 3.5rem"> {{ $helpscoutData[$mailboxId]["ticketsPending"] }}</h1>
                <h3>Pending tickets</h3>
            </div>
            @if ($helpscoutData[$mailboxId]["solvedToday"] === 1)
                <div class="rounded-lg">
                    <h1 style="font-size: 3.5rem"> {{ $helpscoutData[$mailboxId]["solvedToday"] }}</h1>
                    <h3>Ticket solved today</h3>
                </div>
            @else
                <div class="rounded-lg">
                  <h1 style="font-size: 3.5rem"> {{ $helpscoutData[$mailboxId]["solvedToday"] }}</h1>
                 <h3>Tickets solved today</h3>
             </div>
            @endif
        </div>
    </div>
</x-dashboard-tile>
