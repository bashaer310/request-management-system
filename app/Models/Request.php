<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\RequestStatus;

class Request extends Model
{
    protected $fillable = ['title', 'description', 'status', 'created_by', 'approved_by'];

    protected function casts(): array
    {
        return [
            'status' => RequestStatus::class,
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isPending(): bool
    {
        return $this->status === RequestStatus::PENDING->value;
    }

    public function isApproved(): bool
    {
        return $this->status === RequestStatus::APPROVED->value;
    }

    public function isRejected(): bool
    {
        return $this->status === RequestStatus::REJECTED->value;
    }
}
