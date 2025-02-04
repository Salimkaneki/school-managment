<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class School extends Authenticatable
{
    use HasFactory;
    use Notifiable, SoftDeletes;


    protected $guarded = [];

    protected $fillable = [
        'name',
        'type',
        'languages',
        'staff_count',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'has_sports_equipment',
        'has_library',
        'teaching_staff_count',
        'has_computer_room',
        'has_handicap_access',
        'rules_document_path',
        'project_document_path',
        'logo_path',
        'username', 
        'password',
    ];

    protected $casts = [
        'languages' => 'array',
        'has_sports_equipment' => 'boolean',
        'has_library' => 'boolean',
        'has_computer_room' => 'boolean',
        'has_handicap_access' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        // Relations
        public function classes()
        {
            return $this->hasMany(ClassModel::class);
        }
    
        public function classrooms()
        {
            return $this->hasMany(Classroom::class);
        }



    // Implémentation des méthodes requises par l'interface Authenticatable
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}