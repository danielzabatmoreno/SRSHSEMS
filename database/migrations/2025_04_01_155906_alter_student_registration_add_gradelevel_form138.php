<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('student_registration', function (Blueprint $table) {
            // Add GradeLevel only if it doesn't exist
            if (!Schema::hasColumn('student_registration', 'GradeLevel')) {
                $table->enum('GradeLevel', ['Grade 11', 'Grade 12'])->after('Strand'); 
            }

            // Add Form138 only if it doesn't exist, and make it nullable
            if (!Schema::hasColumn('student_registration', 'Form138')) {
                $table->string('Form138')->nullable()->after('GradeLevel'); 
            }
        });
    }

    public function down(): void
    {
        Schema::table('student_registration', function (Blueprint $table) {
            if (Schema::hasColumn('student_registration', 'GradeLevel')) {
                $table->dropColumn('GradeLevel');
            }
            if (Schema::hasColumn('student_registration', 'Form138')) {
                $table->dropColumn('Form138');
            }
        });
    }
};
