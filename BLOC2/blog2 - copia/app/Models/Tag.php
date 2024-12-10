<?php

    namespace App\Models;

    use App\Models\Post;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Tag extends Model
    {
        use HasFactory;

        protected $fillable = [
            'name',
            'url_clean',
        ];

        protected $guarded = [
            'id'
        ];
        
        // Relacions entre taules:
        public function posts()
        {
            return $this->belongsToMany(Post::class);
        }

    }