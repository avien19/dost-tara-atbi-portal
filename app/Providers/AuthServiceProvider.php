<?php

namespace App\Providers;

use App\Models\ForumPost;
use App\Policies\ForumPostPolicy;
use App\Models\ForumReply;
use App\Policies\ForumReplyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ForumPost::class => ForumPostPolicy::class,
        ForumReply::class => ForumReplyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
