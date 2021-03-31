<?php

namespace Creacoon\HelpscoutTile;

use Carbon\Carbon;
use HelpScout\Api\Conversations\ConversationFilters;
use Illuminate\Console\Command;
use HelpScout\Api\ApiClientFactory;

class FetchDataFromHelpscoutCommand extends Command
{
    protected $signature = 'dashboard:fetch-data-from-helpscout-api';

    protected $description = 'Fetch data for helpscout tile';

    public function handle()
    {
        $client = ApiClientFactory::createClient();
        $client->useClientCredentials(config('dashboard.tiles.helpscout.app_id'), config('dashboard.tiles.helpscout.app_secret'));

        $mailboxIds = config('dashboard.tiles.helpscout.mailboxes');
        $helpscoutData = [];

        foreach ($mailboxIds as $mailboxId){
            $filterActive = (new ConversationFilters())
                ->inStatus('active')
                ->inMailbox($mailboxId);

            $filterPending = (new ConversationFilters())
                ->inStatus('pending')
                ->inMailbox($mailboxId);

            $filterSolvedToday = (new ConversationFilters())
                ->inStatus('closed')
                ->modifiedSince(Carbon::today()->startOfDay()->toDateTime())
                ->inMailbox($mailboxId);

            $ticketsActive = $client->conversations()->list($filterActive)->count();
            $ticketsPending = $client->conversations()->list($filterPending)->count();
            $solvedToday = $client->conversations()->list($filterSolvedToday)->count();
            $mailbox = $client->mailboxes()->get($mailboxId)->getName();

            $ticketsActiveAlertTransparency = $ticketsActive / config('dashboard.tiles.helpscout.active_tickets_full_alert');
            if ($ticketsActiveAlertTransparency >= 1){
                $ticketsActiveAlertTransparency = 1;
            }

            $helpscoutData[$mailboxId] = [
                'mailbox' => $mailbox,
                'ticketsActive' => $ticketsActive,
                'ticketsActiveAlertTransparency' => $ticketsActiveAlertTransparency,
                'ticketsPending' => $ticketsPending,
                'solvedToday' => $solvedToday,
            ];
        }

        HelpscoutTileStore::make()->setData($helpscoutData);
        $this->info('All done!');
    }
}

