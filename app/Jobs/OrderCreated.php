<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Leugin\KitchenCore\Models\Order\Order;

class OrderCreated implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->connection = 'rabbitmq';

    }

    public function handle()
    {
    }

    /**
     * @return string[]
     */
    public function tags(): array
    {
        return [self::class];
    }

    /**
     * @return string
     */
    public function displayName(): string
    {
        return "kitchen OrderCreated";
    }

    /**
     * The job failed to process.
     *
     * @param Exception $exception
     */
    public function failed(Exception $exception): void
    {
        logger(['emit Exception' => $exception]);
    }
}
