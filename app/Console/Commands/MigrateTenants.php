<?php

namespace App\Console\Commands;

use App\Tenant;
use Illuminate\Console\Command;

class MigrateTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenant?} {--refresh} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->argument("tenant")) {
            $this->migrate(Tenant::whereDomain($this->argument("tenant"))->firstOrFail());
        } else {
            Tenant::all()->each(
                fn($tenant) => $this->migrate($tenant)
            );
        }
    }

    /**
     * migrate tenant to database
     *
     * @param $tenant
     * @return void
     */
    public function migrate($tenant) {
        $tenant->config()->set();

        $this->line("");
        $this->line("==================================");
        $this->line("Migrating tenant #{$tenant->id} domain: {$tenant->domain}");
        $this->line("==================================");

        $options = ['--force' => true];

        if ($this->option('seed')) {
            $options['--seed'] = true;
        }

        $this->call($this->option("refresh") ? "migrate:refresh" : "migrate", $options);
    }
}
