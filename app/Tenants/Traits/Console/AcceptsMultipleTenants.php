<?php

namespace App\Tenants\Traits\Console;


use Symfony\Component\Console\Input\InputOption;

trait AcceptsMultipleTenants
{
    protected function getOptions()
    {
        return array_merge(
            parent::getOptions(), [
                ['tenants', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL,
                    'Migrate Specific Tenant(s)', null]
            ]
        );
    }

}