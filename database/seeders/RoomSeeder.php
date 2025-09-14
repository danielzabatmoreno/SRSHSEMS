<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Strand;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Academic cluster (seed first)
        $academicRooms = [
            [
                'Room_Number' => 'A101',
                'Building' => 'Basic ED Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'STEM',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'A102',
                'Building' => 'Basic ED Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'STEM',
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'B201',
                'Building' => 'Basic ED Building',
                'Floor' => '2nd Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'ABM',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'B202',
                'Building' => 'Basic ED Building',
                'Floor' => '2nd Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'ABM',
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'C301',
                'Building' => 'Basic ED Building',
                'Floor' => '3rd Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'HUMSS',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'C302',
                'Building' => 'Basic ED Building',
                'Floor' => '3rd Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'HUMSS',
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'D401',
                'Building' => 'Basic ED Building',
                'Floor' => '4th Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'GAS',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 40,
                'is_available' => true
            ],
            [
                'Room_Number' => 'D402',
                'Building' => 'Basic ED Building',
                'Floor' => '4th Floor',
                'Room_Type' => 'Classroom',
                'Strand_Name' => 'GAS',
                'Grade_Level' => 'Grade 12',
                'Capacity' => 40,
                'is_available' => true
            ],
        ];

        // TechPro / TVL cluster (seed after academic)
        $techproRooms = [
            [
                'Room_Number' => 'T401',
                'Building' => 'Tech-Voc Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Computer Lab',
                'Strand_Name' => 'ICT',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 35,
                'is_available' => true
            ],
            [
                'Room_Number' => 'T402',
                'Building' => 'Tech-Voc Building',
                'Floor' => '1st Floor',
                'Room_Type' => 'Computer Lab',
                'Strand_Name' => 'ICT',
                'Grade_Level' => 'Grade 12',
                'Capacity' => 35,
                'is_available' => true
            ],
            [
                'Room_Number' => 'W501',
                'Building' => 'Tech-Voc Building',
                'Floor' => '2nd Floor',
                'Room_Type' => 'Workshop',
                'Strand_Name' => 'IA',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 30,
                'is_available' => true
            ],
            [
                'Room_Number' => 'W502',
                'Building' => 'Tech-Voc Building',
                'Floor' => '2nd Floor',
                'Room_Type' => 'Workshop',
                'Strand_Name' => 'IA',
                'Grade_Level' => 'Grade 12',
                'Capacity' => 30,
                'is_available' => true
            ],
            [
                'Room_Number' => 'H601',
                'Building' => 'Tech-Voc Building',
                'Floor' => '3rd Floor',
                'Room_Type' => 'Kitchen Lab',
                'Strand_Name' => 'HE',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 25,
                'is_available' => true
            ],
            [
                'Room_Number' => 'A701',
                'Building' => 'Agri Building',
                'Floor' => 'Ground Floor',
                'Room_Type' => 'Agri Lab',
                'Strand_Name' => 'AFA',
                'Grade_Level' => 'Grade 11',
                'Capacity' => 30,
                'is_available' => true
            ],
        ];

        // Merge so academic rooms are created first, then techpro
        $rooms = array_merge($academicRooms, $techproRooms);

        foreach ($rooms as $room) {
            $strand = Strand::where('Strand_Name', $room['Strand_Name'])->first();

            if (! $strand) {
                $this->command->info("Strand '{$room['Strand_Name']}' not found. Skipping room '{$room['Room_Number']}'.");
                continue;
            }

            Room::firstOrCreate(
                ['Room_Number' => $room['Room_Number']],
                [
                    'Building' => $room['Building'],
                    'Floor' => $room['Floor'],
                    'Room_Type' => $room['Room_Type'],
                    'StrandID' => $strand->StrandID,
                    'Grade_Level' => $room['Grade_Level'],
                    'Capacity' => $room['Capacity'],
                    'is_available' => $room['is_available'],
                ]
            );
        }

        $this->command->info('Rooms seeded successfully (Academic cluster first, then TechPro).');
    }
}
