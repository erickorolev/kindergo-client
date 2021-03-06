<?php

declare(strict_types=1);

namespace Domains\Users\Jobs;

use Domains\Users\Models\User;
use Domains\Users\Services\UserConnector;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Support\VtigerClient\WSException;

final class SendUserToVtigerJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public User $user
    ) {
    }

    public function handle(): void
    {
        $connector = app(UserConnector::class);

        try {
            $connector->send($this->user);
        } catch (\DomainException | \InvalidArgumentException $e) {
            Log::error('Validation Error in updating data in Vtiger: ' . $e->getMessage());
            app('sentry')->captureException($e);
        } catch (WSException $e) {
            Log::error('Vtiger did not accept update of user with id '
                . $this->user->id . ': ' . $e->getMessage());
            app('sentry')->captureException($e);
        }
    }
}
