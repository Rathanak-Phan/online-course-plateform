<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory, \App\Traits\Searchable;

    protected $fillable = [
        'instructor_id', 
        'category_id', 
        'title', 
        'slug', 
        'description', 
        'short_description', 
        'price', 
        'discount_price', 
        'thumbnail', 
        'video_url', 
        'level', 
        'language',
        'duration',
        'requirements',
        'what_will_learn',
        'target_audience',
        'has_certificate',
        'status', 
        'is_featured'
    ];

    protected $searchable = ['title', 'description', 'instructor.name', 'category.name'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->search($search);
        });

        $query->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category_id', $category);
        });

        $query->when($filters['price'] ?? null, function ($query, $price) {
            if ($price === 'free') {
                $query->where('price', 0);
            } elseif ($price === 'paid') {
                $query->where('price', '>', 0);
            }
        });

        $query->when($filters['rating'] ?? null, function ($query, $rating) {
            $query->whereHas('reviews', function ($query) use ($rating) {
                $query->selectRaw('avg(rating)')->havingRaw('avg(rating) >= ?', [$rating]);
            });
        });

        $query->when($filters['level'] ?? null, function ($query, $level) {
            $query->where('level', $level);
        });

        $query->when($filters['sort'] ?? null, function ($query, $sort) {
            switch ($sort) {
                case 'newest':
                    $query->latest();
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                    break;
                case 'popular':
                default:
                    $query->withCount('enrollments')->orderBy('enrollments_count', 'desc');
                    break;
            }
        });

        return $query;
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function isPaid(): bool
    {
        return $this->price > 0;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function wishlistedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}
