<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Site Contents (Schema-driven key/value store for one-off texts & repeaters)
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page', 64);
            $table->string('key', 128);
            $table->json('value');
            $table->timestamp('updated_at')->useCurrent();
            $table->unique(['page', 'key']);
        });

        // 2. Project Categories
        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key', 64)->unique();
            $table->string('label', 128);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 3. Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->text('long_desc')->nullable();
            $table->string('category', 64)->default('maintenance');
            $table->string('tag')->default('صيانة');
            $table->string('tag_class', 32)->default('green'); // green | gold | blue
            $table->string('color', 32)->default('moss'); // moss | earth | sage | sand
            $table->string('target')->nullable(); // e.g. "٢٠ مسجد"
            $table->unsignedBigInteger('required_amount')->default(0);
            $table->unsignedBigInteger('collected_amount')->default(0);
            $table->unsignedInteger('progress_percent')->nullable(); // nullable override for manual pct
            $table->boolean('is_done')->default(false);
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('featured_order')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 4. Project Media (Images and Videos)
        Schema::create('project_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('type', 16)->default('image'); // image | video
            $table->string('source', 16)->default('url'); // upload | url
            $table->text('url');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 5. News
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tag')->nullable();
            $table->string('tag_style', 32)->default('primary'); // primary | green | gold
            $table->string('icon', 64)->default('file'); // sprite icon name
            $table->string('day', 32)->nullable();
            $table->string('hijri_date_text')->nullable();
            $table->string('context_label')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable(); // markdown / paragraph text
            $table->text('cover_image')->nullable();
            $table->json('gallery')->nullable(); // array of image objects/urls
            $table->text('showcase_image')->nullable();
            $table->string('showcase_caption')->nullable();
            $table->json('press_links')->nullable(); // array of { label, url, widget_title, widget_subtitle }
            $table->string('placement', 32)->default('report'); // featured | report | press
            $table->boolean('show_on_home')->default(false);
            $table->boolean('show_on_news_page')->default(true);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 6. Board Members
        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('role', 32)->default('member'); // president | vice-president | member
            $table->string('role_label');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // 7. Assembly Members
        Schema::create('assembly_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->default('عضو الجمعية العمومية');
            $table->string('city')->default('الخبراء');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 8. Annual Reports
        Schema::create('annual_reports', function (Blueprint $table) {
            $table->id();
            $table->string('year', 16);
            $table->string('title');
            $table->text('summary')->nullable();
            $table->string('pages', 32)->default('١');
            $table->string('status', 64)->default('معتمد');
            $table->text('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 9. Financial Statements
        Schema::create('financial_statements', function (Blueprint $table) {
            $table->id();
            $table->string('year', 16);
            $table->string('title');
            $table->string('type', 64)->default('قوائم سنوية');
            $table->string('auditor')->nullable();
            $table->text('notes')->nullable();
            $table->text('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 10. Assembly Minutes
        Schema::create('assembly_minutes', function (Blueprint $table) {
            $table->id();
            $table->string('date_text');
            $table->string('title');
            $table->text('decisions')->nullable();
            $table->string('attendees', 32)->default('١٠');
            $table->text('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 11. Policies
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('tag', 64)->default('لائحة');
            $table->text('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 12. Governance Documents (Main /governance cards)
        Schema::create('governance_documents', function (Blueprint $table) {
            $table->id();
            $table->string('category', 64); // official | plans | transparency
            $table->string('icon', 64)->default('file');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('button_label')->default('تحميل المستند');
            $table->string('tag', 64)->default('معتمد');
            $table->text('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 13. Contact Messages
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 32);
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 14. Media Library
        Schema::create('media_library', function (Blueprint $table) {
            $table->id();
            $table->string('disk', 32)->default('public');
            $table->text('path');
            $table->string('original_name');
            $table->string('mime', 128);
            $table->unsignedBigInteger('size');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->timestamps();
        });

        // 15. Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action', 32); // create | update | delete | restore
            $table->string('entity', 64);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('summary');
            $table->string('ip', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('media_library');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('governance_documents');
        Schema::dropIfExists('policies');
        Schema::dropIfExists('assembly_minutes');
        Schema::dropIfExists('financial_statements');
        Schema::dropIfExists('annual_reports');
        Schema::dropIfExists('assembly_members');
        Schema::dropIfExists('board_members');
        Schema::dropIfExists('news');
        Schema::dropIfExists('project_media');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_categories');
        Schema::dropIfExists('site_contents');
    }
};
