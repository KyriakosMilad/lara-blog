<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Tenant extends Model
{
    /**
     * set default connection for tenant model to master
     *
     * @var string
     */
    protected $connection = "master";

    /**
     * set config for tenant
     *
     * @return $this
     */
    public function config()
    {
        Config::set("database.connections.tenant.host", $this->db_host);
        Config::set("database.connections.tenant.port", $this->db_port);
        Config::set("database.connections.tenant.database", $this->db_name);
        Config::set("database.connections.tenant.username", $this->db_user);
        Config::set("database.connections.tenant.password", $this->db_pass);

        Config::set('database.default', 'tenant');
        DB::purge('tenant');
        DB::reconnect('tenant');
        Schema::connection("tenant")->getConnection()->reconnect();

        return $this;
    }

    /**
     * set current tenant in the container
     *
     * @return $this
     */
    public function set()
    {
        app()->forgetInstance("tenant");
        app()->instance("tenant", $this);

        return $this;
    }
}
