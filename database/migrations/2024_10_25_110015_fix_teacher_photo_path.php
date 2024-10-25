<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Teacher;

class FixTeacherPhotoPath extends Migration
{
    public function up()
    {
        $teachers = Teacher::whereNotNull('photo')->get();
        
        foreach ($teachers as $teacher) {
            // Retire le '/storage/' du début du chemin
            $newPath = str_replace('/storage/images/teachers/', 'teachers/', $teacher->photo);
            $newPath = str_replace('/storage/', '', $newPath);
            
            $teacher->update([
                'photo' => $newPath
            ]);
        }
    }

    public function down()
    {
        // Si besoin de revenir en arrière
    }
}