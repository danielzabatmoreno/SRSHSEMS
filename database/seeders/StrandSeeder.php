<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Strand;

class StrandSeeder extends Seeder
{
    public function run()
    {
        $strands = [
            // 📌 Academic Cluster
            [
                'Strand_Name' => 'ACADEMIC CLUSTERS',
                'description' => 'STEM, ABM, GAS (Academic Cluster)'
            ],
            [
                'Strand_Name' => 'TECHPRO CLUSTERS',
                'description' => 'TVL, ICT  (Techpro Cluster)'
            ],
        ];

        foreach ($strands as $strand) {
            Strand::create($strand);
        }
    }
}
