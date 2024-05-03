<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // ID Sản phẩm
            $table->id();
            // ID Danh mục
            $table->integer('category_id')->default(0);
            // Mã định danh sản phẩm duy nhất
            $table->string('sku')->nullable();
            // Tên sản phẩm
            $table->string('name');
            // Đường dẫn
            $table->string('slug')->unique();
            // Ảnh sản phẩm
            $table->text('image')->nullable();
            // Ảnh slide
            $table->text('slide')->nullable();
            // Giá bán
            $table->integer('price')->nullable();
            // Giá thị trường
            $table->integer('price_old')->nullable();
            // Nội dung giới thiệu sản phẩm (Editor hoặc cấu hình json)
            $table->longtext('detail')->nullable();
            //thông số kỹ thuật
            $table->longtext('specifications')->nullable();
            //bảo hành
            $table->string('insurance')->nullable();
            //hiện giá  fls
            $table->integer('flash_sale')->default(0);
            //video
            $table->text('video')->nullable();
            // Sản phẩm liên quan
            $table->string('related_products')->nullable();
            // Số lượng sp trong kho
            $table->integer('quantity')->nullable();
            // Chiều dài
            $table->integer('length')->nullable();
            // Chiều rộng
            $table->integer('wide')->nullable();
            // Chiều cao
            $table->integer('height')->nullable();
            // Khối lượng
            $table->integer('weight')->nullable();
            // Thuế
            $table->integer('tax_id')->nullable();
            // Trạng thái (-1 Xóa | 0 Không hoạt động | 1 Hoạt động)
            $table->tinyInteger('status')->default(1);
            // Ngày đăng/cập nhật
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
        Schema::dropIfExists('products');
    }
}
