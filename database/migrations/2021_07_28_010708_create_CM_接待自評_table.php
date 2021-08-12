<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCM_接待自評Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('CM_接待自評', function (Blueprint $table) {
                $table->char('Store')->default(NULL);
                $table->char('Date_')->default(NULL);
                $table->char('UserId')->default(NULL);
                $table->char('CustNo')->default(NULL);
                $table->char('品牌力')->default(NULL);
                $table->char('商品力')->default(NULL);
                $table->char('經驗力')->default(NULL);
                $table->char('預算對焦')->default(NULL);
                $table->char('促銷活動')->default(NULL);
                $table->char('異議排除')->default(NULL);
                $table->nvarchar('迎賓加分點')->default(NULL);
                $table->nvarchar('門市展演加分點')->default(NULL);
                $table->nvarchar('案例對焦加分點')->default(NULL);
                $table->nvarchar('服務流程對焦點')->default(NULL);
                $table->nvarchar('促銷活動對焦點')->default(NULL);
                $table->nvarchar('異議排除對焦點')->default(NULL);
                $table->bit('店長協助')->default(NULL);
                $table->bit('LINE')->default(NULL);
                $table->bit('Google')->default(NULL);
                $table->datetime('datetime_')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CM_接待自評');
    }
}
