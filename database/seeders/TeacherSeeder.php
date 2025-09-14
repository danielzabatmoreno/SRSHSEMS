<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [

            // ---- From your teacher list ----
            ['FirstName' => 'Luzviminda', 'LastName' => 'Candelaria', 'Email' => 'luzviminda.candelaria@santarosa.edu.ph', 'Contact_Number' => '09100000001', 'Address' => 'Davao City', 'DOB' => '1975-01-01', 'Gender' => 'Female', 'Subject_Specialization' => 'Academic Head'],
            ['FirstName' => 'Donabel', 'LastName' => 'Germino', 'Email' => 'donabel.germino@santarosa.edu.ph', 'Contact_Number' => '09100000002', 'Address' => 'Davao City', 'DOB' => '1978-02-02', 'Gender' => 'Female', 'Subject_Specialization' => 'Academic Head'],
            ['FirstName' => 'Mar', 'LastName' => 'Agustin', 'Email' => 'mar.agustin@santarosa.edu.ph', 'Contact_Number' => '09100000003', 'Address' => 'Davao City', 'DOB' => '1980-03-03', 'Gender' => 'Male', 'Subject_Specialization' => 'Guidance / Class Adviser'],
            ['FirstName' => 'Ma. Theresa', 'LastName' => 'Cabig', 'Email' => 'theresa.cabig@santarosa.edu.ph', 'Contact_Number' => '09100000004', 'Address' => 'Davao City', 'DOB' => '1981-04-04', 'Gender' => 'Female', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Bernard', 'LastName' => 'Gonzales', 'Email' => 'bernard.gonzales@santarosa.edu.ph', 'Contact_Number' => '09100000006', 'Address' => 'Davao City', 'DOB' => '1983-06-06', 'Gender' => 'Male', 'Subject_Specialization' => 'ALS Focal Person'],
            ['FirstName' => 'Rey', 'LastName' => 'Laura', 'Email' => 'rey.laura@santarosa.edu.ph', 'Contact_Number' => '09100000007', 'Address' => 'Davao City', 'DOB' => '1984-07-07', 'Gender' => 'Male', 'Subject_Specialization' => 'Work Immersion'],
            ['FirstName' => 'Julius', 'LastName' => 'Maderia', 'Email' => 'julius.maderia@santarosa.edu.ph', 'Contact_Number' => '09100000008', 'Address' => 'Davao City', 'DOB' => '1985-08-08', 'Gender' => 'Male', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Daniel', 'LastName' => 'Serapio', 'Email' => 'daniel.serapio@santarosa.edu.ph', 'Contact_Number' => '09100000009', 'Address' => 'Davao City', 'DOB' => '1986-09-09', 'Gender' => 'Male', 'Subject_Specialization' => '---'],
            ['FirstName' => 'Arnel', 'LastName' => 'Abiog', 'Email' => 'arnel.abiog@santarosa.edu.ph', 'Contact_Number' => '09100000010', 'Address' => 'Davao City', 'DOB' => '1987-10-10', 'Gender' => 'Male', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Maricris', 'LastName' => 'Belmonte', 'Email' => 'maricris.belmonte@santarosa.edu.ph', 'Contact_Number' => '09100000011', 'Address' => 'Davao City', 'DOB' => '1988-11-11', 'Gender' => 'Female', 'Subject_Specialization' => '---'],
            ['FirstName' => 'Rolito', 'LastName' => 'Ciriaco', 'Email' => 'rolito.ciriaco@santarosa.edu.ph', 'Contact_Number' => '09100000012', 'Address' => 'Davao City', 'DOB' => '1989-12-12', 'Gender' => 'Male', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Jojo', 'LastName' => 'Constantino', 'Email' => 'jojo.constantino@santarosa.edu.ph', 'Contact_Number' => '09100000013', 'Address' => 'Davao City', 'DOB' => '1979-01-13', 'Gender' => 'Male', 'Subject_Specialization' => 'Prefect of Discipline'],
            ['FirstName' => 'Mary Ann', 'LastName' => 'Gaddi', 'Email' => 'maryann.gaddi@santarosa.edu.ph', 'Contact_Number' => '09100000014', 'Address' => 'Davao City', 'DOB' => '1980-02-14', 'Gender' => 'Female', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Herodina', 'LastName' => 'Eustaquio', 'Email' => 'herodina.eustaquio@santarosa.edu.ph', 'Contact_Number' => '09100000015', 'Address' => 'Davao City', 'DOB' => '1981-03-15', 'Gender' => 'Female', 'Subject_Specialization' => '---'],
            ['FirstName' => 'Arianne', 'LastName' => 'Lucas', 'Email' => 'arianne.lucas@santarosa.edu.ph', 'Contact_Number' => '09100000016', 'Address' => 'Davao City', 'DOB' => '1982-04-16', 'Gender' => 'Female', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Sheryl Lynn', 'LastName' => 'Paladan', 'Email' => 'sheryl.paladan@santarosa.edu.ph', 'Contact_Number' => '09100000017', 'Address' => 'Davao City', 'DOB' => '1983-05-17', 'Gender' => 'Female', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Jimmy', 'LastName' => 'Payumo', 'Email' => 'jimmy.payumo@santarosa.edu.ph', 'Contact_Number' => '09100000018', 'Address' => 'Davao City', 'DOB' => '1984-06-18', 'Gender' => 'Male', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Jovilyn', 'LastName' => 'Castillo', 'Email' => 'jovilyn.castillo@santarosa.edu.ph', 'Contact_Number' => '09100000019', 'Address' => 'Davao City', 'DOB' => '1985-07-19', 'Gender' => 'Female', 'Subject_Specialization' => '---'],
            ['FirstName' => 'Gerald Paul', 'LastName' => 'Esquivel', 'Email' => 'gerald.esquivel@santarosa.edu.ph', 'Contact_Number' => '09100000020', 'Address' => 'Davao City', 'DOB' => '1986-08-20', 'Gender' => 'Male', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Luigi', 'LastName' => 'Mariano', 'Email' => 'luigi.mariano@santarosa.edu.ph', 'Contact_Number' => '09100000021', 'Address' => 'Davao City', 'DOB' => '1987-09-21', 'Gender' => 'Male', 'Subject_Specialization' => 'Class Adviser'],
            ['FirstName' => 'Ayessa', 'LastName' => 'Rufino', 'Email' => 'ayessa.rufino@santarosa.edu.ph', 'Contact_Number' => '09100000022', 'Address' => 'Davao City', 'DOB' => '1988-10-22', 'Gender' => 'Female', 'Subject_Specialization' => '---'],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
