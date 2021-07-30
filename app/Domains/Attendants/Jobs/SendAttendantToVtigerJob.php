<?php

declare(strict_types=1);

namespace Domains\Attendants\Jobs;

use Domains\Attendants\Models\Attendant;
use Domains\Attendants\Services\AttendantConnector;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

final class SendAttendantToVtigerJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Attendant $attendant
    ) {
    }

    public function handle(): void
    {
        return;
        $connector = app(AttendantConnector::class);

        try {
            $connector->send($this->attendant);
        } catch (\DomainException | \InvalidArgumentException $e) {
            Log::error('Validation Error in updating data in Vtiger: ' . $e->getMessage());
            app('sentry')->captureException($e);
        }
    }
}
