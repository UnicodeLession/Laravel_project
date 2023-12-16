<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('video_id')->default(0); // chỉ render ra đấy chưa cung cấp video bài giảng
            $table->integer('document_id')->nullable();
            $table->integer('parent_id')->default(0); // bài học trong bài học
            $table->boolean('is_trial')->default(0); // được học thử hay không
            $table->integer('views')->nullable();
            $table->integer('position')->nullable(); // sắp xếp bài học theo course
            $table->float('duration')->nullable(); // thời gian khóa học tính theo giờ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // khi tạo mới bảng
         Schema::dropIfExists('lessons');
    }
};
